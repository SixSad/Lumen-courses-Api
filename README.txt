## Lumen command helpers

    - Установка Lumen в директории project 'git clone https://github.com/laravel/lumen.git' или 'composer create-project --prefer-dis laravel/lumen .'
    - Установка composer в директорию project, если проект загружен с гита 'docker run —rm -v ${PWD}:/app composer install'

## Docker's command helpers

    - Запуск контейнеров `docker-compose up -d --build`
    - Остановка контейнеров `docker-compose down`
    - Просмотреть логи `docker-compose logs --tal 25`
    - Если что-то пошло не так, проверьте настройки docker desktop и отключите WSL.

## PGADMIN connection
    - адрес подключения http://localhost:5050/
    - email: email@mail.com
    - password: 123456
    - host: host.docker.internal
    - user: root