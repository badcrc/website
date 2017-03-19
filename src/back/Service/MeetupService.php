<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Service;


use ElComite\Entity\Event;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MeetupService
{

    const CACHE_KEY = "meetup";

    private $url = "https://api.meetup.com/2/events?&sign=true&photo-host=public&group_urlname={group_name}&status=upcoming,past&page=1&desc=true";

    /**
     * @var AdapterInterface
     */
    private $cache;

    function __construct($group_name, AdapterInterface $cacheAdapter)
    {
        $this->cache = $cacheAdapter;
        $this->url = str_replace("{group_name}", $group_name, $this->url);
    }

    /**
     * @return null|Event
     */
    function getLastEvent()
    {

        $lastEventCache = $this->cache->getItem(static::CACHE_KEY);
        if(!$lastEventCache->isHit())
        {

            $raw_data = $this->makeGetRequest();

            if($raw_data)
            {
                $item = $this->parseRawResponse($raw_data);
                $lastEventCache->set($item);
                $lastEventCache->expiresAfter(60*60);
                $this->cache->save($lastEventCache);
            }
        }

        return $lastEventCache->get();
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
                $date->setTimestamp($event_data["time"]/1000);


                $event = new Event();
                $event->url          = $event_data["event_url"];
                $event->description  = strip_tags($event_data["description"]);
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