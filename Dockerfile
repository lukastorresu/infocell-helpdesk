# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Atualiza o sistema, instala Node.js (v20) e dependências do PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Aponta o servidor para a pasta /public do seu projeto
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia todos os arquivos do projeto
WORKDIR /var/www/html
COPY . .

# Instala as dependências do PHP
RUN composer install --optimize-autoloader --no-dev

# Compila os assets do Frontend (Tailwind/Vite)
RUN npm install && npm run build

# Cria as pastas que o Git ignora e dá as permissões corretas
RUN mkdir -p /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
    
# Expõe a porta 80
EXPOSE 80