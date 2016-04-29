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
        $all = $app['markdown']->getArticleList(null, null, null, true, 0, 2);
        $allCategory = $app['markdown']->getTimeGroupAll('Y-m-d');
        $counts = $app['markdown']->getCount();

        //var_dump($all);
        var_dump($allCategory);

        return $app['twig']->render('index.html', array());
    }
}