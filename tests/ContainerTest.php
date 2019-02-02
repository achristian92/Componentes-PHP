<?php

use Styde\Container;

/**
 * Created by PhpStorm.
 * User: alanruizaguirre
 * Date: 2019-02-01
 * Time: 11:38
 */

class ContainerTest extends \PHPUnit\Framework\TestCase
{
    public function test_bind_from_closure()
    {
        $container = new Container();

        $container->bind('key',function (){
            return 'Object';
        });

        $this->assertSame('Object',$container->make('key'));

    }

    public function test_bind_instance()
    {
        $container = new Container();

        $stdClass = new StdClass(); // (creamos una clase php )instancia fuera del conteiner

        $container->instance('key',$stdClass);

        $this->assertSame($stdClass,$container->make('key'));
    }

    public function test_bind_from_clase_name()
    {
        $container = new Container();

        $container->bind('key','StdClass');

        $this->assertInstanceOf('StdClass',$container->make('key'));
        
    }

    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();

        $container->bind('foo','Foo');

        $this->assertInstanceOf('Foo',$container->make('foo'));


    }

}
class Foo
{
    public function __construct(Bar $bar,Baz $baz)
    {
    }

}
class Bar
{
    public function __construct(Foobar $foobar)
    {
    }
}
class Foobar
{

}
class Baz
{
    
}