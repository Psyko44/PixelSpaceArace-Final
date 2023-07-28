<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\GameModel;
use App\Models\OrdersModel;
use App\Core\Db;

class CartController extends Controller
{
    /**
     * MAKE THE RENDER FOR THE PAGE WITH ALL THE DATA
     *
     * @return void
     */
    public function index()
    {
        // CHECK IF USER IS LOGGED IN
        if (!isset($_SESSION["user"])) {
            header("Location: /login/index");
            exit();
        }
        if (isset($_POST['submit'])) {
            $this->handleOrderForm();
        } else {
            $cartItems = $this->getCartItems();
            $this->title = "Panier";
            $this->render('cart/index', compact('cartItems'), 'default');
        }
    }

    /**
     * ADD ITEM IN THE CART
     *
     * @param array $product
     * @return void
     */
    public function add(array $product)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product id is set
        if (!isset($product['id'])) {
            die('Product does not have an id');
        }

        // CHECK IF THE PRODUCT ALREADY EXISTS IN THE CART
        foreach ($_SESSION['cart'] as &$cartProduct) {
            if ($cartProduct['id'] == $product['id']) {
                $cartProduct['quantity']++;
                return;
            }
        }
        $product['quantity'] = 1;
        $_SESSION['cart'][] = $product;
    }

    public function getCartItems()
    {
        return $_SESSION['cart'] ?? [];
    }
    public function remove(int $productId)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $product) {
                if ($product['id'] === $productId) {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
        $this->index();
    }

    public function handleOrderForm()
    {
        $userId = $_SESSION['user']['id'];
        $created_at = date("Y-m-d H:i:s");

        $dbConnection = Db::getInstance();

        $orderModel = new OrdersModel($dbConnection);
        $orderId = $orderModel->createOrder($userId, $created_at);

        $cartItems = $this->getCartItems();

        foreach ($cartItems as $product) {
            $productId = $product['id'];
            $quantity = $product['quantity'];
            $price = $product['price'];

            // ADD THE UNIQUE ORDER ID TO EACH ITEM IN THE ORDER
            $orderModel->addProductToOrder($orderId, $productId, $quantity, $price);
        }

        $_SESSION['cart'] = [];
        echo "<div id='successMessageF' class='taskDone'>Commande passée avec succès</div>";
        $this->render('cart/index');
    }
}
