<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Core\Db;


class MessageUserController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION["user"]) || $_SESSION['user']['role_id'] == 2) {
            $this->renderError('error');
        }

        $db = Db::getInstance();
        $messageModel = new MessageModel($db);

        $messages = $messageModel->findAll();

        $this->renderAdmin('messageUser', compact('messages'), 'adminT');
    }
    public function deleteMessage($id)
    {
        $db = Db::getInstance();
        $messageModel = new MessageModel($db);
        $messageModel->deleteMessage($id);
        if (isset($_POST['submit'])) {
            echo "<div id='successMessageF' class='taskDone'>Message supprimée avec succès</div>";
        }
        $this->index();
        return;
    }
}
