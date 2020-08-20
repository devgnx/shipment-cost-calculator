FROM ubuntu:18.04

COPY --from=composer:1.8 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get install -y --no-install-recommends --no-install-suggests coreutils nginx ca-certificates gettext && \
    apt-get upgrade -y && \
    LC_ALL=C.UTF-8 apt-get install -y software-properties-common && \
    LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php7.4-cli php7.4-fpm php7.4-json php7.4-zip php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath

RUN phpenmod pdo_mysql

RUN rm -rf /var/lib/apt/lists/*

# Forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log \
	&& ln -sf /dev/stderr /var/log/php7.4-fpm.log

RUN rm -f /etc/nginx/sites-enabled/*

COPY ./.build/nginx.conf /tmp/nginx.conf.tpl
COPY ./.build/php-fpm.conf /tmp/php-fpm.conf.tpl

RUN mkdir -p /run/php && touch /run/php/php7.4-fpm.sock && touch /run/php/php7.4-fpm.pid

# Supervizord
RUN apt-get update && apt-get install -y --no-install-recommends --no-install-suggests supervisor

COPY ./.build/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Entrypoint script
COPY ./.build/entrypoint.sh /entrypoint.sh
RUN chmod 755 /entrypoint.sh

WORKDIR /var/www

COPY . .

RUN usermod -u 1000 www-data

ADD .env.local.example .env.local

RUN composer install

EXPOSE 80

ENTRYPOINT [ "/entrypoint.sh" ]
