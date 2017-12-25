<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Core\DataTransformer;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use SymfonyHackers\Bundle\FormBundle\Form\Core\DataTransformer\ChoiceToJsonTransformer;

class ChoiceToJsonTransformerTest extends TestCase
{
    public function testReverseEmptySimpleValue()
    {
        $transformer = $this->createChoiceToJsonTransformer(
            array(),
            false
        );

        $this->assertEquals(NULL, $transformer->reverseTransform(''));
    }

    public function testReverseEmptyArrayValue()
    {
        $transformer = $this->createChoiceToJsonTransformer(
            array(),
            true
        );

        $this->assertEquals(array(), $transformer->reverseTransform('[]'));
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseMultipleShouldBeFalse()
    {
        $transformer = $this->createChoiceToJsonTransformer(
            array('label' => 'Foo', 'value' => 'foo'),
            true
        );

        $transformer->reverseTransform('{"label": "Foo", "value": "foo"}');
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseMultipleShouldBeTrue()
    {
        $transformer = $this->createChoiceToJsonTransformer(
            array('label' => 'Foo', 'value' => 'foo'),
            false
        );

        $transformer->reverseTransform('[{"label": "Foo", "value": "foo"}]');
    }

    protected function createChoiceToJsonTransformer($list, $multiple)
    {
        $simpleChoice = new SimpleChoiceList($list);

        $transformer = new ChoiceToJsonTransformer(
            $simpleChoice,
            false,
            'choice',
            $multiple
        );

        return $transformer;
    }
}
