<?php
/**
 * Created by PhpStorm.
 * User: alanruizaguirre
 * Date: 2019-01-31
 * Time: 11:55
 */

namespace Styde;


interface AuthenticatorInterface
{
    public function check();
    public function user();


}