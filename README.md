### Usage

1. Run command `make up` for linux/mac-os or `make up-win`.
2. Install npm `make bash` => `cd wp-content/themes/dock` => `npm install`
3. Compile npm `make bash` => `cd wp-content/themes/dock` => `npm run build`
4. Go to website http://localhost <- port from .env file.
5. Go to phpmyadmin http://localhost:8080 <- port from .env file.

#### Usefully commands
- Docker start: `make up` or `make up-win`
- Docker stop: `make down` or `make down-win`
- Go do bash: `make bash` or `make bash-win`
- Make database backup: `make db-dump`

#### Import DB
docker exec -i testowy-projekt_mysql mariadb -uwordpress -psecret wordpress < dumps/dump.sql
