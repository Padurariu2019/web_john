<?php

require_once BASE_PATH . '/app/Curl.php';
require_once BASE_PATH . '/Services/AgeGroupService.php';
require_once BASE_PATH . '/Services/GenderService.php';
require_once BASE_PATH . '/Services/SkinTypeService.php';
require_once BASE_PATH . '/Services/SocialStatusService.php';
require_once BASE_PATH . '/Services/ProductService.php';
require_once BASE_PATH . '/Services/UserService.php';
require_once BASE_PATH . '/Services/CategoryService.php';
require_once BASE_PATH . '/Services/ZoneService.php';
require_once BASE_PATH . '/Services/OccasionService.php';
require_once BASE_PATH . '/Services/TimeOfDayService.php';

$container->bind('curl', function() {
    return new Curl('localhost:5050/api/v1');
});

$container->bind('UserService', function() use ($container) {
    return new UserService($container->get('curl'));
});

$container->bind('AgeGroupService', function() use ($container) {
    return new AgeGroupService($container->get('curl'));
});

$container->bind('GenderService', function() use ($container) {
    return new GenderService($container->get('curl'));
});

$container->bind('SkinTypeService', function() use ($container) {
    return new SkinTypeService($container->get('curl'));
});

$container->bind('SocialStatusService', function() use ($container) {
    return new SocialStatusService($container->get('curl'));
});

$container->bind('ProductService', function() use ($container) {
    return new ProductService($container->get('curl'));
});

$container->bind('CategoryService', function() use ($container) {
    return new CategoryService($container->get('curl'));
});

$container->bind('ZoneService', function() use ($container) {
    return new ZoneService($container->get('curl'));
});

$container->bind('OccasionService', function() use ($container) {
    return new OccasionService($container->get('curl'));
});

$container->bind('TimeOfDayService', function() use ($container) {
    return new TimeOfDayService($container->get('curl'));
});

$container->bind('FavoriteService', function() use ($container) {
    return new FavoriteService($container->get('curl'));
});