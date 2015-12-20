<?php

namespace App\Controllers;

use App\Controllers\Controller;

class ErrorController extends Controller
{
    public function indexAction()
    {
        return $this->render('error404', array());
    }
}
