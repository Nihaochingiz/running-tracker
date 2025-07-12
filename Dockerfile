# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем зависимости и расширения PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Включаем mod_rewrite для Apache (если нужен)
RUN a2enmod rewrite

# Копируем файлы проекта в контейнер
COPY src/ /var/www/html/

# Устанавливаем права (если нужно)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Указываем рабочую директорию
WORKDIR /var/www/html

# Порт, который будет слушать Apache
EXPOSE 80