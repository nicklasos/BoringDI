# Boring DI Container

## Usages:
```php
$c = new Container();

$c->share('A', function (Container $c) {
    return new A();
});

$c->factory('B', function (Container $c) {
    return new B();
});

$c->get('A');
```