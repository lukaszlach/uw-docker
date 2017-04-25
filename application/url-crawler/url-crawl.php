<?php

$redis = new Redis();
$redis->connect('redis');
$redis->flushAll();

for ($page = 1; $page < 100; $page++) {
    $html = `curl -sS 'http://www.bbc.co.uk/search/more?page=$page&q=Poland&suggid=urn%3Abbc%3Aisite%3Acurated-p-r%3Apoland'`;
    preg_match_all('#http://www.bbc.co.uk/news/[a-zA-Z0-9\-]+#', $html, $urls);
    $urls = $urls[0];
    foreach ($urls as $url) {
        $redis->sAdd('url-crawler.url', $url);
    }
    sleep(1);
}