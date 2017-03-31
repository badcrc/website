<?php

$site["cache"] = function ()
{
    return new \Symfony\Component\Cache\Adapter\FilesystemAdapter('', 60*60, __DIR__ . "/../var/cache");
};

$site["config"] = function ()
{
    return new \ElComite\Service\SiteConfigService();
};

$site["articles"] = function ($c)
{
    if(!$c["config"]->getMediumPublicationName())
        return null;

    return new \ElComite\Service\MediumService($c["config"]->getMediumPublicationName(), $c["cache"]);
};

$site["events"] = function ($c)
{
    if(!$c["config"]->getMeetupGroupName())
        return null;

    return new \ElComite\Service\MeetupService($c["config"]->getMeetupGroupName(), $c["cache"]);
};

