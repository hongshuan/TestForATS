<?php

namespace Common;

class Router
{
    protected $routes = array();
    protected $controller;
    protected $action;
    protected $parameters;

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../app/Config/routes.php';
    }

    public function match()
    {
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $route => $action) {
            if (preg_match('#^'. $route .'$#', $uri, $matches)) {
                $parts = explode('::', $action);
                $this->controller = $parts[0];
                $this->action = $parts[1];
                $this->parameters = array_slice($matches, 1);
                return true;
            }
        }

        $this->controller = 'ErrorController';
        $this->action = 'index';

        return false;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParameters()
    {
        if ($this->parameters === null) {
            return array();
        }
        return $this->parameters;
    }
}
