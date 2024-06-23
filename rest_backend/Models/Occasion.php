<?php

class Occasion {
    public $id;
    public $occasion;
    public $description;

    public function __construct($id, $occasion, $description) {
        $this->id = $id;
        $this->occasion = $occasion;
        $this->description = $description;
    }
}