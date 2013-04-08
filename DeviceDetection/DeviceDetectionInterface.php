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
    function isMobile();

    /**
     * Check if the device in tablet
     * 
     * @return boolean 
     */    
    function isTablet();

   /**
    * Check if is a $deviceName
    * @param string $deviceName is[iPhone|BlackBerry|HTC|Nexus|Dell|Motorola|Samsung|Sony|Asus|Palm|Vertu|...]
    *
    * @return boolean
    */     
    function is($deviceName);
    
   /**
    * Return the device type
    *
    * @return string
    */  
    function getDevice();
}
