<?php

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

const BASE_PATH = __DIR__ . '/..';

$config = require BASE_PATH . '/config.php';
require BASE_PATH . '/app/Database.php';

// Dependency injection container
require BASE_PATH . '/app/DependencyContainer.php';
$container = new DependencyContainer();

$container->bind('db', function() use ($config) {
    return new Database($config['database'], 'root', 'mariacioratanuM3');
});

require_once BASE_PATH . '/serviceDependencies.php';
require_once BASE_PATH . '/controllerDependencies.php';

// Router stuff
require BASE_PATH . '/app/Router.php';

$router = new Router();
require BASE_PATH . '/routes.php';

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);