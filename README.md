
## Clone the repository


## Install php dependencies
```
composer install
```

## Copy .env.example to .env, add database credential and generate application key
```
php artisan key:generate
```

## Run migration for migrating default tables
```
php artisan migrate
```

## Run seeder for adding 3000 records
```
php artisan db:seed
```

## Make symbolic link for running project on apache server
```
ln -s {{project-root-path}}/public /var/www/html/{{project-name}}
```

## Run project on localhost
```
http://localhost/{{project-name}}
```