<?php
/**
 * Created by PhpStorm.
 * User: alanruizaguirre
 * Date: 2019-01-31
 * Time: 11:43
 */

namespace Styde;


class SessionArrayDriver implements SessionDriverInterface
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function load()
    {
        return $this->data;
    }
}