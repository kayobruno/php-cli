#!/bin/bash

composer install

cp .env.example .env

php-fpm

exec "$@"