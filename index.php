<?php
require './vendor/autoload.php';

use \Slim\App;
use \Slim\Views\Twig;

$app = new App();

$container = $app->getContainer();

$container['view'] = function($container) {
    $view = new Twig('./templates');

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

$app->get('/', function($request, $response, $args) {
    return $this->view->render($response, 'index.phtml');
})->setName('index');

$app->map(['GET', 'POST'], '/util/rawtext', function($request, $response, $args) {
    return $this->view->render($response, 'rawtext.phtml',
        [
            'title' => 'Raw Text',
            'input' => json_encode($request->getParsedBodyParam('input'))
        ]
    );
});

$app->get('/snippets/{snippet}', function($request, $response, $args) {
    return $this->view->render($response, $args['snippet'] . '.phtml',
        [
            'title' => ucwords($args['snippet'])
        ]
    );
});

$app->run();
