<?php

namespace Omlex\Component;

use Omlex\Exception\ComponentException;

/**
 * Base class for components.
 */
abstract class AbstractComponent
{
    /**
     * Raw object returned from API.
     *
     * @var object
     */
    protected $rawObject;

    /**
     * Required fields per the specification.
     *
     * @var array
     */
    protected $required = [];

    /**
     * Constructor.
     *
     * @param object $rawObject Raw object returned from the API
     *
     * @throws ComponentException on missing fields
     */
    public function __construct($rawObject)
    {
        $this->rawObject = $rawObject;

        $this->required[] = 'version';

        foreach ($this->required as $field) {
            if (!property_exists($this->rawObject, $field)) {
                throw new ComponentException(sprintf('Object is missing required "%s" attribute', $field));
            }
        }
    }

    /**
     * Get object variable.
     *
     * @param string $var Variable to get
     *
     * @return mixed Attribute's value or null if it's not set/exists
     */
    public function __get(string $var)
    {
        if (property_exists($this->rawObject, $var)) {
            return $this->rawObject->$var;
        }

        return null;
    }

    /**
     * Is variable set?
     *
     * @param string $var Variable name to check
     *
     * @return bool True if set, false if not
     */
    public function __isset(string $var): bool
    {
        if (property_exists($this->rawObject, $var)) {
            return isset($this->rawObject->$var);
        }

        return false;
    }

    /**
     * Require a sane __toString for all components.
     *
     * @return string|null
     */
    abstract public function __toString(): ?string;
}
