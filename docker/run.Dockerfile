FROM php:5.5-cli

RUN apt-get update && apt-get install -y \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng12-dev \
      libmcrypt-dev \
      libc-client2007e-dev \
      libkrb5-dev \
      libcurl4-openssl-dev \
      unzip \
      rsync \
      git \
      netcat && \
    docker-php-ext-install curl json mcrypt bcmath pdo pdo_mysql && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install imap && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | \
      php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-autoloader --no-scripts

COPY ./ /var/www/
COPY docker/run.run.sh /run.run.sh

EXPOSE 8000

ENTRYPOINT [ "/bin/bash", "/run.run.sh" ]
CMD [ "php", "artisan", "serve", "--host=0.0.0.0" ]