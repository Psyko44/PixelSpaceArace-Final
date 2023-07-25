<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Core\Db;

abstract class Controller
{
    // $TITLE IS THE NAME OF ALL THE PAGE 
    protected $title;
    /**
     * MAKE THE RENDER FOR THE PAGE OF THE WEBSITE 
     *
     * @param string $fichier
     * @param array  $data
     * @param string $destination
     * @return void
     */
    public function render(string $fichier, array $data = [], $destination = 'default')
    {
        // Setting the page title as per the view file name
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
    /**
     * MAKE THE RENDER FOR THE ADMIN PAGE
     *
     * @param string $viewFolder
     * @param array  $data
     * @param string $destination
     * @return void
     */
    public function renderAdmin(string $viewFolder, array $data = [], $destination = 'adminT')
    {
        $db = Db::getInstance();
        $userModel = new UsersModel($db);
        $userAdmin = $userModel->getUsername();
        $userAdmin = $_SESSION['user']['username'];
        extract($data);
        $contentAdmin = ROOT . '/Views/admin/' . $viewFolder . '/index.php';
        require_once(ROOT . '/Views/adminT.php');
    }
    /**
     * MAKE THE RENDER FOR ALL THE ERROR URL
     *
     * @param string $viewFolder
     * @param array  $data
     * @param string $destination
     * @return void
     */
    public function renderError(string $viewFolder, array $data = [], $destination = 'errorT')
    {
        extract($data);
        $contentError = ROOT . '/Views/' . $viewFolder . '/index.php';
        require_once(ROOT . '/Views/errorT.php');
    }
}
