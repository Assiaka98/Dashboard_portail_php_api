# Utiliser l'image officielle PHP avec Apache
FROM php:8.4-apache

# Installer les extensions pour la base de données (MariaDB / MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module Apache mod_rewrite (essentiel pour le routage MVC)
RUN a2enmod rewrite

# Copier les fichiers du projet dans le dossier web d'Apache
COPY . /var/www/html/

# Donner les bonnes permissions sur les fichiers
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80