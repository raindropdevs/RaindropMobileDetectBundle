<?php

namespace Raindrop\MobileDetectBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

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

            if (!$cookieValue && $this->deviceDetection instanceof DeviceDetectionInterface) {
                $cookieValue = $this->deviceDetection->getDevice();
            }

            if ($cookieValue && $cookieValue !== $this->activeDevice->getName()) {
                $this->activeDevice->setName($cookieValue);
            }
        }
    }

}
