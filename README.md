# symfony-form-collection-example
Small example of dynamically adding and removing collection data in Symfony.

## Installation

Components

```
composer install
```

Database: Create a MySQL or PostgreSQL database and adjust the `DATABASE_URL` in `.env` file. After your database connection has been set up execute the below command and confirm it.

```
php bin/console doctr:migr:migr
```

## Show result
Just start the symfony built-in webserver or place this repo on your webserver and call the site (`/public`). 
