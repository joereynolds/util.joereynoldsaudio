<?php


//FYI
//Any stuff with a 'util' path is basically a refactored and
//improved version of the same programme under the 'utilities' path
require './vendor/autoload.php';

//We need autoloading for these chaps
include 'homeController.php';

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

$app->get('/util/photodata', function($request, $response, $args) {
    return $this->view->render($response, 'photodata.phtml',
    [
        'title' => 'Exif Data Viewer',
        'images' => scandir('utilities/photodata/images')
    ]
    );
});

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
