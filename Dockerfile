# Menggunakan base image PHP 8.3 dengan Apache
FROM php:8.4-apache

# Instal dependensi sistem dan ekstensi PHP yang diperlukan
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql gd zip

# Aktifkan Modul Rewrite Apache (wajib untuk routing Laravel)
RUN a2enmod rewrite

# Konfigurasi batas upload file di PHP (Default php:8.4-apache adalah 2M)
RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Salin konfigurasi VirtualHost Apache kustom
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Pasang Composer (Perbaikan: Menggunakan tanda = setelah --from)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tentukan direktori kerja di dalam kontainer
WORKDIR /var/www/html

# Salin seluruh berkas proyek ke dalam kontainer
COPY . .

# Atur izin folder storage agar bisa ditulis oleh Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80
EXPOSE 80