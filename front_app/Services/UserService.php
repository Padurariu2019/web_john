<?php
require_once BASE_PATH . '/Models/User.php';
require_once BASE_PATH . '/Models/UserDTO.php';
class UserService {
    private $curl;
    public function __construct($curl) {
        $this->curl = $curl;
    }
    public function get(int $id) {
        $res = $this->curl->get('/users/' . $id)['result'];
        $user = json_decode($res, true);
        return new User($user['id'], $user['name'], $user['email'], $user['password']);
    }

    public function update(int $user_id, $user) {
        return $this->curl->put('/users/' . $user_id, json_encode($user));
    }

    public function getAll() {
        $res = $this->curl->get('/users')['result'];
        $res = json_decode($res, true);

        $users = [];
        foreach ($res as $user) {
            $users[] = new User($user['id'], $user['name'], $user['email'], $user['password']);
        }
        return $users;
    }

    public function add(UserDTO $user) {
        $res = $this->curl->post('/users', json_encode($user));
        return $res;
    }

    public function uploadPic($user_id, $file) {
        $res = $this->curl->upload('/users/' . $user_id . '/image', $file);
        return $res;
    }

    public function getUserByEmail($email) {
        return $this->curl->get('/users?email=' . $email);
    }

}