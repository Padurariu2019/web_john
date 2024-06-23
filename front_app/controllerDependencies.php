<?php

require BASE_PATH . '/Controllers/SignupController.php';
require BASE_PATH . '/Controllers/ProductsController.php';
require BASE_PATH . '/Controllers/AboutController.php';
require BASE_PATH . '/Controllers/AccountController.php';
require BASE_PATH . '/Controllers/AdminController.php';
require BASE_PATH . '/Controllers/ContactController.php';
require BASE_PATH . '/Controllers/CosmeticsController.php';
require BASE_PATH . '/Controllers/RecommendationsController.php';
require BASE_PATH . '/Controllers/SigninController.php';
require BASE_PATH . '/Controllers/SkinController.php';
require BASE_PATH . '/Controllers/FavoritesController.php';
require BASE_PATH . '/Controllers/LogoutController.php';
require BASE_PATH . '/Controllers/DocsController.php';


$container->bind('SignupController', function() use ($container) {
    return new SignupController($container->get('UserService'),
                                $container->get('GenderService'),
                                $container->get('SkinTypeService'),
                                $container->get('SocialStatusService'),
                                $container->get('AgeGroupService'));
});
$container->bind('ProductsController', function() use ($container) {
    return new ProductsController();
});
$container->bind('AboutController', function() use ($container) {
    return new AboutController();
});
$container->bind('AccountController', function() use ($container) {
    return new AccountController($container->get('GenderService'),
                                 $container->get('SkinTypeService'),
                                 $container->get('SocialStatusService'),
                                 $container->get('AgeGroupService'),
                                 $container->get('UserService'));
});
$container->bind('AdminController', function() use ($container) {
    return new AdminController($container->get('ProductService'),
                               $container->get('CategoryService'),
                               $container->get('ZoneService'),
                               $container->get('AgeGroupService'),
                               $container->get('OccasionService'),
                               $container->get('TimeOfDayService'),
                               $container->get('SkinTypeService'));
});
$container->bind('ContactController', function() use ($container) {
    return new ContactController();
});
$container->bind('CosmeticsController', function() use ($container) {
    return new CosmeticsController($container->get('OccasionService'),
                                   $container->get('AgeGroupService'),
                                   $container->get('SkinTypeService'));
});
$container->bind('RecommendationsController', function() use ($container) {
    return new RecommendationsController($container->get('AgeGroupService'),
                                        $container->get('SkinTypeService'),
                                        $container->get('OccasionService'),
                                        $container->get('TimeOfDayService'));
});
$container->bind('SigninController', function() use ($container) {
    $userService = $container->get('UserService');
    return new SigninController($userService);
});
$container->bind('SkinController', function() use ($container) {
    return new SkinController($skinTypeService = $container->get('SkinTypeService'),
                              $ageGroupService = $container->get('AgeGroupService'),
                              $timeOfDayService = $container->get('TimeOfDayService'));
});
$container->bind('FavoritesController', function() use ($container) {
    return new FavoritesController($container->get('FavoriteService'));
});
$container->bind('LogoutController', function() use ($container) {
    return new LogoutController();
});
$container->bind('DocsController', function() use ($container) {
    return new DocsController();
});
