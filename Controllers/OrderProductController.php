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
        } else {
            $db = Db::getInstance();
            $orderModel = new OrdersModel($db);
            $orders = $orderModel->getAllOrders();
            $this->renderAdmin('orderProduct', compact('orders'), 'adminT');
        }
    }

    /**
     * DELETE ORDERS FROM THE DATABASE
     *
     * @param [type] $id
     * @return void
     */
    public function deleteOrder($orderId)
    {
        $db = Db::getInstance();
        $orderModel = new OrdersModel($db);
        $orderModel->deleteOrder($orderId);
        if (isset($_POST['submit'])) {
            echo "<div id='successMessageF' class='taskDone'>Commande supprimée avec succès</div>";
        }
        $this->index();
        return;
    }
}
