<?php

// users ***********************************************************************
$router->get("/api/v1/users", function($_,$query_params) use ($container) {
    $controller = $container->get('userController');
//    dd($query_params);
    if (isset($query_params['email'])) {
        $controller -> getUserbyEmail($query_params['email']);
    }
    else {
        $controller->getAll();
    }   
});
$router->get("/api/v1/users/{id}", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->get($path_params['id']);
});

$router->put("/api/v1/users/{id}", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->update($path_params['id']);
});

$router->post("/api/v1/users", function() use ($container) {
    $controller = $container->get('userController');
    $controller->add();
});
$router->delete("/api/v1/users/{id}", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->remove($path_params['id']);
});
$router->get("/api/v1/users/{id}/favorites", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->getFavorites($path_params['id']);
});

$router->post("/api/v1/users/{user_id}/favorites/{product_id}", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->addFavorite($path_params['user_id'], $path_params['product_id']);
});

$router->delete("/api/v1/users/{user_id}/favorites/{product_id}", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->removeFavorite($path_params['user_id'], $path_params['product_id']);
});

$router->get("/api/v1/users/{id}/image", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->getImage($path_params['id']);
});
$router->post("/api/v1/users/{id}/image", function($path_params) use ($container) {
    $controller = $container->get('userController');
    $controller->addImage($path_params['id']);
});

// age groups ******************************************************************
$router->get("/api/v1/age_groups", function() use ($container) {
    $controller = $container->get('ageGroupController');
    $controller->getAll();
});
$router->get("/api/v1/age_groups/{id}", function($path_params) use ($container) {
    $controller = $container->get('ageGroupController');
    $controller->get($path_params);
});

// genders *********************************************************************
$router->get("/api/v1/genders", function() use ($container) {
    $controller = $container->get('genderController');
    $controller->getAll();
});
$router->get("api/v1/genders/{id}", function($path_params) use ($container) {
    $controller = $container->get('genderController');
    $controller->get($path_params);
});

// skin types ******************************************************************
$router->get("/api/v1/skin_types", function() use ($container) {
    $controller = $container->get('skinTypeController');
    $controller->getAll();
});
$router->get("/api/v1/skin_types/{id}", function($path_params) use ($container) {
    $controller = $container->get('skinTypeController');
    $controller->get($path_params);
});

// social statuses *************************************************************
$router->get("/api/v1/social_statuses", function() use ($container) {
    $controller = $container->get('socialStatusController');
    $controller->getAll();
});


// products ********************************************************************
$router->get("/api/v1/products/liked", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getLikedProducts();
});

$router->get("/api/v1/products/liked/gender", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedByGender();
});

$router->get("/api/v1/products/liked/skintype", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedBySkinType();
});

$router->get("/api/v1/products/liked/socialstatus", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedBySocialStatus();
});

$router->get("/api/v1/products/liked/zone", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedByZone();
});

$router->get("/api/v1/products/liked/agegroup", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedByAgeGroup();
});

$router->get("/api/v1/products/liked/timeofday", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedByTimeOfDay();
});

$router->get("/api/v1/products/liked/occasion", function() use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsLikedByOccasion();
});


$router->get("/api/v1/products/{id}", function ($path_params) use ($container) {
    $controller = $container->get('productController');
    $controller->get($path_params['id']);
});

$router->get("/api/v1/products", function($_, $query_params) use ($container) {
    $controller = $container->get('productController');
    if (isset($query_params['category'])) {
        $controller->getProductsCategory($query_params['category']);
    }
    else if (isset($query_params['age_group_id']) && isset ($query_params['skintype_id'])){
        $controller->getFilteredProducts($query_params);
    }
    else if (isset($query_params['search']))
        $controller->search($query_params['search']);
    else {
        $controller->getAll();
    }
});

$router->post("/api/v1/products/{id}/image", function($path_params) use ($container) {
    $controller = $container->get('productController');
    $controller->addImage($path_params['id']);
});

$router->post("/api/v1/products", function() use ($container) {
    $controller = $container->get('productController');
    $controller->add();
});
$router->delete("/api/v1/products/{id}", function($path_params) use ($container) {
    $controller = $container->get('productController');
    $controller->remove($path_params['id']);
});

$router->get("/api/v1/products/{id}/image", function($path_params) use ($container) {
    $controller = $container->get('productController');
    $controller->getImage($path_params['id']);
});

$router->get("/api/v1/product", function($path_params, $query_params) use ($container) {
    $controller = $container->get('productController');
    $controller->getProductsPage($query_params['items_per_page'], $query_params['page'], $query_params['order']);
});

// times of day ****************************************************************
$router->get("/api/v1/times_of_day", function() use ($container) {
    $controller = $container->get('timeOfDayController');
    $controller->getAll();
});
$router->get("/api/v1/times_of_day/{id}", function($path_params) use ($container) {
    $controller = $container->get('timeOfDayController');
    $controller->get($path_params);
});

// occasions *******************************************************************
$router->get("/api/v1/occasions", function() use ($container) {
    $controller = $container->get('occasionController');
    $controller->getAll();
});
$router->get("/api/v1/occasions/{id}", function($path_params) use ($container) {
    $controller = $container->get('occasionController');
    $controller->get($path_params);
});

// product categories **********************************************************
$router->get("/api/v1/product_categories", function() use ($container) {
    $controller = $container->get('productCategoryController');
    $controller->getAll();
});
$router->get("/api/v1/product_categories/{id}", function($path_params, $query_params) use ($container) {
    $controller = $container->get('productCategoryController');
    $controller->get($path_params, $query_params);
});

// zones ***********************************************************************
$router->get("/api/v1/zones", function() use ($container) {
    $controller = $container->get('zoneController');
    $controller->getAll();
});
$router->get("/api/v1/zones/{id}", function($path_params) use ($container) {
    $controller = $container->get('zoneController');
    $controller->get($path_params);
});

$router->get("/api/v1/images/{id}", function($path_params) use ($container) {
    $controller = $container->get('imageController');
    $controller->get($path_params['id']);
});