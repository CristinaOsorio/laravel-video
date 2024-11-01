<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# VideoApp

Welcome to the VideoApp, where users can upload, share, and explore videos from others. This project is designed with a focus on usability and an attractive interface.

## Índice

- [Features](#features)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)
- [Installation](#installation)
- [Uso](#uso)
- [Contribución](#contribución)
- [Licencia](#licencia)

## Features

- **User Registration and Authentication:** Users can register and log into the application.
- **Video Upload:** Users can upload videos with custom thumbnails.
- **Video Viewing:** Videos can be explored on a user’s channel.
- **Comment System:** Users can comment on videos.
- **Likes and Dislikes System:** Users can express their opinions on videos.
- **Search Filters:** Videos can be filtered by popularity and recency.

## Tecnologías Utilizadas

- **Frontend:** HTML, CSS, JavaScript, Bootstrap 4
- **Backend:** Laravel 5.6
- **Database:** MySQL
- **Other Tools:** FontAwesome for icons, SCSS for styling


## Installation

### Step 1: Configure the `.env` File
1. Access the `.env` file located in the project root.
2. Set the following environment variables to match your development environment:

    ```env
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:...
    APP_DEBUG=true
    APP_URL=http://localhost
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_PASSWORD=password
    ```

### Step 2: Build the Docker Image
1. Run the following command to build the Docker image:

    ```bash
    docker-compose build
    ```

### Step 3: Start the Services with Docker Compose
1. Start the services (application and database) with the following command:

    ```bash
    docker-compose up -d
    ```

### Step 4: Access the Application Container
1. Access the application container:

    ```bash
    docker-compose exec app bash
    ```

### Step 5: Install PHP Dependencies
1. Inside the container, install the PHP dependencies using Composer:

    ```bash
    composer install
    ```

### Step 6: Exit the Container
1. Exit the container session:

    ```bash
    exit
    ```

### Step 7: Copy the SQL File to the Container
1. Copy the `database.sql` file to the container:

    ```bash
    docker cp path/to/database.sql <container_id>:/tmp/database.sql
    ```

### Step 8: Import the Database
1. Access the container again:

    ```bash
    docker exec -it <container_id> bash
    ```
2. Import the database using the following command:

    ```bash
    mysql -u user -p laravel < /tmp/database.sql
    ```
3. Remove the SQL file from the container:

    ```bash
    rm /tmp/database.sql
    ```

### Step 9: Set Permissions
1. Ensure the `storage` directory has the correct permissions by running the following command:

    ```bash
    chmod o+w ./storage/ -R
    ```

