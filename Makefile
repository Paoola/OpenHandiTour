web:
	docker exec -it -u www-data openhanditour_web_1 bash

db:
	docker exec -it -u postgres openhanditour_db_1 psql openhanditour openhanditour
