<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $this->title = "Poste de Controle";
        $this->render('main/index');
    }
}
