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

    function getHeroImages()
    {

        $items = $this->parseFile("data_heros.yml");

        return $items;
    }

    function getSponsors()
    {

        $items = $this->parseFile("data_sponsors.yml");

        return $items;
    }


    function getMediumPublicationName()
    {
        $config = $this->getIntegrations();
        return isset($config["medium_publication_name"]) ?
                        $config["medium_publication_name"] : null;
    }

    function getMeetupGroupName()
    {
        $config = $this->getIntegrations();
        return isset($config["meetup_group_name"]) ?
                        $config["meetup_group_name"] : null;;
    }

    function getSocialLinks()
    {
        $links = $this->parseFile("data_social_links.yml");
        return $links;
    }

    function getIntegrations()
    {
        return $this->parseFile("data_integrations.yml");
    }


    private function parseFile($file)
    {
        $data = Yaml::parse(file_get_contents(__DIR__ . "/../../../config/".$file));

        return $data;
    }
}