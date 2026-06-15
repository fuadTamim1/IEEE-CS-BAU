#!/bin/bash
# Make sure this file has executable permissions, run `chmod +x run-cron.sh`

# This block of code runs the Laravel scheduler every minute
while [ false ]; # set false to true if you want to run the scheduler
    do
        echo "Running the scheduler..."
        php artisan schedule:run --verbose --no-interaction &
        sleep 60
    done