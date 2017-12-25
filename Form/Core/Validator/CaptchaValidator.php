<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\Core\Validator;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

use SymfonyHackers\Bundle\FormBundle\Gd\Type\Captcha;

class CaptchaValidator implements EventSubscriberInterface
{
    private $captcha;

    /**
     * Constructs
     *
     * @param Captcha $captcha
     */
    public function __construct(Captcha $captcha)
    {
        $this->captcha = $captcha;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (
            $this->captcha->getLength() !== strlen($data) ||
            $this->captcha->getCode() !== $this->captcha->encode($data)
        ) {
            $form->addError(new FormError('The captcha is invalid.'));
        }

        $this->captcha->removeCode();
    }

    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_SUBMIT => 'validate');
    }
}
