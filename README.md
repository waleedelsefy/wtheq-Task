# Wtheq Task - Test Project

## Overview

The Test Project is an application that allows users to conduct various tests. The project aims to facilitate the testing process and provide a user-friendly interface for analyzing results.

## Project Features

- Ability to create custom tests.
- Student registration and account management.
- Display results and statistics in a simple and effective manner.

## System Requirements

- PHP: ^8.1
- Laravel Framework: ^10.10
- Laravel Passport: ^11.8
- Laravel Sanctum: ^3.3
- Laravel Tinker: ^2.8
- Spatie Laravel Permission: ^6.1

### Development Requirements

- FakerPHP Faker: ^1.9.1
- Laravel Pint: ^1.0
- Laravel Sail: ^1.18
- Mockery Mockery: ^1.4.4
- NunoMaduro Collision: ^7.0
- PHPUnit: ^10.1
- Spatie Laravel Ignition: ^2.0

## Setup

1. Install all dependencies using Composer:

    ```bash
    composer install
    ```

2. Copy the `.env.example` file to `.env` and update the environment variables:

    ```bash
    cp .env.example .env
    ```

3. Generate the application key:

    ```bash
    php artisan key:generate
    ```

4. Database Migrate:

    ```bash
    php artisan migrate
    ```



5. Install Passport:

    ```bash
    php artisan passport:install
    ```
6. Install passport:client 
   ```bash
    php artisan passport:client --personal
    ```
## Passport Configuration in .env
Copy the following lines to your .env file:

```env
PASSPORT_PERSONAL_ACCESS_CLIENT_ID="client-id-value"
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET="unhashed-client-secret-value"
```





7. Database seed:

    ```bash
    php artisan db:seed
    ```

8. Server serv:

    ```bash
    php artisan serv
    ```

## Admin credential

```admin
email: admin@test.com
password :123456
```


## Import Postman file to Test

- [postman File](Test.postman_collection.json)

