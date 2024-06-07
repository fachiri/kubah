#!/bin/bash

composer install
php artisan optimize
npm install
npm run build