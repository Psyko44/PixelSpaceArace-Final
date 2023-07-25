<?php

namespace App\Controllers;

use App\Core\Db;
use App\Models\UsersModel;
use App\Models\OrdersModel;

class UseraccountController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: /login/index");
            exit();
        }
        $id = $_SESSION['user']['id'];
        $this->title = "Mon compte";
        $this->orderHistory($id);
        $this->render('useraccount/index');
    }

    /**
     * UPDATE AN USER FROM THE DATABASE
     *
     * @return void
     */
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $old_password = $_POST['old_pass'];
            // CHECK IF OLD PASSWORD IS NOT EMPTY
            if (empty($old_password)) {
                $errorMessage = 'Veuillez fournir l\'ancien mot de passe.';
            } else {
                $db = Db::getInstance();
                $usersModel = new UsersModel($db);
                // CHECK IF USER EXIST
                $user = $usersModel->getUserById($id);
                if (!$user) {
                    $errorMessage = 'Aucun utilisateur trouvé avec cet ID.';
                } else {
                    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : $user['username'];
                    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : $user['email'];
                    $phone = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : $user['phone'];
                    // CHECK IF NEW EMAIL IS ALREADY USED
                    if ($email !== $user['email'] && $usersModel->getUserByEmail($email)) {
                        $errorMessage = 'Un utilisateur avec cette adresse email existe déjà.';
                    } else {
                        // CHECK OLD PASSWORD BEFORE CHANGING
                        if (!password_verify($old_password, $user['pass'])) {
                            $errorMessage = 'L\'ancien mot de passe ne correspond pas.';
                        } else {
                            if (isset($_POST['pass']) && $_POST['pass'] === $_POST['confirm_pass']) {
                                $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                            } elseif (!isset($_POST['pass']) && !isset($_POST['confirm_pass'])) {
                                $password = $user['pass'];
                            } else {
                                $errorMessage = 'Les mots de passe ne correspondent pas.';
                            }
                            $userData = [
                                'username' => $username,
                                'pass' => $password,
                                'email' => $email,
                                'phone' => $phone
                            ];
                            $query = "UPDATE users SET username = ?, pass = ?, email = ?, phone = ? WHERE id = ?";
                            $params = [
                                $username,
                                $password,
                                $email,
                                $phone,
                                $id
                            ];
                            $stmt = $db->prepare($query);
                            $stmt->execute($params);
                            if ($stmt->rowCount() > 0) {
                                echo "L'utilisateur a été mis à jour avec succès. ID de l'utilisateur : $id";
                            } else {
                                $errorMessage = "Une erreur est survenue lors de la mise à jour de l'utilisateur.";
                            }
                        }
                    }
                }
            }
            if (isset($errorMessage)) {
            }
        }
        $this->index();
    }

    /**
     * GET ALL THE ITEMS OF THE USER TO AN HISTORY IN THE USERACCOUNT
     *
     * @param [type] $id
     * @return void
     */
    public function orderHistory($id)
    {
        if (!is_int($id)) {
            die('L\'identifiant de l\'utilisateur doit être un entier.');
        }
        $db = Db::getInstance();
        $orderModel = new OrdersModel($db);
        $usersModel = new UsersModel($db);
        $user = $usersModel->getUserById($id);
        $orders = $orderModel->getUserOrders($id);
        if ($user == null) {
            $this->render('error', ['message' => "L'utilisateur n'existe pas."], 'default');
            return;
        }
        if (empty($orders)) {
            $this->render('useraccount/index', ['message' => "Aucune commande pour cet utilisateur"], 'default');
            return;
        }
        $this->render('useraccount/index', compact('orders'), 'default');
    }
}
