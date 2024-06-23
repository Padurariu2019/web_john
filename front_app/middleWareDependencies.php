<?php

require_once BASE_PATH . '/app/Middleware/UserMiddleware.php';
require_once BASE_PATH . '/app/Middleware/AdminMiddleware.php';

$container->bind("UserMiddleware", function () { 
    return new UserMiddleware();
});
$container->bind("AdminMiddleware", function () { 
    return new AdminMiddleware();
});
