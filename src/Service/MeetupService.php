<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Service;


use ElComite\Entity\Event;

class MeetupService
{

    private $url = "https://api.meetup.com/2/events?&sign=true&photo-host=public&group_urlname={group_name}&page=1";


    function __construct($group_name)
    {
        $this->url = str_replace("{group_name}", $group_name, $this->url);

    }

    /**
     * @return null|Event
     */
    function getLastEvent()
    {
        $raw_data = $this->makeGetRequest();
        if($raw_data)
        {
            $item = $this->parseRawResponse($raw_data);

            die(json_encode($item));
            return $item;
        }

        return null;
    }

    private function makeGetRequest()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url
        ));

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;

    }

    private function parseRawResponse($raw)
    {

        if($data = json_decode($raw, true))
        {

            if(count($data["results"]))
            {
                $event_data = $data["results"][0];

                $date = new \DateTime();
                $date->setTimestamp($event_data["time"]);

                $event = new Event();
                $event->url          = $event_data["event_url"];
                $event->description  = htmlentities($event_data["description"]);
                $event->guest_number = $event_data["yes_rsvp_count"];
                $event->place_name   = $event_data["venue"]["name"];
                $event->place_address = $event_data["venue"]["address_1"];
                $event->place_lat     = $event_data["venue"]["lat"];
                $event->place_lon     = $event_data["venue"]["lon"];
                $event->datetime      = $date;


                return $event;
            }


        }
        return null;

    }

}