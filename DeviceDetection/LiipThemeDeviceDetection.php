<?php

namespace Raindrop\MobileDetectBundle\DeviceDetection;

use Liip\ThemeBundle\Helper\DeviceDetectionInterface as LiipDeviceDetectionInterface;

/**
 * LiipThemeDeviceDetection
 */
class LiipThemeDeviceDetection extends DeviceDetection implements LiipDeviceDetectionInterface
{
    /**
     * @var Liip\ThemeBundle\ActiveTheme $activeTheme
     */
    protected $activeTheme;

    /**
     * @var string $userAgent
     */
    protected $userAgent;

    /**
     * @var string $type 
     */
    protected $type;

    /**
    * Adds ActiveTheme class form LiipThemeBundle
    *
    * @param Liip\ThemeBundle\ActiveTheme $activeTheme
    */    
    public function addActiveTheme($activeTheme)
    {
        $this->activeTheme = $activeTheme;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }
    
    public function getType()
    {
        if (null === $this->type) {
            $type = ($this->isMobile() ? ($this->isTablet() ? 'tablet' : 'phone') : 'desktop');
            $this->type = $type;
        }

        return $this->type;
    }
}
