<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ChosenType to JQueryLib
 */
class ChosenType extends AbstractType
{
    private $widget;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['no_results_text'] = $options['no_results_text'];
        $view->vars['allow_single_deselect'] = $options['allow_single_deselect'];
        $view->vars['disable_search_threshold'] = $options['disable_search_threshold'];

        // Adds a custom block prefix
        array_splice(
            $view->vars['block_prefixes'],
            array_search($this->getName(), $view->vars['block_prefixes']),
            0,
            'genemu_jquerychosen'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'no_results_text' => '',
                'allow_single_deselect' => true,
                'disable_search_threshold' => 0
            ))
            ->setNormalizers(array(
                'expanded' => function (Options $options) {
                    return false;
                }
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->widget;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'genemu_jquerychosen_' . $this->widget;
    }
}
