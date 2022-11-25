.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sed 's/Makefile://' | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

pest:
	./vendor/bin/pest

stan:
	./vendor/bin/phpstan

pint:
	./vendor/bin/pint

test:
	make pint
	make stan
	make pest
