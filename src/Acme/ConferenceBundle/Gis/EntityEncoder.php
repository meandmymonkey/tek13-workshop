<?php

namespace Acme\ConferenceBundle\Gis;

use Geocoder\GeocoderInterface;

class EntityEncoder
{
    /**
     * @var \Geocoder\GeocoderInterface
     */
    private $geocoder;

    public function __construct(GeocoderInterface $geocoder)
    {
        $this->geocoder = $geocoder;
    }

    public function encode(Geocodable $entity)
    {
        $pos = $this->geocoder->geocode($entity->getLocation());

        $entity->setLatitude($pos->getLatitude());
        $entity->setLongitude($pos->getLongitude());
    }
}
