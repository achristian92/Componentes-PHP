<?php

use Styde\AccessHandler as Access;
use Styde\Authenticator;
use Styde\SessionManager;

class AccessHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test_grant_access()
    {
        $driver = new \Styde\SessionFileDriver();
        $session = new SessionManager($driver);
        $auth = new Authenticator($session);
        $access = new Access($auth);
        $this->assertTrue(
            $access->check('admin')
        );
    }
    public function test_deny_access()
    {
        $driver = new \Styde\SessionFileDriver();
        $session = new SessionManager($driver);
        $auth = new Authenticator($session);
        $access = new Access($auth);

        $this->assertFalse(
            $access->check('editor')
        );
    }
}