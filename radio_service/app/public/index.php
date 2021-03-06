<?php
use Bbc\Radio\App\Src\CustomSlimApp;

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

$settings        = require __DIR__ . '/../src/settings.php';
$app             = new CustomSlimApp($settings);

$servicesContainer = new Pimple\Container();
require __DIR__ . '/../src/servicesContainer.php';
$app->setServicesContainer($servicesContainer);


require __DIR__ . '/../src/dependencies.php';
require __DIR__ . '/../src/templates.php';
require __DIR__ . '/../src/routes.php';


$app->run();
