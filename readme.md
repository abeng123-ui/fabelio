Project Specification and Requirements
----
- Laravel Framework 5.5.50
- PHP 7.0.16
- MySQL 5.5
- Apache
- Composer
---------------
How to run
----
- Install XAMPP 7.0.16 version to get all requirement tools in simpliest way, source: https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.0.6/
- Start Apache and MySQL in XAMPP Control Panel
- Install Composer, source https://getcomposer.org/download/
- In CMD Terminal, go to XAMPP folder htdocs path and clone this project
```bash
ACER@DESKTOP-8U67HAK MINGW64 /d/XAMPP/htdocs
$ git clone https://github.com/abeng123-ui/fabelio
```
- create database on localhost/phpmyadmin or with your DBMS application
- In the root of folder, you will find file .env-dist, copy, create file .env, and setup your host and database name, example :
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_fabelio
DB_USERNAME=root
DB_PASSWORD=
```
- In CMD Terminal, go to project path, and run command "composer install"
```bash
ACER@DESKTOP-8U67HAK MINGW64 /d/XAMPP/htdocs/fabelio (master)
$ composer install
```
- Run command "php artisan migrate" to create required table
```bash
ACER@DESKTOP-8U67HAK MINGW64 /d/XAMPP/htdocs/fabelio (master)
$ php artisan migrate
```
- Test application with unit test, run command "vendor/bin/phpunit"
```bash
ACER@DESKTOP-8U67HAK MINGW64 /d/XAMPP/htdocs/fabelio (master)
$ vendor/bin/phpunit
```
- Test application from UI, open browser, and write "localhost/fabelio/public"

## If there is any question, please send me an email to akbarsyidiq@gmail.com
