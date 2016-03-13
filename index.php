<?php
require './vendor/autoload.php';
$app = new \Slim\App();

$container = $app->getContainer();

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig('./templates');

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

$app->get('/', function($request, $response, $args) {

    return $this->view->render($response, 'index.phtml');
})->setName('index');

$app->run();
