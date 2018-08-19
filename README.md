Restful API Test
========================

Minimalistic restful api with Symfony.


```
clone git: git clone https://github.com/sven-neumann/RestTest.git RestTest
cd RestTest
composer install

# Edit database server settings (mysql)
nano app/config/parameters.yml

# create database and seed 
php bin/console doctrine:database:create
>> Created database `rest_test` for connection named default

php bin/console doctrine:schema:update --force
>> Updating database schema...
>> Database schema updated successfully! "2" queries were executed


# run local
php bin/console server:run

# seed DB with some authors and books
# open new terminal and navigate to RestTest
cd RestTest
php -f forLazyPeople.php

# open Postman, check requests: https://www.getpostman.com/collections/214f22d6c4197fa730ab

```


