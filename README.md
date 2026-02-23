# WP Docker CLI

**WP Docker CLI** to narzędzie do szybkiego tworzenia projektów WordPress z Dockerem.  
Automatyzuje:

- pobranie najnowszego WordPressa
- kopiowanie własnego theme
- generowanie `.env`
- uruchomienie Docker Compose
- aktywację theme w kontenerze APP
- inicjalizację repozytorium Git i push do remote

---

## Instalacja

```bash
python3 -m pip install wp-docker
```

## Użycie

Tworzenie nowego projektu:

```bash
wp-docker init "Nazwa Projektu"
```