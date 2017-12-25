<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class Colorize extends Gd implements Filter
{
    protected $color;

    /**
     * Construct
     *
     * @param string $color
     */
    public function __construct($color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        list($red, $green, $blue) = $this->hexColor($this->color);

        imagefilter($this->resource, IMG_FILTER_COLORIZE, $red, $green, $blue);

        return $this->resource;
    }
}
