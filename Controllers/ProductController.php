<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Controllers\CartController;
use App\Core\Db;


class ProductController extends Controller
{
    public function product(int $id)
    {
        $productModel = new ProductsModel;
        $Consoles = $productModel->findConsoleById($id);
        $this->title = "Consoles";
        $this->render('retrospace/product/index', compact('Consoles'), 'default');
        exit;
    }

    /**
     * ADD ITEM TO THE CART
     *
     * @param integer $id
     * @return void
     */
    public function addToCartById(int $productId)
    {
        $db = Db::getInstance();
        $productModel = new ProductsModel($db);
        $product = $productModel->findById($productId);

        if ($product === null) {
            // Handle the error. The product does not exist.
            return;
        }

        // Convert the product object to an array
        $product = get_object_vars($product);

        $cartController = new CartController();
        $cartController->add($product);
    }
}
