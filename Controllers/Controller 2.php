<?php

namespace App\Controllers;

abstract class Controller
{
    public function render(string $fichier, array $data = [], $destination = 'default')
    {
        extract($data);
        ob_start();
        if (!empty($fichier)) {
            // MAKE THE ROAD FOR THE VIEWS
            require_once(ROOT . '/Views/' . $fichier . '.php');
        }
        // $CONTENT = MAIN OF ALL PAGE 
        $content = ob_get_clean();
        // MAKE THE TEMPLATE
        require_once(ROOT . '/Views/' . $destination . '.php');
    }
    // SAME FOR THE ADMIN PAGE TEMPLATE 
    public function renderAdmin(string $viewFolder, array $data = [], $destination = 'adminT')
    {
        extract($data);
        $contentAdmin = ROOT . '/Views/admin/' . $viewFolder . '/index.php';
        require_once(ROOT . '/Views/adminT.php');
    }
    public function renderError(string $viewFolder, array $data = [], $destination = 'errorT')
    {
        extract($data);
        $contentError = ROOT . '/Views/' . $viewFolder . '/index.php';

        require_once(ROOT . '/Views/errorT.php');
    }
}
