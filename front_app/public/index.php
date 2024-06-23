<?php

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function deleteSession() {
    if(session_status() != PHP_SESSION_NONE){
        session_start();
    }
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}

const BASE_PATH = __DIR__ . '/..';

$apiUrl = 'http://localhost:5050/api/v1';

// Dependency injection container
require BASE_PATH . '/app/DependencyContainer.php';
$container = new DependencyContainer();

require BASE_PATH . '/serviceDependencies.php';
require_once BASE_PATH . '/controllerDependencies.php';
require_once BASE_PATH . '/middlewareDependencies.php';

// Router stuff
require BASE_PATH . '/app/Router.php';

$router = new Router();
require BASE_PATH . '/routes.php';

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);