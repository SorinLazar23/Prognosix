<?php

header("Content-Type: text/xml; charset=ISO-8859-1");

$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>My RSS feed</title>';
$rssfeed .= '<link>http://localhost/Prognosix/</link>';
$rssfeed .= '<description>This is an RSS feed</description>';
$rssfeed .= '<language>en-us</language>';
$rssfeed .= '<copyright>Copyright (C) 2018 Prognosix</copyright>';

$news = simplexml_load_file('feed.xml');

foreach($news as $newsItem) {
    $rssfeed .= '<item>';
    $rssfeed .= '<title>' . $newsItem['title'] . '</title>';
    $rssfeed .= '<description>' . $newsItem['description'] . '</description>';
    $rssfeed .= '<link>' . $newsItem['link'] . '</link>';
    $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", $newsItem['date']) . '</pubDate>';
    $rssfeed .= '</item>';
}

$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

echo $rssfeed;