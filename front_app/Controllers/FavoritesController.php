<?php
require_once BASE_PATH . '/Services/FavoriteService.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

class FavoritesController {
    private FavoriteService $favorites;


    public function __construct(FavoriteService $favorites) {
        $this->favorites = $favorites;
    }

    public function favorites() {
        $user_id = $_SESSION['user_id'];
        $favorites = $this->favorites->getFavorites($user_id) ?? [];
        $top_products = $this->favorites->getMostLikedProducts();

        // Get the top products by each criteria
        $top_by_gender = $this->favorites->getProductsLikedByGender();
        $top_by_skintype = $this->favorites->getProductsLikedBySkinType();
        $top_by_social_status = $this->favorites->getProductsLikedBySocialStatus();
        $top_by_zone = $this->favorites->getProductsLikedByZone();
        $top_by_age_group = $this->favorites->getProductsLikedByAgeGroup();
        $top_by_time_of_day = $this->favorites->getProductsLikedByTimeOfDay();
        $top_by_occasion = $this->favorites->getProductsLikedByOccasion();

        // Store the data in an array

        $data = [
            'top_by_gender' => $top_by_gender,
            'top_by_skintype' => $top_by_skintype,
            'top_by_social_status' => $top_by_social_status,
            'top_by_zone' => $top_by_zone,
            'top_by_age_group' => $top_by_age_group,
            'top_by_time_of_day' => $top_by_time_of_day,
            'top_by_occasion' => $top_by_occasion,
        ];



        // If the user's ID is stored in the session, proceed with displaying the favorites page
        require_once BASE_PATH . '/Views/favorites.php';
    }

}