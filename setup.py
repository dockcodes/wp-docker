from setuptools import setup, find_packages

setup(
    name="wp-docker-cli",
    version="0.1.0",
    packages=find_packages(),
    include_package_data=True,
    install_requires=[
        "python-dotenv",
    ],
    entry_points={
        "console_scripts": [
            "wp-docker=wp_docker_cli.cli:main",
        ],
    },
    python_requires=">=3.9",
)