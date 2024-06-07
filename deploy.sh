#!/bin/bash

# Instal dependensi menggunakan Composer
composer install

# Optimalkan aplikasi Laravel
php artisan optimize

# Instal dependensi JavaScript menggunakan npm
npm install

# Build aplikasi frontend (jika diperlukan)
npm run build