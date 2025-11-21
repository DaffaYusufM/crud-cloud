#!/bin/bash

# Copy custom nginx config
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Ensure nginx directory structure exists
mkdir -p /etc/nginx/sites-enabled

# Create symlink
ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Test nginx config
nginx -t

# Restart nginx
service nginx restart

# Keep the container running
tail -f /dev/null