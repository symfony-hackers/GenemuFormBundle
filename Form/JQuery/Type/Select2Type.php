<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\JQuery\Type;

use SymfonyHackers\Bundle\FormBundle\Form\JQuery\DataTransformer\ArrayToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

/**
 * Select2Type to JQueryLib
 */
class Select2Type extends AbstractType
{
    private $widget;

    private $configs;

    public function __construct($widget, array $configs = array())
    {
        $this->widget = $widget;
        $this->configs = $configs;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ('hidden' === $this->widget && !empty($options['configs']['multiple'])) {
            $builder->addViewTransformer(new ArrayToStringTransformer());
        } elseif ('hidden' === $this->widget && empty($options['configs']['multiple']) && null !== $options['transformer']) {
            $builder->addModelTransformer($options['transformer']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['configs'] = $options['configs'];

        // Adds a custom block prefix
        array_splice(
            $view->vars['block_prefixes'],
            array_search($this->getName(), $view->vars['block_prefixes']),
            0,
            'genemu_jqueryselect2'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $defaults = $this->configs;
        $resolver
            ->setDefaults(array(
                'configs'       => $defaults,
                'transformer'   => null,
            ))
            ->setNormalizer(
                'configs',
                function (Options $options, $configs) use ($defaults) {
                    return array_merge($defaults, $configs);
                }
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        if (class_exists('Symfony\Component\Form\Extension\Core\Type\\' . ucfirst($this->widget) . 'Type')) {
            return 'Symfony\Component\Form\Extension\Core\Type\\' . ucfirst($this->widget) . 'Type';
        }
        return 'Symfony\Bridge\Doctrine\Form\Type\\' . ucfirst($this->widget) . 'Type';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'genemu_jqueryselect2_' . $this->widget;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'genemu_jqueryselect2_' . $this->widget;
    }
}
