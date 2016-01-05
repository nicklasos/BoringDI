<?php
namespace BoringDI;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testShare()
    {
        $c = new Container();

        $c->share('service', function () {
            return mt_rand();
        });

        $this->assertEquals($c->get('service'), $c->get('service'));
    }

    public function testFactory()
    {
        $c = new Container();

        $c->factory('service', function () {
            return mt_rand() + mt_rand() + mt_rand();
        });

        $this->assertNotEquals($c->get('service'), $c->get('service'));
    }

    public function testGet()
    {
        $c = new Container();

        $c->share('service', function () {
            return new ContainerTest();
        });

        $this->assertInstanceOf(self::class, $c->get('service'));
    }

    public function testContainerToCallback()
    {
        $c = new Container();

        $c->share('service', function (Container $container) {
            return $container;
        });

        $this->assertInstanceOf(Container::class, $c->get('service'));
    }
}
