
# How to run the project

1. Run the containers (start the project): ```docker-compose up -d```
2. Accessible website http://localhost:8001
3. Get inside the container (your application to run commands): ```docker exec -it app-php bash```


# Setup for the first time

1. Create environment file (if .env file does not already exists): ```cp .env.dist .env```
2. Get inside the container (your application to run commands): ```docker exec -it app-php bash```
3. Run ```composer install```


# Helpers

1. Get inside the container.
2. Generate key: ```php artisan key:generate```