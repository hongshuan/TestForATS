<?php

namespace App\Controllers;

use App\Common\Application;
use App\Common\Template;

class Controller
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function render($file, array $data)
    {
        $template = new Template();
        $template->setVars($data);

        return $template->render($file);
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }

    public function getConfig()
    {
        return $this->app->getConfig();
    }

    public function getLogger()
    {
        return $this->app->getLogger();
    }

    public function getDatabase()
    {
        return $this->app->getDatabase();
    }

    public function getRequest()
    {
        return $this->app->getRequest();
    }

    public function getSession()
    {
        return $this->app->getSession();
    }
}
