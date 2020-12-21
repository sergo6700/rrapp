#!/usr/bin/env bash

echo 'chmod'
chmod -R 775 ./node_modules

echo 'npm install'
npm install

echo 'npm run prod'
npm run prod


#chown -R deploy ./
#chgrp -R www-data ./
