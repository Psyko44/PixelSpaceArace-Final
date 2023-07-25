<?php

namespace App\Controllers;

class DeconnexionController extends Controller
{
    public function index()
    {
        setcookie('PHPSESSID', '', time() - 3600, '/');
        session_destroy();
        header("Location: /");
        exit();
    }
}
