<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Service;


use Vinelab\Rss\Article;
use Vinelab\Rss\Feed;
use Vinelab\Rss\Rss;

class MediumService
{



    private $url = "https://medium.com/feed/{publication_name}";

    /**
     * @var Rss
     */
    private $client;

    function __construct($publication_name, Rss $client)
    {
        $this->url = str_replace("{publication_name}", $publication_name, $this->url);
        $this->client = $client;
    }


    function getLastPosts($limit=3)
    {
        $feed = $this->client->feed($this->url);
        /**
         * @var $feed Feed
         */
        $articles = $feed->articles();

        $items = [];

        $i=0;
        foreach ($articles as $article)
        {

            if(++$i>$limit)
                break;

            /**
             * @var $article Article
             */
            $items[] = [
                "title"       => $article->title,
                "url"         => $article->link,
                "description" => $article->content,
                "datetime"    => \DateTime::createFromFormat("D, d M Y H:i:s T", $article->pubDate)
            ];
        }

        return $items;

    }


}