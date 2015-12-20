<?php

return array(
    '/' => 'HomeController::index',

    '/login'    => 'UserController::login',
    '/register' => 'UserController::register',
    '/logout'   => 'UserController::logout',
    '/welcome'  => 'UserController::welcome',

    '/error404' => 'ErrorController::index',
);
