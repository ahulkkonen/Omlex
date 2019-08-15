<?php

namespace Omlex;

use Omlex\Component\AbstractComponent;
use Omlex\Exception\ComponentException;
use Omlex\Exception\NoSupportException;

/**
 * Base class for consuming Omlex components.
 */
abstract class ComponentFactory
{
    /**
     * Valid component types.
     *
     * @var array
     */
    protected static $types = [
        'photo' => 'Photo',
        'video' => 'Video',
        'link' => 'Link',
        'rich' => 'Rich',
    ];

    /**
     * Create an Omlex component from result.
     *
     * @param object $rawObject Raw object returned from API
     *
     * @return AbstractComponent Instance of component driver
     *
     * @throws ComponentException On component errors
     * @throws NoSupportException When component type is not supported or unknown
     */
    public static function create($rawObject): AbstractComponent
    {
        if (!isset($rawObject->type)) {
            throw new ComponentException('The object has no type.');
        }

        $type = (string) $rawObject->type;
        if (!isset(self::$types[$type])) {
            throw new NoSupportException(sprintf('The object type "%s" is unknown or invalid.', $type));
        }

        $class = sprintf('\\Omlex\\Component\\%s', self::$types[$type]);
        if (!class_exists($class)) {
            throw new ComponentException(sprintf('The component class "%s" is invalid or not found.', $class));
        }

        $instance = new $class($rawObject);

        return $instance;
    }
}
