<?php

namespace Raindrop\MobileDetectBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Raindrop\MobileDetectBundle\DependencyInjection\Compiler\LiipThemeCompilerPass;

class RaindropMobileDetectBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new LiipThemeCompilerPass());
    }
}
