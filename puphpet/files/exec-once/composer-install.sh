#!/bin/bash

echo $PWD
cd /var/www/plistatask/
echo $PWD

echo "CREATING DATABASE AND TABELS"
php database/migration/db.php	

echo "INSERTING FAKE DATA TO DATABASE"
php database/faker/faker.php

echo "COMPOSER INSTALL"
composer install --prefer-source