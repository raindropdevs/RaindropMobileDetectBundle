<?php

namespace Raindrop\MobileDetectBundle\DeviceDetection;

/**
 * DeviceDetection
 */
class DeviceDetection implements DeviceDetectionInterface
{
    /**
     * @var \Mobile_Detect  $mobileDetect
     */
    protected $mobileDetect;

    /**
     * Constructor.
     *
     * @param \Mobile_Detect $mobileDetect
     */
    public function __construct(\Mobile_Detect $mobileDetect)
    {
        $this->mobileDetect = $mobileDetect;
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile()
    {
        return $this->mobileDetect->isMobile();
    }

    /**
     * {@inheritdoc}
     */
    public function isTablet()
    {
        return $this->mobileDetect->isTablet();
    }

    /**
     * {@inheritdoc}
     */
    public function is($deviceName)
    {
        return $this->mobileDetect->is($deviceName);
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice()
    {
        return ($this->isMobile() ? ($this->isTablet() ? 'tablet' : 'phone') : 'desktop');
    }
}
