<?php

class ImageController
{
    public function get($id) : void {
        // dd(BASE_PATH . 'img/' . $id . '.jpg');
        header('Content-Type: image/jpeg');
        readfile(BASE_PATH . '/img/' . $id . '.jpg');
    }

    public function add() : void
    {

    }

    public function remove($id) : void {
    }

}