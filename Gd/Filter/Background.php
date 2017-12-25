<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class Background extends Gd implements Filter
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
        $color = $this->allocateColor($this->color);

        imagefill($this->resource, 0, 0, $color);

        return $this->resource;
    }
}
