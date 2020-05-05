FROM php:7.3-alpine

RUN wget https://github.com/squizlabs/PHP_CodeSniffer/releases/download/3.4.2/phpcs.phar -O phpcs \
    && chmod a+x phpcs \
    && mv phpcs /usr/local/bin/phpcs

COPY ./ /Supercraft
RUN phpcs --config-set installed_paths /Supercraft && phpcs -i

ADD entrypoint.sh /entrypoint.sh
RUN phpcs -i
ENTRYPOINT ["/entrypoint.sh"]
