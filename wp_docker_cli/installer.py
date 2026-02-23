import os, shutil, re, subprocess, time
from dotenv import load_dotenv
from pathlib import Path

def slugify(name):
    name = name.lower().strip()
    name = re.sub(r'[^a-z0-9]+', '-', name)
    return name.strip('-')

def run_installer(project_name: str):
    slug = slugify(project_name)
    print(f"Project slug: {slug}")

    cwd = Path.cwd()
    template_dir = Path(__file__).parent / "templates"

    # 1️⃣ .env
    env_src = template_dir / ".env.example"
    env_dst = cwd / ".env"
    shutil.copy(env_src, env_dst)

    with open(env_dst, "r") as f:
        env_content = f.read()
    env_content = env_content.replace("APP_NAME_DOCKER=example", f"APP_NAME_DOCKER={slug}")
    env_content = env_content.replace("IMAGE_NAME_APP=example", f"IMAGE_NAME_APP={slug}")
    with open(env_dst, "w") as f:
        f.write(env_content)
    print("✔ .env generated")

    # 2️⃣ WordPress download
    wp_zip = cwd / "wordpress.zip"
    import urllib.request
    print("⬇ Downloading WordPress...")
    urllib.request.urlretrieve("https://wordpress.org/latest.zip", wp_zip)

    # extract
    import zipfile
    with zipfile.ZipFile(wp_zip, 'r') as zip_ref:
        zip_ref.extractall(cwd)
    wp_dir = cwd / "wordpress"
    if (cwd / "wordpress_tmp").exists():
        shutil.rmtree(cwd / "wordpress_tmp")
    os.rename(cwd / "wordpress", wp_dir)
    os.remove(wp_zip)
    print("✔ WordPress ready")

    # 3️⃣ copy theme
    theme_src = template_dir / "theme"
    theme_dest = wp_dir / "wp-content/themes/dock"
    if theme_dest.exists():
        shutil.rmtree(theme_dest)
    shutil.copytree(theme_src, theme_dest)
    print("✔ Theme installed")

    # 4️⃣ update README
    readme_src = template_dir / "README.md"
    readme_dst = cwd / "README.md"
    shutil.copy(readme_src, readme_dst)
    with open(readme_dst, "r") as f:
        readme_content = f.read()
    readme_content = readme_content.replace("example_mysql", f"{slug}_mysql")
    with open(readme_dst, "w") as f:
        f.write(readme_content)
    print("✔ README updated")

    # 5️⃣ start docker
    print("🐳 Starting Docker...")
    subprocess.run(["docker", "compose", "up", "-d"], check=True)

    # 6️⃣ activate theme in app container
    load_dotenv()
    container = os.getenv("CONTAINER_NAME_APP")
    if container:
        print("🎨 Activating theme in container...")
        # wait for WordPress
        for _ in range(30):
            code = subprocess.run(f"docker exec {container} wp core is-installed --allow-root",
                                  shell=True)
            if code.returncode == 0:
                break
            time.sleep(2)
        subprocess.run(f"docker exec {container} wp theme activate dock --allow-root", shell=True)
        print("✔ Theme activated")