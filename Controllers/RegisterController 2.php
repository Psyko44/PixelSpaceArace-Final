<?php

namespace App\Controllers;

use App\Core\Db;
use App\Models\UsersModel;

class RegisterController extends Controller
{
    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $confirm_password = $_POST['confirm_pass'];
            $phone = $_POST['tel'];
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                die('Veuillez remplir tous les champs obligatoires.');
                return;
            }
            if ($password !== $confirm_password) {
                die('Les mots de passe ne correspondent pas.');
                return;
            }
            $db = Db::getInstance();
            $usersModel = new UsersModel($db);
            // CHECK IF USER EXIST
            if ($usersModel->getUserByEmail($email)) {
                die('Un utilisateur avec cette adresse email existe déjà.');
                return;
            }
            $userData = [
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'role_user' => 2
            ];
            $userId = $usersModel->createUser($userData);
            $usersModel->assignRole($userId, 2);
            if ($userId) {
                echo "L'utilisateur a été créé avec succès. ID de l'utilisateur : $userId";
            } else {
                echo "Une erreur est survenue lors de la création de l'utilisateur.";
            }
            return;
        }
        $this->render('register/index');
    }
}
