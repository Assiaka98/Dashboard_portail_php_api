FROM php:8.4-apache

# Installer les extensions pour la base de données
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module de réécriture d'URL
RUN a2enmod rewrite

# Configurer Apache pour autoriser les fichiers .htaccess
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/override.conf && \
a2enconf override

# Copier les fichiers du projet
COPY . /var/www/html/

# Donner les permissions à l'utilisateur web
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80