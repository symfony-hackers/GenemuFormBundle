<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase as BaseTypeTestCase;
use Symfony\Component\HttpFoundation\RequestStack;
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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequestStack
     */
    protected function createRequestStackMock()
    {
        return $this->requestStack = $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
