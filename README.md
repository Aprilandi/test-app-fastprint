
# Test App For Fast Print Indonesia

This project is for a program to get a data from Fast Print API. List of the Data from API

- Product ID
- Product Name
- Product Price
- Product Category
- Product Status

> **Note :**
> Data from API will be saved into local database, to access Fast Print's API you need to go to [Fast Print Test API](https://recruitment.fastprint.co.id/tes/api_tes_programmer) using a POST method and username & password field. (But in this project you just need to click "Ambil Data" button to access the API)
>
> 
## Clone Repo

To run this project first you need to clone this repo first.

```bash
  https://github.com/Aprilandi/test-app-fastprint.git
```

After you clone this repo, locate to folder test-app-fastprint

## Composer

Run this command on terminal
```bash
  composer install
  mv .env.example .env
```

## Database

Create database on MySql and run Xampp or another Database engine
```bash
  > create database and name it 
  test-app
```

## Migration

After you create the database go to .env file and change the database name

```bash
  DB_DATABASE=laravel -> DB_DATABASE=test-app
```
> **Note :**
> Don't forget to save the file after the changes.

After that run this command

```bash
  php artisan migrate --seed
```
> **Note :**
> before running the command, make sure you have the correct project folder in your terminal

## Run project

Before running the project type this command 

```bash
  php artisan key:generate
```

After that run this command to run the project

```bash
  php artisan serve
```
