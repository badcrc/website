<?php

$site["config"] = function ()
{
    return new \ElComite\Service\SiteConfigService();
};

$site["articles"] = function ($c)
{
    return new \ElComite\Service\MediumService($c["config"]->getMediumPublicationName());
};

$site["events"] = function ($c)
{
    return new \ElComite\Service\MeetupService($c["config"]->getMeetupGroupName());
};