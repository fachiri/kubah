#!/bin/bash

# Lakukan git pull dari repositori
git pull origin main

# Instal dependensi menggunakan Composer
composer install

# Optimalkan aplikasi Laravel
php artisan optimize

# Instal dependensi JavaScript menggunakan npm
npm install

# Build aplikasi frontend (jika diperlukan)
npm run build