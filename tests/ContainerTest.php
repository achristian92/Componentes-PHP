<?php

use Styde\Container;
use Styde\ContainerException;

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
    public function test_expected_container_exception_if_dependency_does_not_exist()
    {
       $this->expectException(ContainerException::class,'Unable to build [Qux] : class Norf does not exist');

       $container = new Container();
       $container->bind('qux','Qux');
       $container->make('qux');
    }

    /**
     * @expectedException Styde\ContainerException
     */
    public function test_class_does_not_exist()
    {
        $container = new Container();
        $container->make('Norf');
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
class Qux
{
    public function __construct(Norf $norf)
    {
    }
}