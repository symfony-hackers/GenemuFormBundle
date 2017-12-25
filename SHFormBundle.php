<?php

/*
 * This file is part of the GenemuFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyHackers\Bundle\FormBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use SymfonyHackers\Bundle\FormBundle\DependencyInjection\Compiler\FormPass;

/**
 * An extends of Symfony\Component\HttpKernel\Bundle\Bundle
 *
 * @author Olivier Chauvel <olivier@generation-multiple.com>
 */
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
