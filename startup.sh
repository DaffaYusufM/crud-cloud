#!/bin/bash

# Copy custom nginx config
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Ensure nginx directory structure exists
mkdir -p /etc/nginx/sites-enabled

# Create symlink
ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Ensure PHP-FPM is running (INI YANG PERLU DITAMBAH)
pkill php-fpm 2>/dev/null || true
/usr/sbin/php-fpm8.2 -D

# Test nginx config
nginx -t

# Restart nginx (gunakan start bukan restart, karena mungkin belum running)
service nginx stop 2>/dev/null || true
service nginx start

# Check if services are running
echo "=== Service Status ==="
ps aux | grep nginx
ps aux | grep php-fpm

# Keep the container running
tail -f /dev/null