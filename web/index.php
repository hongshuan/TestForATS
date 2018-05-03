<?php

define('BASE_DIR', dirname(__DIR__));

require BASE_DIR . '/app/Common/AutoLoader.php';

use App\Common\Config;
use App\Common\AutoLoader;
use App\Common\Application;

$loader = new AutoLoader(BASE_DIR);
$loader->register();

$config = new Config(BASE_DIR . '/app/Config/config.ini');

$app = new Application($config);
$app->run();
