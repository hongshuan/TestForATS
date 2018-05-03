<?php

namespace App\Common;

/**
 * This is just a project-specific ClassAutoLoader,
 * it works only for this project, cannot work with other frameworks.
 * the best solution is using Composer instead.
 */
class AutoLoader
{
    protected $basedir;

    public function __construct($basedir)
    {
        $this->basedir = $basedir;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass($class)
    {
        // Common\Database      => $basedir/common/Database.php
        // App\Models\UserModel => $basedir/app/Models/UserModel.php

        $parts = explode('\\', $class);
        $parts[0] = strtolower($parts[0]);

        $filename = $this->basedir . '/../' . implode('/', $parts) . '.php';

        if (file_exists($filename)) {
            require $filename;
        }
    }
}
