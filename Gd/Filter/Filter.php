<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\GdInterface;

interface Filter extends GdInterface
{
    /**
     * Code execute to apply filter
     */
    public function apply();
}
