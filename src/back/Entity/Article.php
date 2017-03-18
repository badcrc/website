<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Entity;


class Article
{

    public $title;

    public $description;

    public $datetime;

    public $url;

    public $image;

    function toJson()
    {
        $item = clone $this;


        $item->datetime = $this->datetime->format(\DateTime::ISO8601);
        $item->description = substr($this->description,0,180)."...";

        return json_encode($item);
    }

}