<?php
require 'vendor/autoload.php';

use EpiCMS\Box;

Box::driver(new \EpiCMS\Driver\File('storage.dat'));

$app = new \Slim\Slim();
$app->config('layout.default', 'layout.php');
$app->config('system.users', array(
    'admin' => 'demo',
));

\Strong\Strong::factory(array(
    'provider' => 'Hashtable',
    'users' => $app->config('system.users'),
));

$app->add(new \EpiCMS\Module\Front());
$app->add(new \EpiCMS\Module\Api());
$app->add(new \EpiCMS\Module\EditAll());
$app->add(new \EpiCMS\Module\Auth());

$app->run();
