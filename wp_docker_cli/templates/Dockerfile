FROM hub.dock.codes/php:8.4-wordpress AS base

COPY docker/nginx/custom-rewrites.conf /etc/nginx/

FROM base AS dev

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN if [ "$USER_ID" != "0" ] && [ "$GROUP_ID" != "0" ]; then \
        docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
        docker-php-serversideup-set-file-permissions \
            --owner $USER_ID:$GROUP_ID \
            --service nginx ; \
    else \
        echo "Skipping UID/GID remap for root user"; \
    fi

USER www-data

FROM base AS prod

USER www-data

COPY --chown=www-data:www-data wordpress /var/www/html

WORKDIR /var/www/html

RUN cd /var/www/html/wp-content/themes/dock \
    && npm ci \
    && npm run build \
    && rm -rf node_modules
