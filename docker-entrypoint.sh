#!/bin/bash
set -e

# Wait for the MySQL server to be ready
while ! mysqladmin ping -h"db" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
    sleep 1
done

# Import the SQL file
mysql -h"db" -u"$DB_USERNAME" -p"$DB_PASSWORD" quotesdb < /docker-entrypoint-initdb.d/quotesdb.sql

# Start Apache in the foreground
apache2-foreground
