
## simasbe tugas rizki putra ramadhan 12221436

fitur fitur :
1. insert data
2. update data
3. delete data
4. show data and view the inserted pdf file
5. import data Excel
6. export data pdf

   
composer update

cp .env.example .env

php artisan key:generate

composer require barryvdh/laravel-dompdf

php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"

php artisan serve

