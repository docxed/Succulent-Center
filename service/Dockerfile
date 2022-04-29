FROM composer as builder
WORKDIR /app
COPY composer.* ./
RUN composer install

FROM php:7.4-apache
COPY ./ /var/www/html
COPY --from=builder /app/vendor /var/www/html/vendor
RUN docker-php-ext-install pdo pdo_mysql