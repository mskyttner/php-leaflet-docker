#! make

dump:
	docker exec phpleafletdocker_db_1 \
		sh -c 'exec mysqldump --all-databases -uroot -p"otter"' > dump.sql

ls:
	docker exec phpleafletdocker_db_1 \
		sh -c 'exec mysql -u otter -p"otter" -D otter -e "select * from wobjects;"'

init:
	docker exec -it phpleafletdocker_php_1 \
		ash -c "apk update && apk add php7-mysqli"
	docker exec -it phpleafletdocker_php_1 \
		ash -c "docker-php-ext-install mysqli"
