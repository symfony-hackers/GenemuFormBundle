<?php

/*
 * This file is part of the SHFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyHackers\Bundle\FormBundle\Tests\Form\Core\Type;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use SymfonyHackers\Bundle\FormBundle\Tests\Form\Type\TypeTestCase;
use SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType;

/**
 * @author Olivier Chauvel <olivier@generation-multiple.com>
 */
class CaptchaTypeTest extends TypeTestCase
{
    public function setUp()
    {
        parent::setUp();

        if (!function_exists('gd_info')) {
            $this->markTestSkipped('Gd not installed');
        }
    }

    public function testDefaultConfigs()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType');
        $view = $form->createView();
        $captcha = $form->getConfig()->getAttribute('captcha');

        $this->assertEquals(100, $view->vars['width']);
        $this->assertEquals(30, $view->vars['height']);
        $this->assertStringStartsWith('data:image/png;base64,', $view->vars['src']);

        $this->assertEquals(4, $captcha->getLength());
    }

    public function testConfigs()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType', null, array(
            'width' => 200,
            'font_color' => array('000'),
            'code' => '1111',
            'format' => 'gif',
        ));

        $view = $form->createView();
        $captcha = $form->getConfig()->getAttribute('captcha');

        $this->assertEquals(200, $view->vars['width']);
        $this->assertEquals(md5('1111s$cr$t'), $captcha->getCode());
        $this->assertStringStartsWith('data:image/gif;base64,', $view->vars['src']);
        $this->assertEquals(4, $captcha->getLength());
    }

    public function testFaultFonts()
    {
        try {
            $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType', null, array(
                'fonts' => array('toto.ttf')
            ));
        } catch (FileNotFoundException $excepted) {
            $this->assertStringStartsWith('The file', $excepted->getMessage());
            $this->assertStringEndsWith('does not exist', $excepted->getMessage());

            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testFaultFormat()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType', null, array(
            'format' => 'bar'
        ));

        $view = $form->createView();

        $this->assertStringStartsWith('data:image/jpeg;base64,', $view->vars['src']);
    }

    public function testCodePasses()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType');
        $form->createView();

        $form->submit('1234');

        $this->assertTrue($form->isValid());
    }

    public function testCodeFails()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\CaptchaType');
        $form->createView();

        $form->submit('4321');

        $this->assertFalse($form->isValid());
    }
}
