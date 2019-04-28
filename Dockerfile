# This file is part of Hyperf.
#
# @link     https://hyperf.org
# @document https://wiki.hyperf.org
# @contact  group@hyperf.org
# @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE

FROM swoft/alphp:base
LABEL maintainer="hyperf <group@hyperf.org>" version="1.0"

##
# ---------- env settings ----------
##
ENV SWOOLE_VERSION=4.3.3 \
    #  install and remove building packages
    PHPIZE_DEPS="autoconf dpkg-dev dpkg file g++ gcc libc-dev make php7-dev php7-pear pkgconf re2c pcre-dev zlib-dev libtool automake"

# update
RUN set -ex \
    && apk update \
    # for swoole extension libaio linux-headers
    && apk add --no-cache libstdc++ openssl php7-xml php7-xmlreader php7-xmlwriter php7-pcntl git bash \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS libaio-dev openssl-dev \

    # download
    && cd /tmp \
    && curl -SL "https://github.com/swoole/swoole-src/archive/v${SWOOLE_VERSION}.tar.gz" -o swoole.tar.gz \
    && ls -alh \

    # php extension:swoole
    && cd /tmp \
    && mkdir -p swoole \
    && tar -xf swoole.tar.gz -C swoole --strip-components=1 \
    && ( \
        cd swoole \
        && phpize \
        && ./configure --enable-mysqlnd --enable-openssl \
        && make -s -j$(nproc) && make install \
    ) \
    && echo "extension=swoole.so" > /etc/php7/conf.d/swoole.ini \
    && echo "swoole.use_shortname = 'Off'" >> /etc/php7/conf.d/swoole.ini \

    # php extension:grpc
    && cd /tmp \
    && git clone -b $(curl -L https://grpc.io/release) https://github.com/grpc/grpc \
    && ( \
        cd grpc \
        && git submodule update --init \
        && make && make install \
        && cd src/php/ext/grpc \
        && phpize \
        && ./configure \
        && make && make install \
        && echo "extension=grpc.so" > /etc/php7/conf.d/grpc.ini \
    ) \
    && rm -rf /usr/local/bin/grpc* \

    # install composer
    && cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update --clean-backups \

    # clear
    && php -v \
    && php -m \
    # ---------- clear works ----------
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

COPY . /opt/www

WORKDIR /opt/www

RUN composer install --no-dev \
    && composer dump-autoload -o \
    && php /opt/www/bin/hyperf.php di:init-proxy

EXPOSE 9501

ENTRYPOINT ["php", "/opt/www/bin/hyperf.php", "start"]
