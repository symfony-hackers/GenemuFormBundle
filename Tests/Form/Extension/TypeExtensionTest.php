<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Form\Extension;

use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\RequestStack;

use SymfonyHackers\Bundle\FormBundle\Gd\Type\Captcha;
use SymfonyHackers\Bundle\FormBundle\Form\Core\Validator\ReCaptchaValidator;
use SymfonyHackers\Bundle\FormBundle\Form;

class TypeExtensionTest extends CoreExtension
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    protected function loadTypes()
    {
        return array_merge(parent::loadTypes(), array(
            new Form\Core\Type\CaptchaType(new Captcha(new Session(new MockArraySessionStorage()), 's$cr$t'), array(
                'script' => 'genemu_upload',
                'uploader' => '/js/uploadify.swf',
                'cancelImg' => '/images/cancel.png',
                'folder' => '/upload',
                'width' => 100,
                'height' => 30,
                'length' => 4,
                'position' => 'left',
                'format' => 'png',
                'chars' => range(0, 9),
                'font_size' => 18,
                'font_color' => array(
                    '252525',
                    '8B8787',
                    '550707',
                    '3526E6',
                    '88531E'
                ),
                'fonts' => array(
                    __DIR__ . '/../../Fixtures/fonts/akbar.ttf',
                    __DIR__ . '/../../Fixtures/fonts/brushcut.ttf',
                    __DIR__ . '/../../Fixtures/fonts/molten.ttf',
                    __DIR__ . '/../../Fixtures/fonts/planetbe.ttf',
                    __DIR__ . '/../../Fixtures/fonts/whoobub.ttf',
                ),
                'background_color' => 'DDDDDD',
                'border_color' => '000000',
                'code' => '1234',
            )),
            new Form\Core\Type\ReCaptchaType(
                new ReCaptchaValidator(
                    $this->requestStack,
                    'privateKey',
                    array(
                        'host' => 'www.google.com',
                        'port' => 80,
                        'path' => '/recaptcha/api/verify',
                        'timeout' => 10,
                        'code' => '1234',
                    )),
                'publicKey',
                'http://www.google.com/recaptcha/api',
                array()),
        ));
    }
}
