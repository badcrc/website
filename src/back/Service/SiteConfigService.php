<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Service;


use Symfony\Component\Yaml\Yaml;

class SiteConfigService
{


    private $integration_data;



    function getHeroImages()
    {

        $items = $this->parseFile("heros.yml");

        return $items;
    }

    function getSponsors()
    {

        $items = $this->parseFile("sponsors.yml");

        return $items;
    }


    function getMediumPublicationName()
    {
        $integrations = $this->getIntegrations();
        $config = $integrations["integration"];
        return $config["medium_publication_name"];
    }

    function getMeetupGroupName()
    {
        $integrations = $this->getIntegrations();
        $config = $integrations["integration"];
        return $config["meetup_group_name"];
    }

    function getSocialLinks()
    {
        $integrations = $this->getIntegrations();
        $config = $integrations["social_media"];
        return $config;
    }

    function getIntegrations()
    {

        return $this->parseFile("integrations.yml");
    }


    private function parseFile($file)
    {
        $data = Yaml::parse(file_get_contents(__DIR__ . "/../../../data/".$file));

        return $data;
    }
}