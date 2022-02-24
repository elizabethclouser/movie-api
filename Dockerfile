FROM bitnami/laravel

COPY . /app
WORKDIR /app

RUN composer install
RUN ./vendor/bin/phpunit

EXPOSE 8000

CMD php -S 0.0.0.0:8000 -t public
