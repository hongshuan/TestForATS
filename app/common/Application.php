<?php

namespace Common;

class Application
{
    protected $config;
    protected $errhandler;
    protected $router;
    protected $logger;
    protected $database;
    protected $request;
    protected $session;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    protected function init()
    {
        $this->errhandler = new ErrorHandler();
        $this->errhandler->register();

        $this->logger = new Logger();

        $this->database = new Database($this->config);
        $this->database->setLogger($this->logger);

        $this->request = new Request();

        $this->session = new Session();
        $this->session->start();

        $this->router = new Router();
        $this->router->match();
    }

    protected function dispatch()
    {
        $namespace = 'App\\Controllers\\';

        $class = $this->router->getController();
        $class = $namespace . $class;

        $method = $this->router->getAction();
        $method = $method . 'Action';

        $parameters = $this->router->getParameters();

        $controller = new $class($this);
        $response = call_user_func_array(array($controller, $method), $parameters);

        return $response;
    }

    public function run()
    {
        $this->init();

        echo $this->dispatch();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getSession()
    {
        return $this->session;
    }
}
