# Docker's command helpers

- Запуск контейнеров `docker-compose up -d --build`
- Остановка контейнеров `docker-compose down`
- Просмотреть логи `docker-compose logs --tal 25`
- Если что-то пошло не так, проверьте настройки docker desktop и отключите WSL.

# DATABASE command helpers

- Запуск миграций `docker exec app_container php artisan migrate`
- Drop и повторный запуск миграций `docker exec app_container php artisan migrate:fresh`
- Заполнение таблиц seeder `docker exec app_container php artisan db:seed`

