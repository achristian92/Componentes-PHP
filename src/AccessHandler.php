<?php

namespace Styde;

class AccessHandler
{

    protected $auth;

    public function __construct(Authenticator $auth)
    {

        $this->auth = $auth;
    }

    public function check($role)
    {
        return $this->auth->check() && $this->auth->user()->role === $role;
    }
}