<?php
/**
 *
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace ElComite\Service;

use Symfony\Component\Cache\Adapter\AdapterInterface;

class MediumService
{

    const CACHE_KEY = "medium";

    private $url = "https://medium.com/feed/{publication_name}";

    /**
     * @var AdapterInterface
     */
    private $cache;

    function __construct($publication_name, AdapterInterface $cacheAdapter)
    {
        $this->cache = $cacheAdapter;
        $this->url = str_replace("{publication_name}", $publication_name, $this->url);
    }


    function getLastPosts($limit=3)
    {

        $postsCache = $this->cache->getItem(static::CACHE_KEY);
        if(!$postsCache->isHit())
        {

            $raw_data = $this->makeGetRequest();

            if($raw_data)
            {
                $raw   = $this->makeGetRequest();
                $items = $this->parseRawResponse($raw, $limit);

                $postsCache->set($items);
                $postsCache->expiresAfter(60*60);
                $this->cache->save($postsCache);
            }
        }

        return $postsCache->get();

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

    /**
     * @param $raw
     * @param int $limit
     * @return array
     */
    private function parseRawResponse($raw, $limit=3)
    {

        $rss = simplexml_load_string($raw);

        $i=0;
        $items = [];
        foreach ($rss->channel->item as $article) {

            if(++$i>$limit)
                break;

            $content     = $article->children("content", true);
            $content_raw = (string)$content->encoded;



            $item = new \ElComite\Entity\Article();
            $item->datetime    = \DateTime::createFromFormat("D, d M Y H:i:s T", (string)$article->pubDate);
            $item->url         = (string)$article->link;
            $item->description = strip_tags($content_raw);
            $item->title       = (string)$article->title;
            if(preg_match('/src\s*=\s*"(.+?)"/', $content_raw, $img_links))
            {
                $item->image    = $img_links[1];
            }


            $items[] = $item;

        }

        return $items;

    }


}