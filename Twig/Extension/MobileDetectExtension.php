<?php

namespace Raindrop\MobileDetectBundle\Twig\Extension;

use Raindrop\MobileDetectBundle\DeviceDetection\DeviceDetectionInterface;
use Twig_Extension;

/**
 * MobileDetectExtension
 */
class MobileDetectExtension extends Twig_Extension
{
    /**
     *
     * @var DeviceDetectionInterface $deviceDetection
     */
    protected $deviceDetection;

    /**
    * Constructor.
    *
    * @param DeviceDetectionInterface $deviceDetection
    */
    public function __construct(DeviceDetectionInterface $deviceDetection)
    {
        $this->deviceDetection = $deviceDetection;
    }
    
    /**
    * Get extension twig function
    * @return array
    */
    public function getFunctions()
    {
        return array(
            'is_mobile' => new \Twig_Function_Method($this, 'isMobile'),
            'is_tablet' => new \Twig_Function_Method($this, 'isTablet'),
            'is_device' => new \Twig_Function_Method($this, 'isDevice'),
        );
    }   
    
    /**
    * Is mobile
    * @return boolean
    */
    public function isMobile()
    {
        return $this->deviceDetection->isMobile();
    }

    /**
    * Is tablet
    * @return boolean
    */
    public function isTablet()
    {
        return $this->deviceDetection->isTablet();
    }  
    
    /**
    * Is device
    * @param string $deviceName is[iPhone|BlackBerry|HTC|Nexus|Dell|Motorola|Samsung|Sony|Asus|Palm|Vertu|...]
    *
    * @return boolean
    */
    public function isDevice($deviceName)
    {
        return $this->deviceDetection->is($deviceName);
    }    
    
    /**
    * Extension name
    * @return string
    */
    public function getName()
    {
        return 'raindrop_mobile_detect.twig.extension';
    }    
}
