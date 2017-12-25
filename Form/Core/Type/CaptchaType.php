<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use SymfonyHackers\Bundle\FormBundle\Gd\Type\Captcha;
use SymfonyHackers\Bundle\FormBundle\Form\Core\Validator\CaptchaValidator;

class CaptchaType extends AbstractType
{
    private $captcha;
    private $options;

    /**
     * Constructs
     *
     * @param Captcha $captcha
     * @param array   $options
     */
    public function __construct(Captcha $captcha, array $options)
    {
        $this->captcha = $captcha;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->captcha->setOptions($options);

        $builder
            ->addEventSubscriber(new CaptchaValidator($this->captcha))
            ->setAttribute('captcha', $this->captcha)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $captcha = $this->captcha;

        $view->vars = array_replace($view->vars, array(
            'value' => '',
            'src' => $captcha->getBase64($options['format']),
            'width' => $captcha->getWidth(),
            'height' => $captcha->getHeight(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $defaults = array_merge(
            array('attr' => array('autocomplete' => 'off')),
            $this->options
        );

        $resolver->setDefaults($defaults);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\TextType';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'genemu_captcha';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'genemu_captcha';
    }
}
