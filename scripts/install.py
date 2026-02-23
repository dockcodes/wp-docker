#!/usr/bin/env python3
import shutil
import urllib.request
import zipfile
import os
import re
from dotenv import load_dotenv

WP_URL = "https://wordpress.org/latest.zip"

def slugify(name):
    name = name.lower().strip()
    name = re.sub(r'[^a-z0-9]+', '-', name)
    return name.strip('-')

print("\n🔧 WordPress Docker Installer\n")

project_name = input("Project name: ").strip()
slug = slugify(project_name)

print(f"→ slug: {slug}\n")

# .env
shutil.copy(".env.example", ".env")

with open(".env", "r") as f:
    env = f.read()

env = env.replace("APP_NAME_DOCKER=example", f"APP_NAME_DOCKER={slug}")
env = env.replace("IMAGE_NAME_APP=example", f"IMAGE_NAME_APP={slug}")

with open(".env", "w") as f:
    f.write(env)

print("✔ .env generated")

readme_path = "README.md"
with open(readme_path, "r", encoding="utf-8") as f:
    content = f.read()

# Zamień 'example_mysql' na 'nazwa-projektu_mysql'
content = re.sub(r"example_mysql", f"{slug}_mysql", content)

with open(readme_path, "w", encoding="utf-8") as f:
    f.write(content)

print(f"✔ README.md updated")

# WordPress download
print("⬇ Downloading WordPress...")
urllib.request.urlretrieve(WP_URL, "wordpress.zip")

# Extract
print("📦 Extracting WordPress...")
with zipfile.ZipFile("wordpress.zip", 'r') as zip_ref:
    zip_ref.extractall(".")

if os.path.exists("wordpress"):
    shutil.rmtree("wordpress")

os.rename("wordpress", "wordpress_tmp")
os.rename("wordpress_tmp", "wordpress")

os.remove("wordpress.zip")

print("✔ WordPress ready")

# Copy theme
print("🎨 Installing theme...")

theme_src = "theme"
theme_dest = "wordpress/wp-content/themes/dock"

if os.path.exists(theme_dest):
    shutil.rmtree(theme_dest)

shutil.move(theme_src, theme_dest)

load_dotenv()
container = os.getenv("CONTAINER_NAME_APP")

print("\n🐳 Starting Docker containers...")
os.system("docker compose up -d")

print("⏳ Waiting for app container to be ready...")

for i in range(30):
    code = os.system(f"docker exec {container} wp core is-installed --allow-root > /dev/null 2>&1")
    if code == 0:
        print("✔ WordPress is ready")
        break
    time.sleep(2)
else:
    print("❌ WordPress not ready, aborting")
    exit(1)

print("🎨 Activating theme...")
os.system(f"docker exec {container} wp theme activate dock --allow-root")

print("✔ Theme activated")

print("\n🚀 Installation finished")