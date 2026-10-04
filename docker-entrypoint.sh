#!/bin/bash
set -e

# Update Apache port to Render's dynamic $PORT (Render sets PORT, default 10000)
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

# Ensure permissions on runtime folders
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Ensure storage link exists for public uploads
php artisan storage:link --force || true

# Run database migrations if database connection is available
if [ -n "$DB_HOST" ] || [ -n "$DATABASE_URL" ] || [ -n "$DB_URL" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || true
fi

# Clear and optimize Laravel caches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

exec apache2-foreground
