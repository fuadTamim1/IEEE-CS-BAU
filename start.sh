php artisan migrate --force
php artisan db:seed --class=AppSettingsSeeder
php artisan storage:link
php artisan filament:optimize