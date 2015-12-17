<?php
namespace BoringDI;

class ComplexTest extends \PHPUnit_Framework_TestCase
{
    public function testComplex()
    {
        $c = new Container();

        $c->share('A', function (Container $c) {
            return new A($c->get('B'), $c->get('C'));
        });

        $c->share('B', function (Container $c) {
            return new B($c->get('D'));
        });

        $c->share('C', function () {
            return new C();
        });

        $c->share('D', function () {
            return new D();
        });

        /** @var A $a */
        $a = $c->get('A');

        $this->assertEquals('ok', $a->x());
    }
}

class A
{
    /**
     * @var B
     */
    private $b;
    /**
     * @var C
     */
    private $c;

    public function __construct(B $b, C $c)
    {
        $this->b = $b;
        $this->c = $c;
    }

    public function x()
    {
        return $this->b->x();
    }
}

class B
{
    /**
     * @var D
     */
    private $d;

    public function __construct(D $d)
    {
        $this->d = $d;
    }

    public function x()
    {
        return $this->d->x();
    }
}

class C
{

}

class D
{
    public function x()
    {
        return 'ok';
    }
}

