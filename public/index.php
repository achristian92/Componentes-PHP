<?php

use Styde\Container;

require (__DIR__.'/../bootstrap/start.php');

$access = Container::getInstance()->make('access');

view('index',compact('access'));