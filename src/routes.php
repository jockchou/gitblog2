<?php

//Request::setTrustedProxies(array('127.0.0.1'));

//routes config
$app->get('/', 'controller\Home::index')->bind("home");