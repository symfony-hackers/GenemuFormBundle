<?php

namespace SymfonyHackers\Bundle\FormBundle\Form\Core\EventListener;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use SymfonyHackers\Bundle\FormBundle\Geolocation\AddressGeolocation;

class GeolocationListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public function onBind(FormEvent $event)
    {
        $data = $event->getData();

        if (empty($data)) {
            return;
        }

        $address = $data['address'];
        $latitude = isset($data['latitude']) ? $data['latitude'] : null;
        $longitude = isset($data['longitude']) ? $data['longitude'] : null;
        $locality = isset($data['locality']) ? $data['locality'] : null;
        $country = isset($data['country']) ? $data['country'] : null;

        $geo = new AddressGeolocation($address, $latitude, $longitude, $locality, $country);

        $event->setData($geo);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::BIND => 'onBind');
    }
}
