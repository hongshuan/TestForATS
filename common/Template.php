<?php

namespace Common;

class Template
{
    protected $fileSuffix = '.phtml';
    protected $viewPath;
    protected $variables = array();

    public function __construct()
    {
        $this->viewPath = __DIR__ .'/../app/Views/';
    }

    public function setVars(array $vars)
    {
        $this->variables = $vars;
    }

    public function setVar($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function __get($name)
    {
        return $this->variables[$name];
    }

    public function render($file)
    {
        extract($this->variables);

        ob_start();
        require $this->viewPath . $file . $this->fileSuffix;
        $html = ob_get_clean();

        return $html;
    }

    public function e($text)
    {
        return htmlEntities($text, ENT_QUOTES);
    }
}
