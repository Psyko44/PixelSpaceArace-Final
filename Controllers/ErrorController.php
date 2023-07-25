<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function index()
    {
        $this->title = "Erreur";
        $this->renderError('error/index');
    }
}
