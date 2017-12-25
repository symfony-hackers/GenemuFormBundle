<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class Opacity extends Gd implements Filter
{
    protected $opacity;

    public function __construct($opacity)
    {
        $this->opacity = $opacity;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $tmp = $this->resource;

        $this->create($this->width, $this->height);

        $color = $this->allocateColor('FFF', $this->opacity);

        imagefill($this->resource, 0, 0 , $color);
        imagecopymerge($this->resource, $tmp, 0, 0, 0, 0, $this->width, $this->height, 75);
        imagedestroy($tmp);

        return $this->resource;
    }
}
