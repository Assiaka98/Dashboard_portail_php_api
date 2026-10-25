FROM php:8.4-apache

# Installer les extensions pour la base de données
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module de réécriture d'URL
RUN a2enmod rewrite

# Configuration complète d'Apache pour le dossier public et le routage MVC
RUN echo '<VirtualHost *:80>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html/public\n\
    DirectoryIndex index.php\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
        \n\
        RewriteEngine On\n\
        RewriteCond %{REQUEST_FILENAME} !-f\n\
        RewriteCond %{REQUEST_FILENAME} !-d\n\
        RewriteRule ^(.*)$ index.php [QSA,L]\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Copier tous les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Donner les bonnes permissions à l'utilisateur d'Apache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80