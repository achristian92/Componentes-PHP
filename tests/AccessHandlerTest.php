<?php

use Styde\AccessHandler;

class AccessHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test_grant_access()
    {
        $this->assertTrue(
            AccessHandler::check('admin')
        );
    }
    public function test_deny_access()
    {
        $this->assertFalse(
            AccessHandler::check('editor')
        );
    }
}