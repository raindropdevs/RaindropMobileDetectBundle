<?php

namespace Raindrop\MobileDetectBundle\Tests\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Raindrop\MobileDetectBundle\DependencyInjection\Compiler\LiipThemeCompilerPass;

/**
 * LiipThemeCompilerPassTest
 */
class LiipThemeCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @covers Raindrop\MobileDetectBundle\DependencyInjection\Compiler\LiipThemeCompilerPass::process
    */
    public function testProcess()
    {
        $containerMock = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $requestListener = $this->getMock('Symfony\Component\DependencyInjection\Definition');

        $containerMock->expects($this->once())
                ->method('getDefinition')
                ->with('raindrop_mobile_detect.request_listener')
                ->will($this->returnValue($requestListener));

        $containerMock->expects($this->once())
                ->method('hasDefinition')
                ->with('liip_theme.theme_request_listener')
                ->will($this->returnValue(false));

        $requestListener->expects($this->once())
                ->method('addArgument')
                ->with('raindrop_mobile_detect.device_detection');

        $themeCompiler = new LiipThemeCompilerPass();
        $themeCompiler->process($containerMock);
    }

    /**
    * @covers Raindrop\MobileDetectBundle\DependencyInjection\Compiler\LiipThemeCompilerPass::process
    */
    public function testProcessWithLiipThemeBundleEnabled()
    {
        $containerMock = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $definition = $this->getMock('Symfony\Component\DependencyInjection\Definition');
        $requestListener = $this->getMock('Symfony\Component\DependencyInjection\Definition');

        $containerMock->expects($this->once())
                ->method('getDefinition')
                ->with('raindrop_mobile_detect.request_listener')
                ->will($this->returnValue($requestListener));

        $containerMock->expects($this->once())
                ->method('hasDefinition')
                ->with('liip_theme.theme_request_listener')
                ->will($this->returnValue(true));

        $containerMock->expects($this->once())
                ->method('setDefinition')
                ->with('raindrop_mobile_detect.liip_theme_auto_detect');

        $requestListener->expects($this->once())
                ->method('addArgument')
                ->with('raindrop_mobile_detect.liip_theme_auto_detect');

        $themeCompiler = new LiipThemeCompilerPass();
        $themeCompiler->process($containerMock);
    }
}
