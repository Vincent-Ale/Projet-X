FROM php:8.3-apache

# Installez les extensions PHP nécessaires ici
RUN docker-php-ext-install pdo pdo_mysql

# Activez mod_rewrite pour Apache
RUN a2enmod rewrite

# Copiez les fichiers de configuration Apache (facultatif)
# COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Définissez le répertoire de travail
WORKDIR /var/www/html