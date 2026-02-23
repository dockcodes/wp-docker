import sys
from wp_docker_cli.installer import run_installer

def main():
    if len(sys.argv) < 2:
        print("Usage: wp-docker init <project-name>")
        sys.exit(1)

    cmd = sys.argv[1]

    if cmd == "init":
        project_name = sys.argv[2] if len(sys.argv) > 2 else input("Project name: ")
        run_installer(project_name)
    else:
        print(f"Unknown command: {cmd}")
        sys.exit(1)