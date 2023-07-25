<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Core\Db;

class MessageUserController extends Controller
{

    /**
     * MAKE THE RENDER WITH ALL DATA
     *
     * @return void
     */
    public function index()
    {  // IF THE USER HAVE ROLE ID 2 AND IF THE USER IS NOT CONECTED THEN ERROR 
        if (!isset($_SESSION["user"]) || $_SESSION['user']['role_id'] == 2) {
            $this->renderError('error');
        } else {
            $db = Db::getInstance();
            $messageModel = new MessageModel($db);
            $messages = $messageModel->findAll();
            $this->renderAdmin('messageUser', compact('messages'), 'adminT');
        }
    }
    /**
     * DELETE MESSAGE FROM THE DATABASE
     *
     * @param [type] $id
     * @return void
     */
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
