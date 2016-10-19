<?php
require __DIR__ . "/../vendor/autoload.php";
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';

$app       = new \Slim\App($settings);
$container = $app->getContainer();

// REGISTER TWIG TEMPLATES
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
        'cache' => __DIR__ . '/cache'
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';
require __DIR__ . '/../controllers/Product.php';


// load controllerss
//foreach(glob(__DIR__ . "/../controllers/*.php") as $file){
//    require $file;
//}



// Run app
$app->run();