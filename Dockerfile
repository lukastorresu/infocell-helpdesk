# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Atualiza o sistema e instala as dependências necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Habilita o mod_rewrite do Apache (essencial para as rotas do Laravel funcionarem)
RUN a2enmod rewrite

# Aponta o servidor para a pasta /public do seu projeto
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instala o Composer diretamente no container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia todos os arquivos do seu projeto para dentro do servidor
WORKDIR /var/www/html
COPY . .

# Instala as dependências do PHP (ignorando pacotes de desenvolvimento como o Dusk)
RUN composer install --optimize-autoloader --no-dev

# Dá as permissões corretas para o Laravel poder salvar logs e arquivos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Avisa o Render que o Apache vai usar a porta 80 internamente
EXPOSE 80