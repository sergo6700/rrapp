FROM php:7.2-fpm

COPY . /var/www

ADD deployment/local/configs/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www

RUN apt-get update && apt-get install --assume-yes zlib1g-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev

RUN docker-php-ext-install pdo pdo_mysql zip
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd

RUN apt-get --assume-yes install git
RUN apt-get install unzip

RUN apt-get install -y jpegoptim \
                       optipng \
                       pngquant \
                       gifsicle \
                       webp

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

CMD composer install --working-dir=/var/www && php artisan key:generate && php-fpm
