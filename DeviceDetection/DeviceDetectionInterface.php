<?php

namespace Raindrop\MobileDetectBundle\DeviceDetection;

/**
 * DeviceDetectionInterface
 */
interface DeviceDetectionInterface
{
    /**
     * Check if the device in mobile
     *
     * @return boolean
     */
    public function isMobile();

    /**
     * Check if the device in tablet
     *
     * @return boolean
     */
    public function isTablet();

   /**
    * Check if is a $deviceName
    * @param string $deviceName is[iPhone|BlackBerry|HTC|Nexus|Dell|Motorola|Samsung|Sony|Asus|Palm|Vertu|...]
    *
    * @return boolean
    */
    public function is($deviceName);

   /**
    * Return the device type
    *
    * @return string
    */
    public function getDevice();
}
