FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y zlib1g-dev && \
    apt-get install -y zip && \
    apt-get install -y libpq-dev && \
    apt-get install -y  libpng-dev && \
    docker-php-ext-install gd pdo_mysql pdo_pgsql 

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer bin to PATH
ENV PATH="/usr/local/bin:$PATH"

RUN chown -R www-data:www-data /var/www

WORKDIR /var/www