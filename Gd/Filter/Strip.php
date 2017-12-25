<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd\Filter;

use SymfonyHackers\Bundle\FormBundle\Gd\Gd;

class Strip extends Gd implements Filter
{
    protected $colors;
    protected $nb;

    /**
     * Construct
     *
     * @param array $colors
     * @param int   $nb
     */
    public function __construct(array $colors, $nb = 15)
    {
        $this->colors = $colors;
        $this->nb = $nb;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $colors = $this->allocateColors($this->colors);

        $nbColor = count($colors) - 1;

        for ($i = 0; $i < $this->nb; ++$i) {
            $x = mt_rand(0, $this->width);
            $y = mt_rand(0, $this->height);

            $x2 = $x + mt_rand(-$this->width / 3, $this->width / 3);
            $y2 = $y + mt_rand(-$this->height / 3, $this->height / 3);

            $color = $colors[mt_rand(0, $nbColor)];

            imageline($this->resource, $x, $y, $x2, $y2, $color);
        }

        return $this->resource;
    }
}
