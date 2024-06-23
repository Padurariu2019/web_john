<?php

require_once 'Gender.php';
require_once 'SkinType.php';
require_once 'SocialStatus.php';
require_once 'AgeGroup.php';
require_once 'UserRole.php';
require_once 'Product.php';

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $city;
    public $picture_path;
    public Gender $gender;
    public SkinType $skinType;
    public SocialStatus $socialStatus;
    public AgeGroup $ageGroup;
    public UserRole $userRole;
    public array $likedProducts; // New property

    public function __construct($id, $name, $email, $password, $city, $picture_path, $gender, $skinType, $socialStatus, $ageGroup, $userRole, $likedProducts) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->city = $city;
        $this->picture_path = $picture_path;
        $this->gender = $gender;
        $this->skinType = $skinType;
        $this->socialStatus = $socialStatus;
        $this->ageGroup = $ageGroup;
        $this->userRole = $userRole;
        $this->likedProducts = $likedProducts; // Set the new property
    }

    public static function from_array($array) {
        // Instantiate the liked products from the array
        $likedProducts = array_map(function($product) {
            return Product::from_array($product);
        }, $array['likedProducts']);

        // Include the liked products when constructing the User object
        return new User($array['id'], $array['name'], $array['email'], $array['password'], $array['city'], $array['picture_path'], $array['gender'], $array['skinType'], $array['socialStatus'], $array['ageGroup'], $array['userRole'], $likedProducts);
    }
}