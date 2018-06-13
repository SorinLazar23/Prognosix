<?php

$news = simplexml_load_file('feed.xml');

$result = '';

foreach($news->channel->item as $new){
    $result .= '<div class="news-item">';
    $result .= '<div class="news-link"><a href="' . $new->link . '">' . $new->title . '</a>';
    $result .= '</div>';
    $result .= '<div class="news-description">' . $new->description;
    $result .= '</div>';
    $result .= '<div class="news-date">' . $new->pubDate;
    $result .= '</div>';
    $result .= '</div>';
    $result .= '<hr/>';
}

echo $result;
exit;