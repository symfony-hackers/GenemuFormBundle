<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class GrayScale extends Gd implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        imagefilter($this->resource, IMG_FILTER_GRAYSCALE);

        return $this->resource;
    }
}
