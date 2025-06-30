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

# Donne les bons droits à Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Installe les dépendances Laravel
RUN composer install --optimize-autoloader --no-interaction

# Supprime les commandes artisan qui nécessitent .env lors du build
# Ces commandes seront exécutées dynamiquement au démarrage du conteneur
# Render fournira les variables comme APP_KEY, DB_HOST, etc.

# Expose le port par défaut
EXPOSE 80

# Commande exécutée au lancement (PAS pendant le build !)
CMD php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80
