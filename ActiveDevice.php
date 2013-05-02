<?php

namespace Raindrop\MobileDetectBundle;

/**
 * ActiveDevice
 */
class ActiveDevice
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name = null)
    {
        if ($name) {
            $this->setName($name);
        }
    }

    /**
     * Get active device name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set active device name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
