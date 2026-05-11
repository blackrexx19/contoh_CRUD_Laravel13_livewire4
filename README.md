<h1 align="center" id="title">Contoh Laravel 13 dan Livewire 4</h1>

setelah melakukan clone

- Install Composer
  ```
  composer install
  ```
- Instal nodejs
  ```
  npm install
  ```
- Generate key laravel
  ```
  php artisan key:generate
  ```
- Storage Link
  ```
  php artisan storage:link
  ```
- Setting env dengan mengatur database
  - jika mysql
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=namadatabase
        DB_USERNAME=usermysql
        DB_PASSWORD=passwordmysql
        ```
  - jika postgre
        ```
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=namadatabase
        DB_USERNAME=userpostgre
        DB_PASSWORD=passwordpostgre
        ```
  - jika untuk docker
        ```
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=namadatabase
        DB_USERNAME=userpostgre
        DB_PASSWORD=passwordpostgre
        CACHE_DRIVER=file
        SESSION_DRIVER=file
        ```
- Migrasi database
  ```
  php artisan migrate
  ```
