FROM php:7.3-cli

RUN apt-get update && \
    apt-get install unzip git -y && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

COPY cli/ /opt/cli

WORKDIR /opt/cli/

RUN composer install && \
    chmod 0755 /opt/cli/bin/ASP-TEST

WORKDIR /opt/cli/bin

ENTRYPOINT ["bash"]
