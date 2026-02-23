import os, shutil, re, subprocess, time
from dotenv import load_dotenv
from pathlib import Path
import socket
import random
import secrets

def get_free_port(start=2000, end=65000):
    for _ in range(100):
        port = random.randint(start, end)
        with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
            try:
                s.bind(("", port))
                return port
            except OSError:
                continue
    raise RuntimeError("Nie udało się znaleźć wolnego portu")

def slugify(name):
    name = name.lower().strip()
    name = re.sub(r'[^a-z0-9]+', '-', name)
    return name.strip('-')

def run_installer(project_name: str):
    slug = slugify(project_name)
    print(f"Project slug: {slug}")

    cwd = Path.cwd()
    project_dir = cwd / slug
    template_dir = Path(__file__).parent / "templates"

    # Utwórz folder projektu
    project_dir.mkdir(parents=True, exist_ok=True)

    # 0️⃣ Kopiowanie wszystkich plików z templates do folderu projektu
    shutil.copytree(template_dir, project_dir, dirs_exist_ok=True)
    print("✔ Templates copied to project folder")

    # 1️⃣ .env
    env_src = template_dir / ".env.example"
    env_dst = project_dir / ".env"
    shutil.copy(env_src, env_dst)

    with open(env_dst, "r") as f:
        env_content = f.read()

    port_app = get_free_port(8000, 8999)
    port_mysql = get_free_port(3307, 3999)
    port_pma = get_free_port(8080, 8999)
    print(f"💡 Assigned ports -> APP: {port_app}, MySQL: {port_mysql}, phpMyAdmin: {port_pma}")

    env_content = env_content.replace("CONTAINER_PORT_APP=8000", f"CONTAINER_PORT_APP={port_app}")
    env_content = env_content.replace("CONTAINER_PORT_MYSQL=3306", f"CONTAINER_PORT_MYSQL={port_mysql}")
    env_content = env_content.replace("CONTAINER_PORT_PHPMYADMIN=8080", f"CONTAINER_PORT_PHPMYADMIN={port_pma}")
    env_content = env_content.replace("APP_NAME_DOCKER=example", f"APP_NAME_DOCKER={slug}")
    env_content = env_content.replace("IMAGE_NAME_APP=example", f"IMAGE_NAME_APP={slug}")

    keys = [
        'WORDPRESS_AUTH_KEY',
        'WORDPRESS_SECURE_AUTH_KEY',
        'WORDPRESS_LOGGED_IN_KEY',
        'WORDPRESS_NONCE_KEY',
        'WORDPRESS_AUTH_SALT',
        'WORDPRESS_SECURE_AUTH_SALT',
        'WORDPRESS_LOGGED_IN_SALT',
        'WORDPRESS_NONCE_SALT'
    ]

    for key in keys:
        token = secrets.token_urlsafe(64)
        env_content = re.sub(f"{key}=.*", f"{key}={token}", env_content)

    with open(env_dst, "w") as f:
        f.write(env_content)
    print("✔ .env generated")

    # 2️⃣ WordPress download
    wp_dir = project_dir / "wordpress"
    subprocess.run([
        "git", "clone", "--depth", "1",
        "https://github.com/WordPress/WordPress.git",
        str(wp_dir)
    ], check=True)
    git_folder = wp_dir / ".git"
    if git_folder.exists():
        shutil.rmtree(git_folder)
    print("✔ WordPress ready")

    # 3️⃣ copy theme
    theme_src = project_dir / "theme"
    theme_dest = wp_dir / "wp-content/themes/dock"
    if theme_dest.exists():
        shutil.rmtree(theme_dest)
    shutil.move(str(theme_src), str(theme_dest))

    print("✔ Theme installed")

    themes_dir = project_dir / "wordpress/wp-content/themes"
    keep_themes = ["dock"]
    twenty_themes = [d for d in os.listdir(themes_dir) if d.startswith("twenty") and (themes_dir / d).is_dir()]

    def twenty_to_number(name):
        mapping = {
            "twentyeleven": 2011,
            "twentytwelve": 2012,
            "twentythirteen": 2013,
            "twentyfourteen": 2014,
            "twentyfifteen": 2015,
            "twentysixteen": 2016,
            "twentyseventeen": 2017,
            "twentynineteen": 2019,
            "twentytwenty": 2020,
            "twentytwentyone": 2021,
            "twentytwentytwo": 2022,
            "twentytwentythree": 2023,
            "twentytwentyfour": 2024,
            "twentytwentyfive": 2025,
            "twentytwentysix": 2026,
            "twentytwentyseven": 2027,
            "twentytwentyeight": 2028,
            "twentytwentynine": 2029,
            "twentythirty": 2030,
            "twentythirtyone": 2031,
            "twentythirtytwo": 2032,
            "twentythirtythree": 2033,
            "twentythirtyfour": 2034,
            "twentythirtyfive": 2035,
            "twentythirtysix": 2036,
            "twentythirtyseven": 2037,
            "twentythirtyeight": 2038,
            "twentythirtynine": 2039,
            "twentyforty": 2040,
        }
        return mapping.get(name, 0)

    if twenty_themes:
        latest_twenty = max(twenty_themes, key=twenty_to_number)
        keep_themes.append(latest_twenty)

    for theme in os.listdir(themes_dir):
        theme_path = themes_dir / theme
        if theme_path.is_dir() and theme not in keep_themes:
            shutil.rmtree(theme_path)
            print(f"🗑 Removed unused theme: {theme}")


    wp_config_src = project_dir / "wp-config.php"
    wp_config_dest = project_dir / "wordpress/wp-config.php"
    shutil.move(str(wp_config_src), str(wp_config_dest))
    print("✔ wp-config.php moved to WordPress folder")

    # 4️⃣ update README
    readme_dst = project_dir / "README.md"
    with open(readme_dst, "r") as f:
        readme_content = f.read()
    readme_content = readme_content.replace("example_mysql", f"{slug}_mysql")
    with open(readme_dst, "w") as f:
        f.write(readme_content)
    print("✔ README updated")

    # 5️⃣ start docker
    print("🐳 Starting Docker...")
    subprocess.run(["make", "up"], cwd=str(project_dir), check=True)

    # 6️⃣ activate theme in app container
    load_dotenv(project_dir / ".env")
    container = os.getenv("CONTAINER_NAME_APP")
    if container:
        print("🎨 Activating theme in container...")
        # wait for WordPress
        for _ in range(30):
            code = subprocess.run(f"docker exec {container} wp core is-installed --path=/var/www/html --url=http://localhost --allow-root", shell=True)
            if code.returncode == 0:
                break
            time.sleep(2)
        subprocess.run(f"docker exec {container} wp theme activate dock --allow-root", shell=True)
        print("✔ Theme activated")

    print(f"✅ Project {slug} installed successfully in {project_dir}")