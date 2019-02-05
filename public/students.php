<?php

use Styde\Container;
use Styde\Facades\Access;

require (__DIR__.'/../bootstrap/start.php');

function studentController()
{
    if(!Access::check('student')){
        abort404();
    }

    view('students');

}

studentController();