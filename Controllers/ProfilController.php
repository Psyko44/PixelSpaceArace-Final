<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Core\Db;

class ProfilController extends Controller
{
    public function index()
    {
        $this->render('profil/index');
    }
    /**
     * VERIFY IF THE USER IS CONECTED AND RENDER TO THE USER PAGE
     *
     * @return void
     */
    public function useraccount()
    {
        if (!isset($_SESSION["user"])) {
            $this->render('/login/index');
            exit();
        }
        $user = $_SESSION["user"];
        $db = Db::getInstance();
        $userModel = new UsersModel($db);
        $userData = $userModel->getUserById($user['id']);
        $this->render('profil/useraccount', ['user' => $userData]);
    }
}
