<?php
require_once BASE_PATH . '/Services/UserService.php';

class FavoriteService
{
    private $curl;

    public function __construct($curl)
    {
        $this->curl = $curl;
    }
    public function getFavorites($user_id)
    {
        $res = $this->curl->get('/users/' . $user_id . '/favorites');
        $favorites = json_decode($res['result'], true);
        return $favorites;
    }

    public function getMostLikedProducts()
    {
        $res = $this->curl->get('/products/liked');
        $top_products = json_decode($res['result'], true);
        return $top_products;
    }

    public function addFavorite($user_id, $product_id)
    {
        $res = $this->curl->post('/favorites', json_encode(['user_id' => $user_id, 'product_id' => $product_id]));
        return $res;
    }

    public function removeFavorite($user_id, $product_id)
    {
        $res = $this->curl->delete('/favorites', json_encode(['user_id' => $user_id, 'product_id' => $product_id]));
        return $res;
    }

    public function getProductsLikedByGender() {
        $res = $this->curl->get('/products/liked/gender');
        $top_by_gender = json_decode($res['result'], true);
        return $top_by_gender;
    }

    public function getProductsLikedBySkinType() {
        $res = $this->curl->get('/products/liked/skintype');
        $top_by_skintype = json_decode($res['result'], true);
        return $top_by_skintype;
    }

    public function getProductsLikedBySocialStatus() {
        $res = $this->curl->get('/products/liked/socialstatus');
        $top_by_social_status = json_decode($res['result'], true);
        return $top_by_social_status;
    }

    public function getProductsLikedByZone() {
        $res = $this->curl->get('/products/liked/zone');
        $top_by_zone = json_decode($res['result'], true);
        return $top_by_zone;
    }

    public function getProductsLikedByAgeGroup() {
        $res = $this->curl->get('/products/liked/agegroup');
        $top_by_age_group = json_decode($res['result'], true);
        return $top_by_age_group;
    }

    public function getProductsLikedByTimeOfDay() {
        $res = $this->curl->get('/products/liked/timeofday');
        $top_by_time_of_day = json_decode($res['result'], true);
        return $top_by_time_of_day;
    }

    public function getProductsLikedByOccasion() {
        $res = $this->curl->get('/products/liked/occasion');
        $top_by_occasion = json_decode($res['result'], true);
        return $top_by_occasion;
    }

}