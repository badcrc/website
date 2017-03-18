<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Entity;


class Event
{

    public $url;

    public $description;

    public $datetime;

    public $guest_number;

    public $place_name;

    public $place_lat;

    public $place_lon;

    public $place_address;


    function toJson()
    {
        $item = clone $this;


        $item->datetime = $this->datetime->format(\DateTime::ISO8601);
        $item->description = substr($this->description,0,240)."...";

        return json_encode($item);
    }

}