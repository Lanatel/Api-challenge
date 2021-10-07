# Set up Api Challenge project

## Docker

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
> **NB: do not forget to add value to MAGESTIC_API_KEY key in your .env file.**

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