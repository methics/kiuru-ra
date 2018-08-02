#Installing

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
/ web root to be the public directory: kiuru-ra/public
    
        

##Composer

https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

Composer is a tool for dependency management in PHP. 
It allows you to declare the libraries your project depends 
on and it will manage (install/update) them for you.

After cloning kiuru-ra do:
    
    composer install
    

##Node & npm
https://nodejs.org/en/download/package-manager/

    npm install
    

##Environment files

    cp env.example .env
    

Add needed values in .env:

    DB_HOST
    DB_PORT
    DB_USERNAME
    DB_PASSWORD
    
    API_URL
    API_USER
    API_PASS     
    
    ADMIN_USER
    ADMIN_PASS
    
ADMIN_USER and ADMIN_PASS are used to create the first authenticated user, which you need
in order to control kiuru-ra
    
More about dotenv: https://github.com/motdotla/dotenv

##Generate app encryption key:
  
      php artisan key:generate    

##Database
You need to create a new database for kiuru-ra

    create database kiuru_ra;

##Build database tables & seed tables
go to project folder and:

    php artisan migrate
    php artisan db:seed
    
    
    