FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libmagickwand-dev \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev \
    locales \
    libzip-dev \
    libonig-dev \
    zlib1g-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    wget \
    imagemagick

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mysqli zip mbstring intl gd

RUN pecl install imagick \
    && docker-php-ext-enable imagick

RUN pecl install -o -f xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

COPY ./php.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://phar.phpunit.de/phpunit-9.0.phar && \
        chmod +x phpunit-9.0.phar && \
        mv phpunit-9.0.phar /usr/local/bin/phpunit

RUN wget http://codeception.com/codecept.phar && \
        chmod +x codecept.phar && \
        mv codecept.phar /usr/local/bin/codecept

EXPOSE 9000
CMD ["php-fpm"]
