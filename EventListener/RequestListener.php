<?php

namespace Raindrop\MobileDetectBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Raindrop\MobileDetectBundle\ActiveDevice;
use Raindrop\MobileDetectBundle\DeviceDetection\DeviceDetectionInterface;

/**
 * RequestListener
 */
class RequestListener 
{
    /**
     * @var DeviceDetectionInterface $deviceDetection
     */
    protected $deviceDetection;
    
    /**
    * @var string
    */
    protected $newDevice;
    
    /**
     * Constructor.
     * 
     * @param ActiveDevice             $activeDevice 
     * @param DeviceDetectionInterface $deviceDetection 
     */
    public function __construct(ActiveDevice $activeDevice, DeviceDetectionInterface $deviceDetection)
    {
        $this->activeDevice = $activeDevice;
        $this->deviceDetection = $deviceDetection;
    }  
    
   /**
    * @param GetResponseEvent $event
    */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $cookieValue = null;
            $cookieValue = $event->getRequest()->cookies->get('device');

            if (!$cookieValue && $this->deviceDetection instanceof DeviceDetectionInterface) {
                $cookieValue = $this->deviceDetection->getDevice();
            }     

            if ($cookieValue && $cookieValue !== $this->activeDevice->getName())
            {
                $this->newDevice = $cookieValue;
                $this->activeDevice->setName($cookieValue); 
            }
        }
    } 

   /**
    * @param FilterResponseEvent $event
    */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            if ($this->newDevice == $this->activeDevice->getName()) {
                $cookie = new Cookie(
                    'device',
                    $this->newDevice,
                    time() + 3600
                );
                $event->getResponse()->headers->setCookie($cookie);
            }
        }
    }
}
