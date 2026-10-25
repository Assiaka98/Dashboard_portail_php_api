FROM php:8.4-apache

# Installer les extensions pour la base de données
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module de réécriture d'URL (indispensable pour le MVC)
RUN a2enmod rewrite

# Définir le DocumentRoot d'Apache sur /var/www/html 
# (Remplacez par /var/www/html/public si votre index.php est dans un sous-dossier public)
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Autoriser les fichiers .htaccess et l'accès global (résout l'erreur 403)
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/override.conf && \
a2enconf override

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Assurer les bonnes permissions pour le serveur web
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80