<?php

namespace App\Controllers;

use App\Core\Db;
use App\Models\UsersModel;

class LoginController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["user"])) {
            $this->render('useraccount/index');

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim(htmlspecialchars(stripslashes($_POST['email'])));
            $password = trim(htmlspecialchars(stripslashes($_POST['pass'])));

            if ($email && $password) {
                $db = Db::getInstance();
                $userModel = new UsersModel($db);
                $user = $userModel->getUserByEmail($email);

                if ($user && password_verify($password, $user->getPass())) {
                    $_SESSION["user"] = [
                        "id" => $user->getId(),
                        "pseudo" => $user->getUsername(),
                        "email" => $user->getEmail(),
                        "role_id" => $user->getRoleId()
                    ];
                    if ($user->getRoleId() == 1) {
                        header("Location: /user");
                        return;
                    } else {
                        $this->render('useraccount/index');
                        return;
                    }
                } else {
                    $_SESSION["error"][] = "Utilisateur et/ou mot de passe incorrect";
                }
            } else {
                $_SESSION["error"][] = "Le formulaire est incomplet";
            }
        }

        $this->render('/login/index');
    }
}
