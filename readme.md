1. git clone https://github.com/ChagarinIvan/new_post_crawler_test.git
2. cd new_post_crawler_test/
3. docker-compose up -d
4. sudo docker-compose exec app composer install
5. sudo docker-compose exec app composer run-script post-root-package-install
6. sudo docker-compose exec app php artisan migrate
7. установить api key НоваПошты в .env параметр NEW_POST_API_KEY=
8. sudo docker-compose exec app php artisan collect:new_post

9. localhost/api/area - список областей
10. localhost/api/area/{area_ref} - подробно область со списком городов
11. localhost/api/city/{city_ref} - подробно город со списком отделений
12. localhost/api/warehouse/{warehouse_ref} - подробно отделение

рабочий пример тут http://3.65.64.158/api/area/7150812d-9b87-11de-822f-000c2965ae0e
