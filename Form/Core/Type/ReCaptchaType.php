<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SymfonyHackers\Bundle\FormBundle\Form\Core\Validator\ReCaptchaValidator;

class ReCaptchaType extends AbstractType
{
    /** @var ReCaptchaValidator */
    private $validator;

    /** @var string */
    private $publicKey;

    /** @var string */
    private $serverUrl;

    /** @var array */
    private $options;

    /**
     * @param ReCaptchaValidator $validator
     * @param string $publicKey
     * @param string $serverUrl
     * @param array $options
     */
    public function __construct(ReCaptchaValidator $validator, $publicKey, $serverUrl, array $options)
    {
        if (empty($publicKey)) {
            throw new RuntimeException('The child node "public_key" at path "sh_form.captcha" must be configured.');
        }

        $this->validator = $validator;
        $this->publicKey = $publicKey;
        $this->serverUrl = $serverUrl;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->validator->addOptions($options['validator']);

        $builder
            ->addEventSubscriber($this->validator)
            ->setAttribute('option_validator', $this->validator->getOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, [
            'public_key' => $this->publicKey,
            'server' => $this->serverUrl,
            'configs' => $options['configs'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $configs = array_merge([
            'lang' => \Locale::getDefault(),
        ], $this->options);

        $resolver
            ->setDefaults([
                'configs' => [],
                'validator' => [],
                'error_bubbling' => false,
            ])
            ->setAllowedTypes('configs', 'array')
            ->setAllowedTypes('validator', 'array')
            ->setNormalizer('configs', function (Options $options, $value) use ($configs) {
                return array_merge($configs, $value);
            }
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'genemu_recaptcha';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'genemu_recaptcha';
    }
}
