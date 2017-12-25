<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase as BaseTypeTestCase;
use SymfonyHackers\Bundle\FormBundle\Tests\Form\Extension\TypeExtensionTest;

abstract class TypeTestCase extends BaseTypeTestCase
{
    protected $requestStack;

    public function setUp()
    {
        parent::setUp();

        \Locale::setDefault('en');
    }

    protected function getExtensions()
    {
        return array(
            new TypeExtensionTest($this->createRequestStackMock())
        );
    }

    protected function createRequestStackMock()
    {
        return $this->requestStack = $this->createMock('Symfony\Component\HttpFoundation\RequestStack');
    }
}
