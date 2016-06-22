<?php
//FYI
//Any stuff with a 'util' path is basically a refactored and
//improved version of the same programme under the 'utilities' path
require './vendor/autoload.php';

use \jra\model\FileManager;
use \jra\factory\ImageFactory;

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

$app->map(['GET', 'POST'], '/util/photodata', function($request, $response, $args) {
    $path = './assets/images/photodata/';
    $filename = $_FILES['file']['name'];
    $fileManager = new FileManager();
    $fileManager->uploadFile($path . $filename);
    $imageFactory = new ImageFactory();

    //Don't see why I need to call this again even though it's
    //called in the constructor?
    $imageFactory->populateImages();
    return $this->view->render($response, 'photodata.phtml',
        [
            'title' => 'Exif Data Viewer',
            'images' => $imageFactory->images,
            'stylesheet' => '/assets/css/components/cards/card-1/card-1.css',
            'sweetalertcss' => '/libraries/sweetalert/dist/sweetalert.css',
            'sweetalertjs' => '/libraries/sweetalert/dist/sweetalert.min.js',
            'script' => '/assets/js/photodata.js'
        ]
    );
});

$app->map(['GET', 'POST'], '/util/rawtext', function($request, $response, $args) {
    return $this->view->render($response, 'rawtext.phtml',
        [
            'title' => 'Raw Text',
            'input' => json_encode($_POST['input']),
        ]
    );
});

$app->get('/util/webgrep', function($request, $response, $args) {
    return $this->view->render($response, 'webgrep.phtml',
        ['title' => 'Grep The Web!']
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

$app->get('/snippets/{snippet}', function($request, $response, $args) {
    return $this->view->render($response, $args['snippet'] . '.phtml',
        [
            'title' => ucwords($args['snippet'])
        ]
    );
});

$app->run();
