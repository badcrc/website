<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

require __DIR__ . '/vendor/autoload.php';

$site = new \ElComite\Backend();

include __DIR__ . "/config/services.php";

$medium_posts = $site["articles"]->getLastPosts();
$events       = $site["events"]->getLastEvent();
$sponsors     = $site["config"]->getSponsors();
$hero_images  = $site["config"]->getHeroImages();


include __DIR__ . "/templates/index.html.php";