<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;


$app->register(new MonologServiceProvider(), array(
	'monolog.logfile' => __DIR__ . '/../var/logs/' . date('Y-m-d') . '.log',
));


$app->register(new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
));