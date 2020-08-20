# Shipment cost calculator

Boa compra - Shipment cost calculator

This projects uses TDD and DDD aproches with also pure functions 
and immutable objects at the Domain layer.

## Requirements

- [PHP v7.4.3](https://www.php.net/releases#7.4.3)
- [Composer](https://getcomposer.org/doc/00-intro.md/)
- [Docker](https://docs.docker.com/engine/)
- [Docker Compose](https://docs.docker.com/compose/)
- [PCOV - Test Coverage Driver](https://github.com/krakjoe/pcov)

## Usage

Run docker compose up to initialize app

```php
docker-compose up --build --force-recreate -d
```

## Tests

Test using [Pest - PHP Testing Framework](https://pestphp.com/)
```sh/
./vendor/bin/pest
```

Test with code coverage using PCOV 
```sh
php -d pcov.enabled=1 -d pcov.directory=. ./vendor/bin/pest --coverage

# Or to generate html coverage
php -d pcov.enabled=1 -d pcov.directory=. ./vendor/bin/pest --coverage-html coverage-reports
```
