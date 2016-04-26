<?php
/**
 * Created by PhpStorm.
 * User: jockchou
 * Date: 2016/4/26
 * Time: 20:50
 */

namespace provider;


use service\MarkdownAccessService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class MarkdownAccessServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['markdown'] = $app->share(function ($app) {
            $content = $app['fabricius']->getRepository($app['fabricius.class'])->query();

            return new MarkdownAccessService($content);
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
    }
}