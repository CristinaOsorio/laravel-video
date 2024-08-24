# Usa una imagen base con PHP 7.2
FROM php:7.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    libgmp-dev unzip git

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd zip pdo pdo_mysql

# Establece valores personalizados para PHP
RUN echo "upload_max_filesize=100M" > /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/uploads.ini

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el contenido de la aplicación
COPY . .

# Instalar dependencias de PHP
RUN composer install

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Iniciar el servidor PHP-FPM
CMD ["php-fpm"]
