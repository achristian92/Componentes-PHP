<?php
/**
 * Created by PhpStorm.
 * User: alanruizaguirre
 * Date: 2019-02-01
 * Time: 11:42
 */

namespace Styde;


use Closure;
use InvalidArgumentException;
use ReflectionClass;

class Container
{
    protected $shared = [];
    protected $bindings = [];

    public function bind($name,$resolver)
    {
        $this->bindings[$name] = [
            'resolver' => $resolver
        ];
    }

    public function instance($name, $object)
    {
        $this->shared[$name] = $object;
    }

    public function make($name)
    {
        if(isset($this->shared[$name])){
            return $this->shared[$name];
        }

        $resolver = $this->bindings[$name]['resolver'];

        if($resolver instanceof Closure){
            $object =$resolver($this);
        }else{
            $object = $this->build($resolver);
        }

        return $object;
    }

    public function build($name)
    {
        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable()){
            throw new InvalidArgumentException("$name no is intanciable");
        }

        $constructor = $reflection->getConstructor(); // devuelve methodo de reflextionMethod

        if(is_null($constructor)){
            return new $name;
        }
        $constructorParameters = $constructor->getParameters();//[devulve array de reflectionParamt
        //
        $arguments = array();

        foreach ($constructorParameters as $constParam) {
            $parameterClassName = $constParam->getClass()->getName(); //Bar

            $arguments[] = $this->build($parameterClassName);
        }
        //new Food(bar)
        return $reflection->newInstanceArgs($arguments);
    }


}