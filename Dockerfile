FROM php:8.1-fpm-alpine

RUN apk add --no-cache --update make gcc g++ \
    libc-dev \
    autoconf

# - copy composer executable
COPY --from=composer /usr/bin/composer /usr/bin/

# - docker-php-ext-install
#RUN docker-php-ext-install mysqli \
#    && docker-php-ext-install pdo \
#    && docker-php-ext-install pdo_mysql

# - pecl install
RUN pecl install -o -f xdebug
#    && pecl install -o -f redis

# - enable extensions
RUN docker-php-ext-enable xdebug
#redis

# - php.ini files and configurations
ENV XDEBUG_INI_FILE=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=10080" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.mode=coverage" >>  ${XDEBUG_INI_FILE} \
    && echo "xdebug.discover_client_host=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.log=/tmp/xdebug.log" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.start_with_request=yes" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.client_host=host.docker.internal" >> ${XDEBUG_INI_FILE}
