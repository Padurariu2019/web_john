<?php

$router->get("/admin", function() use ($container) {
    $controller = $container->get('AdminController');
    $controller->admin();
})->use($container->get('AdminMiddleware'));
$router->post("/admin", function() use ($container) {
    $controller = $container->get('AdminController');
    $controller->addProduct();
})->use($container->get('AdminMiddleware'));

$router->get("/", function() use ($container) {
    $controller = $container->get('SignupController');
    $controller->index();
});
$router->post("/", function() use ($container) {
    $controller = $container->get('SignupController');
    $controller->createUser();
});
$router->get("/about", function() use ($container) {
    $controller = $container->get('AboutController');
    $controller->about();
})->use($container->get('UserMiddleware'));
$router->get("/account", function() use ($container) {
    $controller = $container->get('AccountController');
    $controller->account();
})->use($container->get('UserMiddleware'));

$router->post("/account", function() use ($container) {
    $controller = $container->get('AccountController');
    $controller->updateUser();
})->use($container->get('UserMiddleware'));


$router->get("/contact", function() use ($container) {
    $controller = $container->get('ContactController');
    $controller->contact();
})->use($container->get('UserMiddleware'));
$router->get("/cosmetics", function() use ($container) {
    $controller = $container->get('CosmeticsController');
    $controller->cosmetics();
})->use($container->get('UserMiddleware'));
$router->get("/products", function($_, $queryParams) use ($container) {
    $controller = $container->get('ProductsController');
    $controller->products($queryParams);
})->use($container->get('UserMiddleware'));
$router->post("/recommendations", function() use ($container) {
    $controller = $container->get('RecommendationsController');
    $controller->recommendations();
})->use($container->get('UserMiddleware'));
$router->get("/sign_in", function() use ($container) {
    $controller = $container->get('SigninController');
    $controller->sign_in();
});
$router->post('/sign_in', function() use ($container) {
    $controller = $container->get('SigninController');
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $controller->login($_POST['email'], $_POST['password']);
    } else {
        // Handle missing email or password
        echo 'Email or password not provided';
    }
});
$router->get("/skin", function() use ($container) {
    $controller = $container->get('SkinController');
    $controller->skin();
})->use($container->get('UserMiddleware'));
$router->get("/favorites", function() use ($container) {
    $controller = $container->get('FavoritesController');
    $controller->favorites();
})->use($container->get('UserMiddleware'));
$router->get("/logout", function() use ($container) {
    $controller = $container->get('LogoutController');
    $controller->logout();
})->use($container->get('UserMiddleware'));
$router->get("/docs", function() use ($container) {
    $controller = $container->get('DocsController');
    $controller->showDocs();
});