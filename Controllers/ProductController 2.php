<?php

namespace App\Controllers;

use App\Models\ConsolesModel;
use App\Models\GameModel;
use App\Controllers\CartController;


class ProductController extends Controller
{
    public function product(int $id)
    {
        $productModel = new ConsolesModel;
        $Consoles = $productModel->find($id);
        $this->render('retrospace/product/index', compact('Consoles'), 'default');
        exit;
    }
    public function addToCartConsole(int $id)
    {
        $productModel = new ConsolesModel;
        $product = $productModel->find($id);
        if ($product !== null) {
            $product = (array) $product;
            $cart = new CartController();
            $cart->add($product);
        } else {
        }
    }
}