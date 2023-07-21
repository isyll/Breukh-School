FROM php:8.1.21

RUN apt-get update && apt-get install -y git unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . /app
RUN composer install
CMD ["php","artisan","serve","--host=0.0.0.0"]