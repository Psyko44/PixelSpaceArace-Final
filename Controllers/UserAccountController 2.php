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

        $id = $_SESSION['user']['id']; // Récupérer l'ID de l'utilisateur connecté
        $this->orderHistory($id); // Afficher l'historique des commandes de l'utilisateur

        $this->render('useraccount/index'); // Rendre la vue "useraccount/index.php"
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id = $_POST['id'];
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
                    $username = isset($_POST['username']) ? $_POST['username'] : $user['username'];
                    $email = isset($_POST['email']) ? $_POST['email'] : $user['email'];
                    $phone = isset($_POST['tel']) ? $_POST['tel'] : $user['phone'];

                    // CHECK IF NEW EMAIL IS ALREADY USED
                    if ($email !== $user['email'] && $usersModel->getUserByEmail($email)) {
                        $errorMessage = 'Un utilisateur avec cette adresse email existe déjà.';
                    } else {
                        // CHECK OLD PASSWORD BEFORE CHANGING
                        if (!password_verify($old_password, $user['pass'])) {
                            $errorMessage = 'L\'ancien mot de passe ne correspond pas.';
                        } else {
                            if (isset($_POST['pass']) && $_POST['pass'] === $_POST['confirm_pass']) {
                                // Utilisez password_hash pour hacher le mot de passe
                                $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                            } elseif (!isset($_POST['pass']) && !isset($_POST['confirm_pass'])) {
                                // Gardez l'ancien mot de passe si aucun nouveau mot de passe n'a été fourni
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

                            // Utilisez des requêtes préparées avec des paramètres liés
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
                // Afficher l'erreur dans la vue appropriée
            }
        }

        $this->index();
    }

    public function orderHistory($id)
    {
        // Vérifier que $id est bien un entier
        if (!is_int($id)) {
            die('L\'identifiant de l\'utilisateur doit être un entier.');
        }

        // Le reste du code reste inchangé
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
