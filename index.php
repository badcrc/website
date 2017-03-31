<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */
umask(0000);
require __DIR__ . '/vendor/autoload.php';

$site = new \ElComite\Backend();

include __DIR__ . "/config/services.php";

$medium_posts = $site["articles"] ? $site["articles"]->getLastPosts() : [];
$last_event   = $site["events"] ?   $site["events"]->getLastEvent()   : null;
$sponsors     = $site["config"]->getSponsors();
$hero_images  = $site["config"]->getHeroImages();
$social_links = $site["config"]->getSocialLinks();


include __DIR__ . "/templates/index.html.php";