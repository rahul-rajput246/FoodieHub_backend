#!/bin/bash
set -e

# Update Apache port to Render's dynamic $PORT (Render sets PORT, default 10000)
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

# Ensure permissions on runtime folders and database
touch /var/www/html/database/database.sqlite || true
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Ensure storage link exists for public uploads
php artisan storage:link --force || true

# Run database migrations and seeders
echo "Setting up database tables and initial data..."
php artisan migrate --force || true
php artisan db:seed --force || true

# Clear and optimize Laravel caches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

echo "Starting Apache web server on port ${PORT}..."
exec apache2-foreground
