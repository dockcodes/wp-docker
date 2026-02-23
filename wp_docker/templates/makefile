include .env

export USER_ID=$(shell id -u)
export GROUP_ID=$(shell id -g)

up:
	docker compose --env-file .env -f docker-compose.yml up -d
up-build:
	docker compose -f docker-compose.yml --env-file .env build
	docker compose -f docker-compose.yml --env-file .env up -d
down:
	docker compose down
sh:
	docker exec -it ${CONTAINER_NAME_APP} sh
db-dump:
	docker compose exec -T db mysqldump --databases ${DB_DATABASE} -u ${DB_USERNAME} --password=${DB_PASSWORD} | gzip -9 > ./dumps/db-backup-$(shell date +%F).sql.gz
	find dumps -mtime +30 -exec rm -rf {} \;
up-win:
	docker compose --env-file .env up -d
down-win:
	make down
bash-win:
	winpty docker exec -it ${CONTAINER_NAME_APP} bash
run-backup:
	mkdir -p ./backup
	mysqldump -u${DB_USERNAME} -p"${DB_PASSWORD}" -h ${DB_HOST} ${DB_DATABASE} | gzip -9 > ./backup/backup_db.sql.gz
