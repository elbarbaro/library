FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install php extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan commands 
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user .composer && \
    chown -R $user:$user /home/$user 

# Set working directory (cd /var/www)
WORKDIR /var/www

# Change current user to www
USER $user