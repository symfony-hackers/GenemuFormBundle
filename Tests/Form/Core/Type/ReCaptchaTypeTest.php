<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Form\Core\Type;

use SymfonyHackers\Bundle\FormBundle\Tests\Form\Type\TypeTestCase;
use Symfony\Component\HttpFoundation\Request;

class ReCaptchaTypeTest extends TypeTestCase
{
    public function testDefaultConfigs()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\ReCaptchaType');
        $view = $form->createView();

        $this->assertEquals('publicKey', $view->vars['public_key']);
        $this->assertEquals('http://www.google.com/recaptcha/api', $view->vars['server']);
        $this->assertEquals(array('lang' => 'en'), $view->vars['configs']);

        $this->assertEquals(array(
            'host' => 'www.google.com',
            'port' => 80,
            'path' => '/recaptcha/api/verify',
            'timeout' => 10,
            'code' => '1234',
        ), $form->getConfig()->getAttribute('option_validator'));
    }

    public function testConfigs()
    {
        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\ReCaptchaType', null, array(
            'configs' => array(
                'theme' => 'blackglass',
            ),
            'validator' => array('timeout' => 30),
        ));
        $view = $form->createView();

        $this->assertEquals('publicKey', $view->vars['public_key']);
        $this->assertEquals(array('theme' => 'blackglass', 'lang' => 'en'), $view->vars['configs']);

        $this->assertEquals(array(
            'host' => 'www.google.com',
            'port' => 80,
            'path' => '/recaptcha/api/verify',
            'timeout' => 30,
            'code' => '1234',
        ), $form->getConfig()->getAttribute('option_validator'));
    }
    
    /**
     * @dataProvider provideCodes
     */
    public function testCode($code, $isValid)
    {
        $request = new Request(array(), array('recaptcha_response_field' => $code));
        $this->requestStack->method('getMasterRequest')->willReturn($request);

        $form = $this->factory->create('SymfonyHackers\Bundle\FormBundle\Form\Core\Type\ReCaptchaType');

        $form->submit(null);

        $this->assertEquals($isValid, $form->isValid());
    }

    public function provideCodes()
    {
        return array(
            array('1234', true),
            array('4321', false),
        );
    }
}
