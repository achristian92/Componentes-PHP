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
use ReflectionException;

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

    public function make($name,array $arguments = array())
    {
        if(isset($this->shared[$name])){
            return $this->shared[$name];
        }

        if(isset($this->bindings[$name])){
            $resolver = $this->bindings[$name]['resolver'];
        }else{
            $resolver = $name;
        }

        if($resolver instanceof Closure){
            $object =$resolver($this);
        }else{
            $object = $this->build($resolver,$arguments);
        }

        return $object;
    }

    public function build($name,array $arguments = array())
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
        $dependencias = array();

        foreach ($constructorParameters as $constParam) {

            $parameterName = $constParam->getName();

            if(isset($arguments[$parameterName])){
                $dependencias[] = $arguments[$parameterName];
                continue;
            }

            try {
                $parameterClass = $constParam->getClass();

            }catch (ReflectionException $e){
                throw new ContainerException("Unable to build[$name]:" .$e->getMessage(),null,$e);
            }
            if($parameterClass != null){
                $parameterClassName = $parameterClass->getName(); //Bar
                $dependencias[] = $this->build($parameterClassName);
            }else{
                throw new ContainerException("Porfavor provee el valor del parametro [$parameterName]");
            }
        }
        //new Food(bar) or mailDummy('url.'key)

        return $reflection->newInstanceArgs($dependencias);

    }


}