# Usa una imagen base de PHP 8.3 con Apache
FROM php:8.2-apache

# Instalar dependencias y extensiones de PHP
RUN apt-get update && apt-get install -y \
    unixodbc-dev \
    libgssapi-krb5-2 \
    && pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Configura el entorno de Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Copia los archivos del proyecto
COPY . /var/www/html

# Establece los permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Configurar Apache
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80

