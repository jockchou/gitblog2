<?php
/**
 * Created by PhpStorm.
 * User: jockchou
 * Date: 2016/4/15
 * Time: 19:01
 */

namespace controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Home
{
    /**
     * @param Request $request
     * @param Application $app
     */
    public function index(Request $request, Application $app)
    {
        $all = $app['markdown']->getArticleAll();

        return $app['twig']->render('index.html', array());
    }
}