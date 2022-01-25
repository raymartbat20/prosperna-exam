1. copy .env.example to .env
2. run "composer install"
3. create a database with a name of "prosperna_exam" with the following ENV
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=prosperna_exam
    DB_USERNAME=root
    DB_PASSWORD=
4. run php artisan migrate --seed
5. run php artisan serve
6. if "No application encryption key has been specified." error occurs run "php artisan key:generate"