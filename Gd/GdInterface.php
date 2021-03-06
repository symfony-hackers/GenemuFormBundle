<?php

namespace SymfonyHackers\Bundle\FormBundle\Gd;

use SymfonyHackers\Bundle\FormBundle\Gd\Filter\Filter;

interface GdInterface
{
    /**
     * Check if $resource is a type resource
     */
    public function checkResource();

    /**
     * Check format image
     *
     * @param string $format
     *
     * @return string $format
     */
    public function checkFormat($format);

    /**
     * Get width
     *
     * @return int $width
     */
    public function getWidth();

    /**
     * Get height
     *
     * @return int $height
     */
    public function getHeight();

    /**
     * Get base64 image
     *
     * @param string $format
     *
     * @return string
     */
    public function getBase64($format);

    /**
     * Save Image GD to file
     *
     * @param string $path
     * @param string $format
     * @param int    $quality
     */
    public function save($path, $format, $quality);

    /**
     * Add filter image
     *
     * @param Filter $filter
     */
    public function addFilter(Filter $filter);

    /**
     * Add filters image
     *
     * @param array $filters
     */
    public function addFilters(array $filters);

    /**
     * Apply all filter to image
     */
    public function applyFilters();

    /**
     * Create a new image
     *
     * @param int $width
     * @param int $height
     */
    public function create($width, $height);

    /**
     * Reset image
     * Replace resource to new image
     */
    public function reset();

    /**
     * Set resource
     *
     * @param resource $resource
     */
    public function setResource($resource);

    /**
     * Allocate colors
     *
     * @param array $colors
     *
     * @return array $colors To int colors
     */
    public function allocateColors(array $colors);

    /**
     * Allocate one color
     *
     * @param string $color
     *
     * @return int $color
     */
    public function allocateColor($color);

    /**
     * Transform color to hexadecimal
     *
     * @param string  $color
     * @param boolean $asString
     * @param string  $separator
     *
     * @return mixed $color (red, green, blue)
     */
    public function hexColor($color, $asString, $separator);
}
