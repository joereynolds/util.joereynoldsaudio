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

//Massive duplication, learn slim/twig!
$app->get('/snippets/validation', function($request, $response, $args) {
    return $this->view->render($response, 'validation.phtml',
        [
            'title' => 'Validation'
        ]
    );
});

$app->get('/snippets/tabs', function($request, $response, $args) {
    return $this->view->render($response, 'tabs.phtml',
        [
            'title' => 'Flex tabs'
        ]
    );
});

$app->get('/snippets/slideshow', function($request, $response, $args) {
    return $this->view->render($response, 'slideshow.phtml',
        [
            'title' => 'Slideshow'
        ]
    );
});

$app->get('/snippets/modals', function($request, $response, $args) {
    return $this->view->render($response, 'modals.phtml',
        [
            'title' => 'Modals'
        ]
    );
});

$app->get('/snippets/barchart', function($request, $response, $args) {
    return $this->view->render($response, 'barchart.phtml',
        [
            'title' => 'Barcharts'
        ]
    );
});

$app->get('/', function($request, $response, $args) {
    return $this->view->render($response, 'index.phtml');
})->setName('index');

$app->run();
