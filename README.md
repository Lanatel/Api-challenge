# Set up Api Challenge project

## Docker

to install the application's dependencies run the following command:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

add .env file by copying .env.example
```bash
cp .env.example .env
```

> **NB: do not forget to add value to MAGESTIC_API_KEY key in your .env file.**
> 
>Keys APP_PORT and FORWARD_REDIS_PORT can be added to adjust app ports

to run docker execute next command in a root directory:
```bash
./vendor/bin/sail up
```

to ensure that all containers are running:
```bash
docker ps
```

to enter one of containers
```bash
docker exec -it api-challenge_laravel.test_1 /bin/bash
```

## Frontend
### Development
Install dependencies
```bash
npm install
```
Watch mode
```bash
npm run watch
```
Production mode
```bash
npm run prod
```

---

To update website data run the following console command :

```bash
php artisan website_data:update
```