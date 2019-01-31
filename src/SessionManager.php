<?php

namespace Styde;


class SessionManager
{
    protected  $data = array();
    /**
     * @var SessionFileDriver
     */
    private $driver;

    public function __construct(SessionDriverInterface $driver)
    {
        $this->driver = $driver;
        $this->load();
    }

    protected  function load()
    {
        $this->data = $this->driver->load();
    }
    public  function get($key)
    {
        $this->load();

        return isset($this->data[$key])
                    ? $this->data[$key]
                    : null;
    }

}