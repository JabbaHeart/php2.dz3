<?php

require __DIR__ . '/autoload.php';

$news = (new \App\Models\Article)::findAll();

$view = new \App\View();

$view->news = $news;
$view->display(__DIR__ . '/App/Templates/news.php');