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
    
https://laravel.com/docs/5.6/installation

Note: After installing Laravel, you should configure your web server's document 
/ web root to be the  public directory
    
##Composer

Composer is a tool for dependency management in PHP. 
It allows you to declare the libraries your project depends 
on and it will manage (install/update) them for you.
    
    composer global require "laravel/installer"
    
    laravel new kiuru-ra
    


##Environment files

    cp env.example .env
    
More about dotenv: https://github.com/motdotla/dotenv
    
Add variable values in .env file

##Database settings
The database configuration for your application is located at config/database.php

Most likely not needed since retrieving database settings from .env

##Build database tables
go to project folder and:

    php artisan migrate
    
##Laravel-permissions library
https://github.com/spatie/laravel-permission