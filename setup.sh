#!/bin/bash
composer install
cp .env.example .env
chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:$USER storage bootstrap/cache
./vendor/bin/sail down --volumes
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan storage:link
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan l5-swagger:generate
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan cache:clear
