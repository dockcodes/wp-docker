from setuptools import setup, find_packages

setup(
    name="wp-docker",
    version="0.1.1",
    packages=find_packages(),
    include_package_data=True,
    install_requires=[
        "python-dotenv",
    ],
    entry_points={
        "console_scripts": [
            "wp-docker=wp_docker.cli:main",
        ],
    },
    python_requires=">=3.9",
)