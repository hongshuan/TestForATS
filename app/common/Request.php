<?php

namespace Common;

class Request
{
    public function all()
    {
        return $_REQUEST;
    }

    public function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public function getPost($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isMethod($method)
    {
        return $this->getMethod() === strtoupper($method);
    }
}
