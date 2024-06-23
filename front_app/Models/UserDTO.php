<?php

class UserDTO {
    public string $name;
    public string $email;
    public string $city;
    public string $password;
    public int $gender_id;
    public int $age_group_id;
    public int $skin_type_id;
    public int $social_status_id;
    public function __construct(string $name, 
                                string $email, 
                                string $city, 
                                string $password,
                                int $gender_id, 
                                int $age_group_id, 
                                int $skin_type_id, 
                                int $social_status_id) {
        $this->name = $name;
        $this->email = $email;
        $this->city = $city;
        $this->password = $password;
        $this->gender_id = $gender_id;
        $this->age_group_id = $age_group_id;
        $this->skin_type_id = $skin_type_id;
        $this->social_status_id = $social_status_id;
    }
}