FROM php:8.3-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer le mod_rewrite d'Apache pour le routage MVC
RUN a2enmod rewrite

# Installer les dépendances supplémentaires pour la configuration SSL
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && a2enmod ssl \
    && a2ensite default-ssl

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le contenu de votre application dans le conteneur
COPY ./ /var/www/html

# Donner les bonnes permissions
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 443 pour HTTPS
EXPOSE 443