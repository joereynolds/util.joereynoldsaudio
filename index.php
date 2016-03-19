<?php
require './vendor/autoload.php';
include 'homeController.php'; //change this to a use statement;

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

$app->get('/util', "jra\HomeController:dispatch");


$app->get('/util/imagemaker', function($request, $response, $args) {
    return $this->view->render($response, 'imagemaker.phtml',
        ['title' => 'Imagemaker']
    );
});

$app->post('/util/imagemaker', function($request, $response, $args) {
    return $response->getBody()->write(var_dump($_POST));
});

//slightly hacky route for html experiments
$app->get('/snippets/{snippet}', function($request, $response, $args) {
    return $this->view->render($response, $args['snippet'] . '.phtml',
        [
            'title' => ucwords($args['snippet'])
        ]
    );
});


$app->run();
