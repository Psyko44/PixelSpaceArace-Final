<?php

namespace App\Controllers;

use App\Core\Db;
use App\Models\UsersModel;

class LoginController extends Controller
{

    /**
     * MAKE THE RENDER WITH ALL DATA 
     *
     * @return void
     */
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            //IF USER IS ALREADY CONNECTED
            header("Location: /useraccount");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['pass']);
            if ($email && $password) {
                $db = Db::getInstance();
                $userModel = new UsersModel($db);
                $user = $userModel->getUserByEmail($email);
                if ($user && password_verify($password, $user->getPass())) {
                    $_SESSION["user"] = [
                        "id" => $user->getId(),
                        "username" => $user->getUsername(),
                        "email" => $user->getEmail(),
                        "role_id" => $user->getRoleId()
                    ];
                    if ($user->getRoleId() == 1) {
                        header("Location: /user");
                        return;
                    } else {
                        header("Location: /useraccount");
                        return;
                    }
                } else {
                    $_SESSION["error"] = "Utilisateur et/ou mot de passe incorrect";
                }
            } else {
                $_SESSION["error"] = "Le formulaire est incomplet";
            }
        }
        $this->title = "Connexion";
        $this->render('login/index');
    }
}
