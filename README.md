# Boring DI Container

## Usages:
```php
use BoringDI\Container;

$c = new Container();

$c->share('A', function (Container $c) {
    return new A($c->get('B'));
});

$c->factory('B', function (Container $c) {
    return new B();
});

$c->get('A');
```
