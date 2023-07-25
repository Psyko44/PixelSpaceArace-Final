<?php

namespace App\Controllers;

use App\Core\Db;
use App\Models\UsersModel;
use App\Models\MessageModel;

class SosContactController extends Controller
{
    public function index()
    {
        $message = $this->handleContactForm();
        $this->render('soscontact/index', compact('message'));
    }

    private function handleContactForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
            $email = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : null;
            $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : null;
            $created_at = date("Y-m-d H:i:s");

            if ($name && $email && $message) {
                $dbConnection = Db::getInstance();
                $messageModel = new MessageModel($dbConnection);
                $messageModel->createContactMessage($name, $email, $message, $created_at);

                if (isset($_POST['submit'])) {
                    return "<div id='successMessageF' class='taskDone'>Message envoyé avec succès</div>";
                }
            } else {
                return 'Tous les champs sont obligatoires.';
            }
        }
    }
}
