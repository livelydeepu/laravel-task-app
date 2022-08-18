# <p align="center"><a href="https://github.com/livelydeepu/laravel-task-app.git" target="_blank">Task Management</a></p>

## About Task Management

Task Management is a simple web application developed using Laravel and MySQL database.
Features includes:

- User Creation with roles as admin or user.
- Project Creation.
- Task Creation under the project.
- Dashboard.

Task Management manages all CRUD operations and drag and drop reorder table row feature.

## Installation

Please check the official Laravel installation guide for server requirements before you start.

Clone the repository

    git clone https://github.com/livelydeepu/laravel-task-app.git

Switch to the repo folder

    cd laravel-task-app

Install all the dependencies using composer

    composer install
    composer update

Copy the example env file and make the required configuration changes in the .env file

    copy .env.example .env

Generate a new application key

    php artisan key:generate

Create the symbolic link for file storage

    php artisan storage:link

Create database in MySQL

Set the database connection in .env

Run the database migrations

    php artisan migrate

Run the database seeder

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Command list

    git clone https://github.com/livelydeepu/laravel-task-app.git
    cd laravel-realworld-example-app
    composer install
    composer update
    copy .env.example .env
    php artisan key:generate
    php artisan storage:link
    create database in MySQL
    php artisan migrate
    php artisan db:seed
    php artisan serve