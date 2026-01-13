# Dockerfile — SoftEdge Corporation (2025) - Multi-Platform Support with React
FROM php:8.3-apache

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libpng-dev \
        libonig-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libxml2-dev \
        libcurl4-openssl-dev \
        libssl-dev \
        libicu-dev \
        libsqlite3-dev \
        git \
        curl \
        wget \
        cron \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) \
            mbstring \
            exif \
            pcntl \
            bcmath \
            gd \
            zip \
            xml \
            curl \
            intl \
            mysqli \
            pdo \
            pdo_mysql \
            pdo_sqlite \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js (for building React frontend assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && apt-get install -y nodejs && \
    npm --version && node --version

# Install security headers and optimizations
RUN a2enmod headers rewrite

# Fix Apache MPM issue - disable all MPMs except prefork
RUN a2dismod mpm_event mpm_worker && \
    a2enmod mpm_prefork

# Create logs directory
RUN mkdir -p /var/www/html/logs && \
    chown -R www-data:www-data /var/www/html/logs

# Copy custom Apache config for Railway
RUN echo '<VirtualHost *:${PORT}>' > /etc/apache2/sites-available/000-default.conf && \
    echo '    ServerAdmin webmaster@localhost' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    DocumentRoot /var/www/html' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    <Directory /var/www/html>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Options -Indexes +FollowSymLinks' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        # Security headers' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Header always set X-Frame-Options DENY' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Header always set X-Content-Type-Options nosniff' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Header always set X-XSS-Protection "1; mode=block"' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Header always set Referrer-Policy "strict-origin-when-cross-origin"' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Header always set Content-Security-Policy "default-src '\''self'\''; script-src '\''self'\'' '\''unsafe-inline'\'' https://unpkg.com https://cdn.tailwindcss.com; style-src '\''self'\'' '\''unsafe-inline'\'' https://fonts.googleapis.com; font-src '\''self'\'' https://fonts.gstatic.com; img-src '\''self'\'' data: https:; connect-src '\''self'\''"' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# Copy the site
WORKDIR /var/www/html
COPY . .

# Create storage dir for SQLite and logs
RUN mkdir -p /var/www/html/storage && \
    mkdir -p /var/www/html/logs

# Install PHP dependencies if composer.json exists
RUN if [ -f composer.json ]; then composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader; fi

# Build React frontend if Node project exists
RUN if [ -f package.json ]; then \
      echo "Building React frontend..." && \
      npm install && \
      npm run build && \
      echo "React build completed successfully"; \
    else \
      echo "No package.json found - skipping React build"; \
    fi

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 775 /var/www/html/logs /var/www/html/storage && \
    find /var/www/html -type f -name "*.php" -exec chmod 644 {} \; && \
    find /var/www/html -type f -name "*.js" -exec chmod 644 {} \; && \
    find /var/www/html -type f -name "*.css" -exec chmod 644 {} \;

# Configure PHP for production
RUN echo "upload_max_filesize = 10M" > /usr/local/etc/php/conf.d/custom.ini && \
    echo "post_max_size = 10M" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "display_errors = Off" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/conf.d/custom.ini && \
    echo "error_log = /var/www/html/logs/php_errors.log" >> /usr/local/etc/php/conf.d/custom.ini

# Configure ports for different platforms
ENV PORT=8080
EXPOSE $PORT

# Configure Apache for dynamic port (handled by startup script)
# Port will be set dynamically by the startup script based on environment

# Health check
HEALTHCHECK --interval=240s --timeout=10s --start-period=30s --retries=3 \
    CMD curl -f http://localhost:$PORT/health.php || exit 1

# Create startup script for multi-platform support
RUN echo '#!/bin/bash' > /start.sh && \
    echo '' >> /start.sh && \
    echo '# Multi-platform startup script for SoftEdge with React' >> /start.sh && \
    echo 'echo "Starting SoftEdge Corporation Website with React..."' >> /start.sh && \
    echo '' >> /start.sh && \
    echo '# Check if running on Railway (has PORT env var)' >> /start.sh && \
    echo 'if [ -n "$PORT" ]; then' >> /start.sh && \
    echo '    echo "Detected Railway deployment - using Apache on port $PORT"' >> /start.sh && \
    echo '    sed -i "s/8080/$PORT/g" /etc/apache2/sites-available/000-default.conf' >> /start.sh && \
    echo '    sed -i "s/8080/$PORT/g" /etc/apache2/ports.conf' >> /start.sh && \
    echo '    apache2-foreground' >> /start.sh && \
    echo 'elif [ -n "$RENDER" ]; then' >> /start.sh && \
    echo '    echo "Detected Render deployment - using PHP built-in server"' >> /start.sh && \
    echo '    PORT=${PORT:-10000}' >> /start.sh && \
    echo '    php -S 0.0.0.0:$PORT -t .' >> /start.sh && \
    echo 'else' >> /start.sh && \
    echo '    echo "Default deployment - using Apache"' >> /start.sh && \
    echo '    apache2-foreground' >> /start.sh && \
    echo 'fi' >> /start.sh && \
    chmod +x /start.sh

# Start the application
CMD ["/start.sh"]
