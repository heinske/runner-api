FROM php:7.3.6-fpm-alpine3.9

# Habilita o bash
RUN apk add bash
RUN apk add --no-cache openssl

# Instala as depenências necessárias
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

# Cria o entrypoint
COPY ./entrypoint.sh /entrypoint.sh

# Configura as permissões para o user da aplicação
RUN chmod 755 -R /var/www
RUN chmod 777 /entrypoint.sh

# Expoe a porta do php fpm e coloca o script no entrypoint
EXPOSE 9000
ENTRYPOINT ["/entrypoint.sh"]
