<?php

namespace Raindrop\MobileDetectBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;

/**
 * CompilerPass Class for LiipThemeBundle inject
 */
class LiipThemeCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $requestListener = $container->getDefinition('raindrop_mobile_detect.request_listener');

        if (!$container->hasDefinition('liip_theme.theme_request_listener')) {
            $requestListener->addArgument(new Reference('raindrop_mobile_detect.device_detection'));
        } else {
            $liipThemeDeviceDetection = new Definition();
            $liipThemeDeviceDetection->setClass('Raindrop\MobileDetectBundle\DeviceDetection\LiipThemeDeviceDetection');
            $liipThemeDeviceDetection->addArgument(new Reference('mobile_detection'));
            $liipThemeDeviceDetection->addMethodCall('addActiveTheme', array(new Reference('liip_theme.active_theme')));
            $container->setDefinition('raindrop_mobile_detect.liip_theme_auto_detect', $liipThemeDeviceDetection);
            $requestListener->addArgument(new Reference('raindrop_mobile_detect.liip_theme_auto_detect'));
        }
    }
}
