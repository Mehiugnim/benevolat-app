# Étape 1 : Utilise l'image PHP officielle avec Apache
FROM php:8.2-apache

# Installe les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Active le mod_rewrite d'Apache
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie les fichiers de ton projet dans le conteneur
COPY . /var/www/html

# Définit le dossier de travail
WORKDIR /var/www/html

# Droits sur les dossiers nécessaires
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Installe les dépendances Laravel
RUN composer install --optimize-autoloader --no-interaction

# Cache la configuration
RUN php artisan config:clear && php artisan config:cache

# Génére la clé d'application
RUN php artisan key:generate

# Ouvre le port 80
EXPOSE 80
