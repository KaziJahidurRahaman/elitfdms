#!/bin/bash
while true
do
php artisan queue:work
 sleep 5
done
