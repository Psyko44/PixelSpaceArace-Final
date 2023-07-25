<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function index()
    {
        $this->renderError('error/index');
    }
}
