<?php

namespace App\Controllers;

use App\Controllers\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('home', array());
    }
}
