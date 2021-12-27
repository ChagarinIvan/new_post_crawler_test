1. git clone https://github.com/ChagarinIvan/new_post_crawler_test.git
2. docker-compose up -d
3. sudo docker-compose exec app php artisan migrate
4. sudo docker-compose exec app php artisan collect:new_post

5. localhost/api/area - список областей
6. localhost/api/area/{area_ref} - подробно область со списком городов
7. localhost/api/city/{city_ref} - подробно город со списком отделений
8. localhost/api/warehouse/{warehouse_ref} - подробно отделение

рабочий пример тут http://3.65.64.158/api/area/7150812d-9b87-11de-822f-000c2965ae0e
