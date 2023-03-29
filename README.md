
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


Acessar o projeto
[http://localhost:8989](http://localhost:8989)

## Using the API

For this example we are going to use the base URI of the public deployment: ***https://forceful-royal-fulmar.gigalixirapp.com***.

### Creating an Business Card

The first operation you will most likely do is the create a Bank Account. This can be done in a post request without any authorization headers.

```
POST /api/business-qrcode HTTP/1.1
Accept: application/json, */*;q=0.5
Accept-Encoding: gzip, deflate
Connection: keep-alive
Content-Length: 109
Content-Type: application/json
Host: localhost:8000
User-Agent: HTTPie/2.6.0

{
    "github_url": "https://www.example.com",
    "linkedin_url": "https://www.example.com",
    "owner_name": "John Doe"
}

HTTP/1.1 201 Created
Access-Control-Allow-Origin: *
Cache-Control: no-cache, private
Connection: close
Content-Type: text/html; charset=UTF-8
Date: Wed, 29 Mar 2023 04:39:30 GMT, Wed, 29 Mar 2023 04:39:30 GMT
Host: localhost:8000
X-Powered-By: PHP/8.2.0
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 58

```
Above you can see an example request and response to create a business/visit card.

### Get a Business Card data

Example:

```
GET /api/John Doe HTTP/1.1
Accept: */*
Accept-Encoding: gzip, deflate
Connection: keep-alive
Host: localhost:8000
User-Agent: HTTPie/2.6.0



HTTP/1.1 200 OK
Access-Control-Allow-Origin: *
Cache-Control: no-cache, private
Connection: close
Content-Type: application/json
Date: Wed, 29 Mar 2023 04:43:03 GMT, Wed, 29 Mar 2023 04:43:03 GMT
Host: localhost:8000
X-Powered-By: PHP/8.2.0
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 57

{
    "created_at": "2023-03-29T04:39:30.000000Z",
    "github_url": "https://www.example.com",
    "linkedin_url": "https://www.example.com",
    "owner_name": "John Doe",
    "qrcode_path": "ODQ8JOOyj95Wl1mH.png",
    "qrcode_url": "http://localhost:8000/storage/ODQ8JOOyj95Wl1mH.png",
    "updated_at": "2023-03-29T04:39:30.000000Z"
}

```
