FROM cytopia/phpcs:3

COPY ./ /Supercraft
RUN phpcs --config-set installed_paths /Supercraft && phpcs -i

#COPY entrypoint.sh \
#     problem-matcher.json \
#     /action/

RUN apk update && apk add curl \
    zip \
    unzip \
    git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY entrypoint.sh \
     problem-matcher.json \
     /action/

COPY TwigRules \
     /root/.composer/supercraft

COPY composer.json \
     /root/.composer

RUN composer global install

RUN chmod +x /action/entrypoint.sh

ENTRYPOINT ["/action/entrypoint.sh"]

#RUN wget https://github.com/squizlabs/PHP_CodeSniffer/releases/download/3.4.2/phpcs.phar -O phpcs \
#    && chmod a+x phpcs \
#    && mv phpcs /usr/local/bin/phpcs

#COPY ./ /Supercraft
#RUN phpcs --config-set installed_paths /Supercraft && phpcs -i

#ADD entrypoint.sh /entrypoint.sh
#RUN phpcs -i
#ENTRYPOINT ["/entrypoint.sh"]
