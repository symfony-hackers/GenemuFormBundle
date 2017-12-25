<?php

namespace SymfonyHackers\Bundle\FormBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use SymfonyHackers\Bundle\FormBundle\DependencyInjection\Compiler\FormPass;

class SHFormBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FormPass());
    }
}
