
# John Virtual Card - Buzzvel 2023 Dev Team Test

# This is a API to work as the backend of the "QR Code Image Generator"

Clone the repository
```sh
git clone https://github.com/guhmerces/buzzvel-hiring-test-backend.git
```

Access the new created directory


Create the .env file
```sh
cp .env.example .env
```


Set environment variables in .env
```dosini
APP_NAME="QR Code Image Generator"
APP_URL=http://localhost:8989
QRCODE_BASE_URL=http://localhost:3000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```


Build and start containers
```sh
docker-compose up -d
```

Access the container
```sh
docker-compose exec app bash
```

Install dependencies
```sh
composer install
```

Link storage to public dir
```sh
php artisan storage:link
```

Run tests
```sh
php artisan test
```

Generate project's key
```sh
php artisan key:generate
```


Access the program
[http://localhost:8989](http://localhost:8989)
