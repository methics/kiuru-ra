# Introduction

MobileID-PHP-RA is a simple PHP Registration Authority tool for provisioning accounts on Kiuru MSSP.

See [Wiki](https://github.com/methics/mobileid-php-ra/wiki) for basic usage instructions.

# Installing

Laravel requirements

    PHP >= 7.1.3
    OpenSSL PHP Extension
    PDO PHP Extension
    Mbstring PHP Extension
    Tokenizer PHP Extension
    XML PHP Extension
    Ctype PHP Extension
    JSON PHP Extension
    
Laravel installation happens through cloning & composer install.    
Note: you should configure your web server's document 
/ web root to be the public directory: mobileid-php-ra/public
    
Laravel docs for more help: https://laravel.com/docs/5.7

You need a database for this application. Supported databases for Laravel: MySQL, PostgreSQL, SQLite, SQL Server

Apache/nginx is also needed.
# Clone this repository

    git clone https://github.com/methics/mobileid-php-ra.git




## Environment files

    cp .env.example .env
    

Add needed values in .env:

    DB_HOST
    DB_PORT
    DB_USERNAME
    DB_PASSWORD
    
    API_URL
    API_USER
    API_PASS     
    
    ADMIN_EMAIL
    ADMIN_USER
    ADMIN_PASS


    
ADMIN_USER and ADMIN_PASS are used to create the first authenticated user, which you need
in order to control mobileid-php-ra. admin_email and password are used for login.

    
More about dotenv: https://github.com/motdotla/dotenv

## Composer

https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

Composer is a tool for dependency management in PHP. 
It allows you to declare the libraries your project depends 
on and it will manage (install/update) them for you.

After cloning mobileid-php-ra do:
    
    composer install
    

## Node & npm
https://nodejs.org/en/download/package-manager/

    npm install
    



## Generate app encryption key:
  
      php artisan key:generate    

## Correct file permissions
Laravel requires storage folder to be writeable. 
https://laracasts.com/discuss/channels/general-discussion/laravel-framework-file-permission-security

Permissions depend heavily on your setup.

## Database
You need to create a new database for mobileid-php-ra

    create database mobileid-php-ra;

## Build database tables & seed tables
go to project folder and:

    php artisan migrate
    php artisan db:seed
    
    
After successful install, open your browser and go to your servers root (example http://localhost)
    
