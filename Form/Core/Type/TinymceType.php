<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TinymceType extends AbstractType
{
    private $options;

    /**
     * Constructs
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['configs'] = $options['configs'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $configs = array_merge(array(
            'language' => \Locale::getDefault(),
        ),
		$this->options);

        $resolver
            ->setDefaults(array(
                'configs' => array(),
                'required' => false,
                'theme' => 'default',
            ))
            ->setAllowedTypes(array(
                'configs' => 'array',
                'theme' => 'string',
            ))
            ->setNormalizers(array(
                'configs' => function (Options $options, $value) use ($configs) {
                    return array_merge($configs, $value);
                },
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\TextareaType';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'genemu_tinymce';
    }
}
