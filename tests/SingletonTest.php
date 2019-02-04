<?php

use PHPUnit\Framework\TestCase;


class SingletonTest extends TestCase
{
    public function test_siglenton_instance()
    {
        $this->assertInstanceOf(
          GreeterDummy::class,
            GreeterDummy::getInstance()
        );
    }

    public function test_singletton_creates_only_one_instance()
    {
        $this->assertSame(
            GreeterDummy::getInstance(),
            GreeterDummy::getInstance()
        );
    }

    public function test_welcome_guest_users()
    {
        $greeter = new GreeterDummy();
        $this->assertSame('Bienvenido Invitado',$greeter->welcome());
    }
    public function test_welcome_known_users()
    {
        $greeter = new GreeterDummy('Dulio');
        $this->assertSame('Bienvenido Dulio',$greeter->welcome());
    }

}
class GreeterDummy
{
    private static $instance;
    protected $name = 'Invitado';

    public function __construct($name = null)
    {
        if($name != null){
            $this->name = $name;
        }
    }

    public static function getInstance($name = null)
    {
        if(static::$instance == null){
            static::$instance = new GreeterDummy($name);
        }
        return static::$instance;
    }
    public function welcome()
    {
        return 'Bienvenido '. $this->name;
    }
}