#!/bin/bash

cd ~/public_html

# Laravel post-deploy steps
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
