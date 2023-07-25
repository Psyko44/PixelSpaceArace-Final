<?php

namespace App\Controllers;

use App\Models\ConsolesModel;
use App\Models\GameModel;
use App\Core\Db;
use App\Models\OrdersModel;



class OrderProductController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION["user"]) || $_SESSION['user']['role_id'] == 2) {
            $this->renderError('error');
        }

        $db = Db::getInstance();
        $orderModel = new OrdersModel($db);
        $orders = $orderModel->findAll();
        $this->renderAdmin('orderProduct', compact('orders'), 'adminT');
    }




    public function deleteOrder($id)
    {
        $db = Db::getInstance();
        $orderModel = new OrdersModel($db);
        $orderModel->deleteOrder($id);
        if (isset($_POST['submit'])) {
            echo "<div id='successMessageF' class='taskDone'>Commande supprimée avec succès</div>";
        }
        $this->index();
        return;
    }
}
