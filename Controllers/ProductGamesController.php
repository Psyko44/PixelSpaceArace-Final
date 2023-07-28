<?php

namespace App\Controllers;


use App\Models\ProductsModel;
use App\Controllers\CartController;
use App\Core\Db;

class ProductGamesController extends Controller
{
    public function productGames(int $id)
    {
        $productGame = new ProductsModel();
        $Games = $productGame->findGameById($id);
        if (!$Games) {
            http_response_code(404);
            exit;
        }
        $this->title = "Jeux video";
        $this->render('retrospace/productGames/index', compact('Games'), 'default');
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
        $product = get_object_vars($product);

        $cartController = new CartController();
        $cartController->add($product);
    }
}
