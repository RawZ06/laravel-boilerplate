# -- Stage 1: Build Assets (Frontend) --
FROM node:22-alpine AS frontend-builder
WORKDIR /app
COPY package.json pnpm-lock.yaml* ./
RUN npm install
COPY . .
RUN npm run build

# -- Stage 2: PHP Application (Backend) --
FROM php:8.4-fpm-alpine

# Arguments
ARG user=laravel
ARG uid=1000

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    icu-dev \
    oniguruma-dev \
    postgresql-dev \
    linux-headers

RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    opcache

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user
RUN adduser -G www-data -u $uid -h /home/$user -D $user

# Set working directory
WORKDIR /var/www

# Fix permissions for the working directory
RUN chown $user:www-data /var/www

# Copy application source
COPY --chown=$user:www-data . .

# Copy built assets from frontend-builder
COPY --from=frontend-builder --chown=$user:www-data /app/public/build ./public/build

# Install PHP dependencies
USER $user
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions for storage and bootstrap/cache
USER root
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R $user:www-data storage bootstrap/cache

USER $user

EXPOSE 9000
CMD ["php-fpm"]
