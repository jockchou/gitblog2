<?php

//Request::setTrustedProxies(array('127.0.0.1'));

//routes config
$app->get('/', 'controllers\Home::index')->bind("home");