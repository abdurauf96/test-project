##  Library project (TEST)

API was developed for publishers to manage (insert, edit and delete) their books in this project, and all the books were displayed with ajax pagination on the home page. also developed API documentation with swagger

- installed laravel 8.
- database structure implemented, created migration files
- created many to many relationships methods for tables
- developed API with documentation
- display books with ajax pagination on front page

api documentation is available in this route - _/api/documentation_

## Requirements

- PHP >=7.4

## Installation
```
//clone project and run composer install command
composer install

// create .env file and run this command
php artisan key:generate

// setup database configuration in .env file and run this commands
php artisan migrate
php artisan db:seed

//add to .env file your base api url ex: http://localhost:8000/api
L5_SWAGGER_CONST_HOST=YOUR_BASE_API_URL

//clear cache
php artisan config:cache

//generate api documentation
php artisan l5-swagger:generate

```