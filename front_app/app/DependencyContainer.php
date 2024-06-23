<?php

class DependencyContainer {
    private $dependencies = [];

    public function bind($name, Closure $closure) {
        $this->dependencies[$name] = $closure;
    }

    public function get($name) {
        if (isset($this->dependencies[$name])) {
            return $this->dependencies[$name]();
        } else {
            throw new Exception("Dependency not found: $name");
        }
    }
}