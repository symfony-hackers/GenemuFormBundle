<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class Border extends Gd implements Filter
{
    protected $color;
    protected $size;

    /**
     * Construct
     *
     * @param string $color
     * @param int    $size
     */
    public function __construct($color, $size = 1)
    {
        $this->color = $color;
        $this->size = $size;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $color = $this->allocateColor($this->color);

        $x = $y = $this->size - 1;
        $w = $this->width - $this->size;
        $h = $this->height - $this->size;

        imagerectangle($this->resource, $x, $y, $w, $h, $color);
        imagefilltoborder($this->resource, 0, 0, $color, $color);

        return $this->resource;
    }
}
