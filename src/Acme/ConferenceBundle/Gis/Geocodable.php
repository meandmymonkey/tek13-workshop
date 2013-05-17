<?php

namespace Acme\ConferenceBundle\Gis;

interface Geocodable
{
    /**
     * @return string
     */
    public function getLocation();

    /**
     * @param $latitude float
     */
    public function setLatitude($latitude);

    /**
     * @param $longitude float
     */
    public function setLongitude($logitude);
}
