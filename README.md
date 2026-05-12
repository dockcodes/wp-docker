# WP Docker CLI – WordPress + Docker Project Generator

`wp-docker` is a cross-platform CLI tool that generates a fully configured **WordPress + Docker development environment** in seconds.

It automatically:

- Creates a new project directory
- Generates `.env` with random free ports
- Downloads the latest WordPress
- Installs and activates a custom theme
- Generates secure WordPress salts
- Prepares Docker + phpMyAdmin

---

## Requirements

### macOS / Linux
- Python **3.9+**
- Docker + Docker Compose
- Git

### Windows
- Python **3.9+**
- Docker Desktop (with WSL2 enabled)
- Git

Verify:

```bash
python3 --version
docker --version
git --version
```

---

# Installation

## macOS / Linux

```bash
python3 -m pip install --upgrade pip
python3 -m pip install wp-docker
```

If `pip` is not found:

```bash
python3 -m ensurepip --upgrade
```

---

## Windows (PowerShell)

```bash
python -m pip install --upgrade pip
python -m pip install wp-docker
```
---

# Usage
Create a new project:
```bash
wp-docker init "My WordPress Project"
```

---

# Access URLs

After installation:

| Service | URL |
|----------|------|
| WordPress | http://localhost:PORT |
| phpMyAdmin | http://localhost:PORT |

---

# Docker Management

Start containers:
```bash
make up
```

Stop containers:
```bash
make down
```

View logs:
```bash
docker compose logs -f
```

---

# Uninstall
```bash
python3 -m pip uninstall wp-docker
```

---

# License
MIT License

---

# Author
Created by **Jacek Labudda**
