FROM php:8.2-apache

RUN apt-get update

# Install PostgreSQL and MySQL PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Install GD extension for image manipulation
RUN apt-get install -y libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install gd

# Install YAML extension
RUN apt-get install -y libyaml-dev \
    && pecl install yaml \
    && docker-php-ext-enable yaml

# Install git
RUN apt-get install -y git

# Install zip extension
RUN apt-get install -y libzip-dev && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Modify www-data user
RUN usermod -u 1000 www-data

# Enable Apache rewrite module
RUN a2enmod rewrite

