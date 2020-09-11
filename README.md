# Local project setup

1. Move to project's directory. Copy environment file:
    ```bash
    cp .env.example .env
    ```
   
2. In .env file set DB's name, user and password.

3. Run:
    ```bash
    docker-compose up -d
    docker-compose exec app composer install
    docker-compose exec app php artisan key:generate
    ```

Access http://localhost:8000

Access to application's shell:
    ```
    docker-compose exec app bash
    ```

---

# How to use queues with Redis:

1. Install the predis/predis package via Composer:
    ```bash
    composer require predis/predis
    ```
   
2. Set `REDIS_CLIENT=predis` and `QUEUE_CONNECTION=redis` in `.env` file;

3. Run:
    ```
   docker-compose exec app bash
   php artisan queue:work
   ```
