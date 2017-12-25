<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Gd\Filter;

use PHPUnit\Framework\TestCase;
use SymfonyHackers\Bundle\FormBundle\Gd\Filter\Crop;

class CropTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        if (!function_exists('gd_info')) {
            $this->markTestSkipped('Gd not installed');
        }
    }

    public function testDefault()
    {
        $filter = new Crop(0, 0, 5, 5);
        $filter->setResource(imagecreatetruecolor(10, 10));

        $apply = $filter->apply();

        $this->assertTrue(is_resource($apply));
        $this->assertEquals(5, $filter->getWidth());
        $this->assertEquals(5, $filter->getHeight());
    }
}
