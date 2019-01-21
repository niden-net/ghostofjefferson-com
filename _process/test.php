<?php


$data = file_get_contents('./2010-00-00.md');

$template = "---
layout: post
title: '%s'
author: 'esimon'
date: '%sT00:00:00-04:0'
categories:
  - Opinion
tags:
  - Politics
---
";


// Split the contents into articles
$articles = explode("---\n", $data);

foreach ($articles as $article) {
    $contents = explode("\n", $article);
    $title    = $contents[0];
    $date     = $contents[1];
    $slug     = strtolower(str_replace(' ', '-', $title));
    unset($contents[0]);
    unset($contents[1]);
    $data = implode("\n\n", $contents);

    echo $title . PHP_EOL;
    $header = sprintf($template, $title, $date);

    file_put_contents(
        './' . $date . '-' . $slug . '.md',
    $header . $data
    );
}


