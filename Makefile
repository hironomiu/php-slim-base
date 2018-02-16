PHP?=$(shell which php)
CP?=$(shell which cp)
MKDIR?=$(shell which mkdir)
CHMOD?=$(shell which chmod)
HOST?=localhost
PORT?=8888
NPM?=$(shell which npm)
BOWER?=$(shell pwd)/node_modules/bower/bin/bower

php-setup:
	$(PHP) -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
	$(PHP) composer.phar install

config-setup:
	$(CP) src/config.php.template src/config.php
	$(MKDIR) src/cache
	$(CHMOD) 777 src/cache

front-setup:
	$(NPM) install
	$(BOWER) --allow-root install

install: php-setup config-setup front-setup 

server:
	$(PHP) -S $(HOST):$(PORT) -t ./public_html


