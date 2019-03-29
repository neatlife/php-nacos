<?php


namespace alibaba\nacos\util;


use ReflectionClass;
use ReflectionException;

/**
 * Class ReflectionUtil
 * @author suxiaolin
 * @package alibaba\nacos\util
 */
class ReflectionUtil
{
    /**
     * @param $object
     * @return array
     * @throws ReflectionException
     */
    public static function getProperties($object)
    {
        $properties = array();
        $reflect = new ReflectionClass($object);
        do {
            foreach ($reflect->getProperties() as $property) {
                $property->setAccessible(true);
                $properties[$property->getName()] = $property->getValue($object);
            }
        } while ($reflect = $reflect->getParentClass());
        return $properties;
    }
}