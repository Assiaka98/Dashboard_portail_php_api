FROM php:8.4-apache

# Installer les extensions pour la base de données
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module de réécriture d'URL
RUN a2enmod rewrite

# Rediriger proprement le DocumentRoot vers le dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Autoriser explicitement les fichiers .htaccess et l'accès global
RUN echo '<Directory /var/www/html/public/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Copier les fichiers du projet
COPY . /var/www/html/

# Ajuster les permissions uniquement si nécessaire (ex: dossier de logs ou uploads si existant)
RUN chown -R www-data:www-data /var/www/html/public

EXPOSE 80