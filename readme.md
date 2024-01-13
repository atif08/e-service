# E Service System

A application with tech stack Inertia.js,vue.js,laravel.

## Installation

Clone the repo locally:

```sh
git clone https://github.com/atif08/e-service.git
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Email configuration:

```sh
setup mail driver to 'log' or 'mailhog' what you like
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit e service in your browser, and login with as a manager:

- **Username:** admin@example.com
- **Password:** 12345678

You can access backend as a employee role:

- **Username:** employee@example.com
- **Password:** 12345678

You can assing role from user section.

Applicants list:
- **http://127.0.0.1:8000/certified-users

System Users list:
- **http://127.0.0.1:8000/users

Prices list:
- **http://127.0.0.1:8000/prices

