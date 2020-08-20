# Shipment cost calculator

Boa compra - Shipment cost calculator

## Requirements
- PHP minimum v7.4.3
- Composer v1.8
- Docker
- Docker Compose
- PCOV - Test Coverage Driver

## Tests

Test using Pest - PHP Testing Framework  
```sh/
./vendor/bin/pest
```

Test with code coverage  
```sh
php -d pcov.enabled=1 -d pcov.directory=. ./vendor/bin/pest --coverage

# Or to generate a html coverage
php -d pcov.enabled=1 -d pcov.directory=. ./vendor/bin/pest --coverage-html coverage-reports
```