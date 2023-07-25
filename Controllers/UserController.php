<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Core\Db;

class UserController extends Controller
{
    public function index()
    { // IF THE USER HAVE ROLE ID 2 AND IF IS NOT A CONECTED USER THAN ERROR
        if (!isset($_SESSION["user"]) || $_SESSION['user']['role_id'] == 2) {
            $this->renderError('error');
        } else {
            $db = Db::getInstance();
            $userModel = new UsersModel($db);
            $users = $userModel->getAllUsers();
            $this->renderAdmin('user', compact('users'), 'adminT');
        }
    }

    /**
     * GET ALL THE USER FOR THE ADMIN PAGE
     *
     * @return void
     */
    public function user()
    {
        if (!isset($_SESSION["user"]) || $_SESSION['user']['role_id'] == 2) {
            $this->renderError('error');
        } else {
            $db = Db::getInstance();
            $userModel = new UsersModel($db);
            $users = $userModel->getAllUsers();
            $this->renderAdmin('user', ['users' => $users], 'adminT');
        }
    }
    /**
     * CHANGE ROLE OF THE USER IN THE ADMIN PAGE
     *
     * @return void
     */
    public function changeRole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // GET THE FORM DATA
            $userId = $_POST['userId'];
            $newRole = $_POST['newRole'];
            $db = Db::getInstance();
            $userModel = new UsersModel($db);
            $userModel->updateUserRole($userId, $newRole);
            if (isset($_POST['submit'])) {
                $_SESSION['success_message'] = 'Le rôle a été modifié avec succès';
            }
            $this->user();
            return;
        }
    }

    /**
     * CREATE A USER FROM THE ADMIN PAGE
     *
     * @return void
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role_id = $_POST['role_id'];
            $db = Db::getInstance();
            $userModel = new UsersModel($db);
            // CREATE A NEW USER 
            $userModel->createUser([
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'role_id' => $role_id,
            ]);
            if (isset($_POST['submit'])) {
                $_SESSION['success_message'] = 'Le compte a été créé avec succès';
            }
            $this->user();
            return;
        }
    }

    /**
     * DELETE A USER FROM THE ADMIN PAGE
     *
     * @return void
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['id'];
            $db = Db::getInstance();
            $userModel = new UsersModel($db);
            // DELETE CURRENT USER
            $userModel->delete($userId);
            if (isset($_POST['submit'])) {
                $_SESSION['success_message'] = 'L\'utilisateur a été supprimé avec succès';
            }
            $this->user();
            return;
        }
    }
}
