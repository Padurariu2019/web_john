FROM php:8.2-cli
RUN docker-php-ext-install pdo pdo_mysql
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
EXPOSE 80
ENTRYPOINT [ "php", "-t", "./public", "-S" ]
CMD ["0.0.0.0:80"]