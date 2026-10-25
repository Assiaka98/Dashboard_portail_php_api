FROM php:8.4-apache

# Installer les extensions pour la base de données
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module de réécriture d'URL (indispensable pour le MVC)
RUN a2enmod rewrite

# Forcer Apache à pointer vers /var/www/html et autoriser les accès complets (.htaccess)
RUN echo '<VirtualHost *:80>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Copier tous les fichiers du projet dans le dossier web du conteneur
COPY . /var/www/html/

# Donner les bonnes permissions à l'utilisateur d'Apache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80