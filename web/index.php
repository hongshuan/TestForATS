<?php

require __DIR__ . '/../Common/AutoLoader.php';

use Common\Config;
use Common\AutoLoader;
use Common\Application;

$loader = new AutoLoader(__DIR__);
$loader->register();

$config = new Config(__DIR__ . '/../app/Config/config.ini');

$app = new Application($config);
$app->run();
