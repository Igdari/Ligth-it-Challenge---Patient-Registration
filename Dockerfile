FROM php:8.2-fpm

# Instalar dependencias necesarias para Composer y Laravel
RUN apt-get update && apt-get install -y curl unzip libpng-dev libjpeg-dev libfreetype6-dev

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Instalar extensiones de PHP necesarias (ajusta según tus necesidades)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copiar el código de la aplicación
WORKDIR /var/www
COPY . .
