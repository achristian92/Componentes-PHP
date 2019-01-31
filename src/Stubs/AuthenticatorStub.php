<?php
/**
 * Created by PhpStorm.
 * User: alanruizaguirre
 * Date: 2019-01-31
 * Time: 11:52
 */

namespace Styde\Stubs;


use Styde\AuthenticatorInterface;
use Styde\User;

class AuthenticatorStub implements AuthenticatorInterface
{
    /**
     * @var bool
     */
    private $logged;

    public function __construct($logged = true)
    {
        $this->logged = $logged;
    }

    public function check()
    {
        return $this->logged;
    }

    public function user()
    {
        return new User([
            'role' => 'admin'
        ]);
    }
}