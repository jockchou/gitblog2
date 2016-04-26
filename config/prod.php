<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__ . '/../views');
$app['twig.options'] = array('cache' => __DIR__ . '/../var/cache/twig');

$app['fabricius.cache_dir'] = __DIR__ . '/../var/cache/fabricius';
$app['fabricius.md_dir'] = __DIR__ . '/../markdowns';
$app['fabricius.class'] = '\article\Article';
$app['fabricius.excerpt_delimiter'] = '<!-- more -->';