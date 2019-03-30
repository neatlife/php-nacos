<?php


namespace alibaba\nacos\util;


use ReflectionException;
use ReflectionObject;

class MapperUtil
{
    /**
     * @param $instance
     * @param $className
     * @return mixed
     * @throws ReflectionException
     */
    public static function objectToObject($instance, $className)
    {
        if (is_string($className)) {
            $className = new $className();
        }
        $sourceReflection = new ReflectionObject($instance);
        $destinationReflection = new ReflectionObject($className);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($instance);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($className, $value);
            } else {
                $className->$name = $value;
            }
        }
        return $className;
    }
}