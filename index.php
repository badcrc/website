<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

require __DIR__ . '/vendor/autoload.php';

//$event_service = new \ElComite\Service\MeetupService("elcomite");
//$event_service->getLastEvent();

$medium = new \ElComite\Service\MediumService("elcomite", new \Vinelab\Rss\Rss());
$medium->getLastPosts();
