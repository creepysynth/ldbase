# Local project setup

Move to project's directory. Copy environment file:
```bash
cp .env.example .env
```

Run:
```bash
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
```

Access http://localhost:8000