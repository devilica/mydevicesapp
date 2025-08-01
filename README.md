# MyDevicesApp - Laravel 8 REST API

This is a Laravel 8 REST API project for managing users and devices with authentication using Laravel Passport and Dockerized with Laravel Sail.

## Prerequisites

- Docker & Docker Compose installed on your machine  
- Composer installed

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/devilica/mydevicesapp.git
cd mydevicesapp
````

### 2. Setup environment

```bash
cp .env.example .env
```

* Adjust `.env` file to set your database credentials and mail settings.

### 3. Start Laravel Sail (Docker environment)

```bash
./vendor/bin/sail up -d
```

### 4. Enter the application container shell

```bash
docker exec -it mydevicesapp-laravel.test-1 /bin/bash
```

### 5. Setup application inside the container

```bash
php artisan key:generate
composer install
php artisan passport:install
php artisan migrate
```

### 6. Generate Passport password grant client (if needed)

```bash
php artisan passport:client --password
```

Update your `.env` file with the generated Passport client credentials:

```env
PASSPORT_CLIENT_ID=3
PASSPORT_CLIENT_SECRET=PPfTg8DKIIrMW6ilwgSzlJf9AOnyXpu7hy8B6qOx
```

### 7. Access the application

Open your browser and visit:

```
http://localhost
```
## API Documentation

You can find the Postman documentation for all API endpoints here:  
[MyDevicesApp API Postman Docs](https://documenter.getpostman.com/view/21137389/2sB3BALs9N)

...

## Database Dump

This project includes a database dump file for easy setup:  
`Dump20250801.sql`

You can import it into your MySQL database to have the necessary tables and sample data.

...