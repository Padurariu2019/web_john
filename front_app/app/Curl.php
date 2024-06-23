<?php

class Curl {
    private $curl;
    private $apiBaseUrl;

    public function __construct($apiBaseUrl) {
        $this->curl = curl_init();
        $this->apiBaseUrl = $apiBaseUrl;
    }

    private function wrapResult() {
        return array('result' => curl_exec($this->curl), 'statusCode' => curl_getinfo($this->curl, CURLINFO_HTTP_CODE));
    }

    public function post($resource, $data) {
        curl_setopt($this->curl, CURLOPT_URL, $this->apiBaseUrl . $resource);
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_close($this->curl);
        return $this->wrapResult();
    }

    public function get($resource) {
        curl_setopt($this->curl, CURLOPT_URL, $this->apiBaseUrl . $resource);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_close($this->curl);
        return $this->wrapResult();
    }

    public function put($resource, $data) {
        curl_setopt($this->curl, CURLOPT_URL, $this->apiBaseUrl . $resource);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_close($this->curl);
        return $this->wrapResult();
    }

    public function upload($resource, $file) {
        $cfile = curl_file_create($file['tmp_name'], $file['type'], $file['name']);
        $data = array('image' => $cfile);
        curl_setopt($this->curl, CURLOPT_URL, $this->apiBaseUrl . $resource);
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_close($this->curl);
        return $this->wrapResult();
    }
}