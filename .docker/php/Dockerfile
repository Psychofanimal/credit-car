FROM php:8.2-fpm

ARG TIMEZONE
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

COPY .docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini
COPY .docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

RUN apt-get update
RUN apt-get install -y --no-install-recommends apt-utils
#RUN pecl install xdebug \
#    && docker-php-ext-enable xdebug

RUN apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN apt-get install -y zlib1g-dev libpq-dev git libicu-dev libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install zip xsl xml \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# cleanup
RUN apt remove -y ${PHPIZE_DEPS} \
    && apt autoclean \
    && apt autoremove -y \
    && rm -rf /tmp/* \
        /var/cache/*/* \
        /var/lib/apt/lists/*

WORKDIR /app

CMD ["php-fpm", "-F", "-R"]

