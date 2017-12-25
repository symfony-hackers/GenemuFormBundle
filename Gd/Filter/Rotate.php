<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class Rotate extends Gd implements Filter
{
    protected $rotate;

    /**
     * Construct
     *
     * @param int $rotate
     */
    public function __construct($rotate)
    {
        $this->rotate = $rotate;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        return $this->resource = imagerotate($this->resource, $this->rotate, 0);
    }
}
