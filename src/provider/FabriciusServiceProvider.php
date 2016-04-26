<?php

/*
 * This file is part of Fabricius.
 *
 * (c) Robin van der Vleuten <robinvdvleuten@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace provider;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Fabricius\Events;
use Fabricius\Formatter\Formatter;
use Fabricius\Formatter\Handler\MarkdownPhpHandler;
use Fabricius\Formatter\Handler\TextileHandler;
use Fabricius\LibraryBuilder;
use Fabricius\Loader\FileLoader;
use Fabricius\Storage\ArrayStorage;
use Fabricius\Validator\Validator;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Validator\DefaultTranslator;

/**
 * FabriciusServiceProvider
 *
 * @author Robin van der Vleuten <robinvdvleuten@gmail.com>
 */
class FabriciusServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['fabricius'] = $app->share(function ($app) {
            AnnotationRegistry::registerLoader('class_exists');

            $fabricius = LibraryBuilder::create()
                ->setCacheDir($app['fabricius.cache_dir'])
                ->setExcerptDelimiter($app['fabricius.excerpt_delimiter'])
                ->build();

            $finder = new Finder();
            $provider = new FileLoader($finder, $app['fabricius.md_dir']);

            $storage = new ArrayStorage();

            $fabricius->registerRepository($app['fabricius.class'], $provider, $storage);

            return $fabricius;
        });

        $app['fabricius.formatter'] = $app->share(function ($app) {
            $formatter = new Formatter($app['fabricius']->getMetadataFactory());
            $markdownHandler = new MarkdownPhpHandler('\Michelf\Markdown', 'transform');
            $textileHandler = new TextileHandler('Netcarver\Textile\Parser', 'textileThis');

            $formatter->addFormatHandler($textileHandler);
            $formatter->addFormatHandler($markdownHandler);

            return $formatter;
        });

        $app['fabricius.validator'] = $app->share(function ($app) {
            $constraintValidatorFactory = new ConstraintValidatorFactory();
            $translator = new DefaultTranslator();

            return new Validator($app['fabricius']->getMetadataFactory(), $constraintValidatorFactory, $translator);
        });
    }

    public function boot(Application $app)
    {
        $app['fabricius']->getEventDispatcher()->addListener(Events::CONTENT_PARSED,
            array($app['fabricius.validator'], 'onContentItemParsed'), -100);
        $app['fabricius']->getEventDispatcher()->addListener(Events::CONTENT_PARSED,
            array($app['fabricius.formatter'], 'onContentItemParsed'));
    }
}
