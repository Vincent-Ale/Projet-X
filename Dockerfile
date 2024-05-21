FROM php:8.3-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer le mod_rewrite d'Apache pour le routage MVC et SSL
RUN a2enmod rewrite ssl

# Installer les dépendances supplémentaires pour la configuration SSL
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && a2ensite default-ssl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer OpenSSL
RUN apt-get update && apt-get install -y openssl

# Créer le répertoire pour les certificats
RUN mkdir -p /etc/ssl/certs /etc/ssl/private

# Générer un certificat SSL auto-signé
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/ssl-cert-snakeoil.key \
    -out /etc/ssl/certs/ssl-cert-snakeoil.pem \
    -subj "/C=US/ST=State/L=City/O=Organization/OU=OrgUnit/CN=localhost"

# Copier le reste du contenu de votre application dans le conteneur
COPY . /var/www/html

# Donner les bonnes permissions au contenu copié
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Copier init.sql dans le répertoire d'initialisation de la base de données
COPY init.sql /docker-entrypoint-initdb.d/

# Donner les bonnes permissions à init.sql
RUN chmod 644 /docker-entrypoint-initdb.d/init.sql

# Installer les dépendances Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --verbose

# Exposer le port 443 pour HTTPS
EXPOSE 443

CMD ["apache2-foreground"]
