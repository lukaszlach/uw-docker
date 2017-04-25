<?php

$html = file_get_contents('world-us-canada-39710527');
$doc = new DOMDocument();
@$doc->loadHTML($html);
$sxml = simplexml_import_dom($doc);

$article = $sxml->xpath('//*[@id="page"]')[0];
$title = (string)$article->xpath('//h1')[0];
$intro = (string)$article->xpath('//p[@class="story-body__introduction"]')[0];
$body  = $article->xpath('//p[@class="story-body__introduction"]/following-sibling::p');
$body  = trim(implode("\n", array_map('strval', $body)));

var_dump($title, $intro);
var_dump($body);