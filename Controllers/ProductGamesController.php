<?php

namespace App\Controllers;

use App\Models\ConsolesModel;
use App\Models\GameModel;
use App\Controllers\CartController;

class ProductGamesController extends Controller
{
    public function productGames(int $id)
    {
        $productGame = new GameModel;
        $Games = $productGame->find($id);
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
    public function addToCartGame(int $id)
    {
        $productModel = new GameModel;
        $product = $productModel->find($id);
        if ($product !== null) {
            $product = (array) $product;
            $cart = new CartController();
            $cart->add($product);
        } else {
            http_response_code(404);
            exit;
        }
    }
}
