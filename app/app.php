<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use WikidataSearch\Controller;

$app = new Application();

$app['debug'] = true;

$app->register( new ServiceControllerServiceProvider() );
$app->register( new TwigServiceProvider() );

// config

$app['twig.path'] = array( __DIR__ . '/../templates' );

// controllers

$app['controller'] = $app->share( function() use ( $app ) {
	return new Controller( $app );
} );

// routes
$app->get( '/', 'controller:indexAction' );

$app->run();
