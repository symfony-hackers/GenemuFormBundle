<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Gd\Filter;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

use SymfonyHackers\Bundle\FormBundle\Gd\Filter\Text;

class TextTest extends TestCase
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
        $filter = new Text('Foo', 12, array(new File(__DIR__ . '/../../Fixtures/fonts/akbar.ttf')), array('000'));
        $filter->setResource(imagecreatetruecolor(10, 10));

        $apply = $filter->apply();

        $this->assertTrue(is_resource($apply));
    }
}
