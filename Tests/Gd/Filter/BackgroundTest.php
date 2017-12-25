<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Gd\Filter;

use PHPUnit\Framework\TestCase;
use SymfonyHackers\Bundle\FormBundle\Gd\Filter\Background;

class BackgroundTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        if (!function_exists('gd_info')) {
            $this->markTestSkipped('Gd not installed');
        }
    }

    public function testBackground()
    {
        $filter = new Background('#FFF');
        $filter->setResource(imagecreatetruecolor(10, 10));

        $apply = $filter->apply();

        $this->assertTrue(is_resource($apply));
    }
}
