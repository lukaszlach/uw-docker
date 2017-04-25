<?php

$redis = new Redis();
$redis->connect('redis');

while (true) {
    $url = $redis->sPop('url-crawler.url');
    if (false === $url) {
        sleep(1);
        continue;
    }
    var_dump($url);
    $html =  `curl -sS '$url'`;
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $sxml = simplexml_import_dom($doc);

    $article = $sxml->xpath('//*[@id="page"]')[0];
    $title = (string)$article->xpath('//h1')[0];
    $intro = (string)$article->xpath('//p[@class="story-body__introduction"]')[0];
    $body  = $article->xpath('//p[@class="story-body__introduction"]/following-sibling::p');
    $body  = trim(implode("\n", array_map('strval', $body)));

    file_put_contents('result/'.md5($url).'.json', json_encode([
        'url'   => $url,
        'title' => $title,
        'intro' => $intro,
        'body'  => $body,
    ]));
    sleep(1);
}