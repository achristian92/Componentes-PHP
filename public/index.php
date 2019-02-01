<?php

use Styde\Container;

require (__DIR__.'/../bootstrap/start.php');

$access = Container::getIntance()->access();

view('index',compact('access'));