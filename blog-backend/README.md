## Installation

- composer install 
- cp .env.example .env` && `php artisan key:generate`
- Configuration base de données dans `.env`
- Dans `.env` mettre `QUEUE_CONNECTION=database`
- Configuration du BASE_URL dans `.env` pour eviter les erreurs pour le package de swagger
- `php artisan queue:table`
- `php artisan migrate`
- `php artisan passport:install`
- `php artisan l5-swagger:generate`
- Ouvrir un terminal et y taper la commande `php artisan queue:work`
- `php artisan serve`
