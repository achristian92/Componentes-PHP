<?php

use Styde\Container;

require (__DIR__.'/../bootstrap/start.php');

function studentController()
{
    $access = Container::getIntance()->access();

    if(!$access->check('student')){
        abort404();
    }

    view('students',[]);

}

studentController();