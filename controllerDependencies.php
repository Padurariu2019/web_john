<?php

require_once BASE_PATH . '/Controllers/AgeGroupController.php';
require_once BASE_PATH . '/Controllers/GenderController.php';
require_once BASE_PATH . '/Controllers/OccasionController.php';
require_once BASE_PATH . '/Controllers/ProductController.php';
require_once BASE_PATH . '/Controllers/ProductCategoryController.php';
require_once BASE_PATH . '/Controllers/ProductTypeController.php';
require_once BASE_PATH . '/Controllers/SkinTypeController.php';
require_once BASE_PATH . '/Controllers/SocialStatusController.php';
require_once BASE_PATH . '/Controllers/TimeOfDayController.php';
require_once BASE_PATH . '/Controllers/UserController.php';
require_once BASE_PATH . '/Controllers/ZoneController.php';
require_once BASE_PATH . '/Controllers/ImageController.php';

$container->bind('genderController', function() use ($container) {
    return new GenderController($container->get('genderService'));
});
$container->bind('ageGroupController', function() use ($container) {
    return new AgeGroupController($container->get('ageGroupService'));
});
$container->bind('genderController', function() use ($container) {
    return new GenderController($container->get('genderService'));
});
$container->bind('occasionController', function() use ($container) {
    return new OccasionController($container->get('occasionService'));
});
$container->bind('productController', function() use ($container) {
    return new ProductController($container->get('productService'),$container->get('zoneService'),$container->get('productCategoryService'),$container->get('ageGroupService'));
});
$container->bind('productCategoryController', function() use ($container) {
    return new ProductCategoryController($container->get('productCategoryService'));
});
$container->bind('productTypeController', function() use ($container) {
    return new ProductTypeController($container->get('productTypeService'));
});
$container->bind('skinTypeController', function() use ($container) {
    return new SkinTypeController($container->get('skinTypeService'));
});
$container->bind('socialStatusController', function() use ($container) {
    return new SocialStatusController($container->get('socialStatusService'));
});
$container->bind('timeOfDayController', function() use ($container) {
    return new TimeOfDayController($container->get('timeOfDayService'));
});
$container->bind('userController', function() use ($container) {
    return new UserController($container->get('userService'), $container->get('genderService'), $container->get('skinTypeService'), $container->get('socialStatusService'), $container->get('ageGroupService'), $container->get('userRoleService') ,$container->get('productService'));
});
$container->bind('zoneController', function() use ($container) {
    return new ZoneController($container->get('zoneService'));
});
$container->bind('imageController', function() use ($container) {
    return new ImageController();
});
