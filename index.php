<?php

require __DIR__.'/vendor/autoload.php';
include_once 'loginfo.php';
include_once 'app/RouteAction.php';

$app = new \Slim\App;

$container = $app->getContainer();

$container['RouteAction'] = function($c)
{
    return new RouteAction();
};

//REST based route for default URI - /
$app->get('/', \RouteAction::class.':index');

$app->get('/properties', \RouteAction::class.':getProperties');

$app->get('/properties/keyword/{keyword}', \RouteAction::class.':searchProperties');
//POST /porperties
$app->post('/properties', \RouteAction::class.':addProperties');

//start app

$app->run();

