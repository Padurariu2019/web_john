<?php

require_once BASE_PATH . '/Services/AgeGroupService.php';
require_once BASE_PATH . '/Services/GenderService.php';
require_once BASE_PATH . '/Services/OccasionService.php';
require_once BASE_PATH . '/Services/ProductService.php';
require_once BASE_PATH . '/Services/ProductCategoryService.php';
require_once BASE_PATH . '/Services/ProductTypeService.php';
require_once BASE_PATH . '/Services/SkinTypeService.php';
require_once BASE_PATH . '/Services/SocialStatusService.php';
require_once BASE_PATH . '/Services/TimeOfDayService.php';
require_once BASE_PATH . '/Services/UserService.php';
require_once BASE_PATH . '/Services/UserRoleService.php';
require_once BASE_PATH . '/Services/ZoneService.php';

$container->bind('ageGroupService', function() use ($container, $config) {
    return new AgeGroupService($container->get('db'), $config['tables']['ageGroup']);
});
$container->bind('genderService', function() use ($container, $config) {
    return new GenderService($container->get('db'), $config['tables']['gender']);
});
$container->bind('occasionService', function() use ($container, $config) {
    return new OccasionService($container->get('db'), $config['tables']['occasion']);
});
$container->bind('productService', function() use ($container, $config) {
    return new ProductService($container->get('db'), $config['tables']['product'], $container->get('productCategoryService'), $container->get('zoneService'), $container->get('ageGroupService'));
});
$container->bind('productCategoryService', function() use ($container, $config) {
    return new ProductCategoryService($container->get('db'), $config['tables']['productCategory'], $container->get('productTypeService'));
});
$container->bind('productTypeService', function() use ($container, $config) {
    return new ProductTypeService($container->get('db'), $config['tables']['productType']);
});
$container->bind('skinTypeService', function() use ($container, $config) {
    return new SkinTypeService($container->get('db'), $config['tables']['skinType']);
});
$container->bind('socialStatusService', function() use ($container, $config) {
    return new SocialStatusService($container->get('db'), $config['tables']['socialStatus']);
});
$container->bind('timeOfDayService', function() use ($container, $config) {
    return new TimeOfDayService($container->get('db'), $config['tables']['timeOfDay']);
});
$container->bind('userRoleService', function() use ($container, $config) {
    return new UserRoleService($container->get('db'), $config['tables']['user_role']);
});
$container->bind('userService', function() use ($container, $config) {
    return new UserService($container->get('db'), $config['tables']['users'], $container->get('genderService'), $container->get('skinTypeService'), $container->get('socialStatusService'), $container->get('ageGroupService'), $container->get('userRoleService'),$container->get('productService'));
});
$container->bind('zoneService', function() use ($container, $config) {
    return new ZoneService($container->get('db'), $config['tables']['zone']);
});
