<?php

use Styde\AccessHandler;
use Styde\Authenticator;
use Styde\Container;
use Styde\SessionArrayDriver;
use Styde\SessionManager;

require __DIR__.'/../vendor/autoload.php';

class_alias('Styde\Facades\Access','Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Container::getInstance();

\Styde\Facades\Access::setContainer($container);

$container->singleton('session',function(){
    $data = array(
        'user_data' => array(
            'name' =>'Dulio',
            'role' => 'teacher'
        )
    );
    $driver = new SessionArrayDriver($data);
    return new SessionManager($driver);
});

$container->singleton('auth',function ($container){
    return new Authenticator($container->make('session'));
});

$container->singleton('access',function ($container){
   return new AccessHandler($container->make('auth'));
});