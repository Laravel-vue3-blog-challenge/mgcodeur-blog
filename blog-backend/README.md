## Installation

- composer install 
- cp .env.example .env` && `php artisan key:generate`
- configuration base de données dans `.env`
- configuration du BASE_URL dans `.env` pour eviter les erreurs pour le package de swagger
- `php artisan migrate`
- `php artisan passport:install`
- `php artisan l5-swagger:generate`
- `php artisan serve`
