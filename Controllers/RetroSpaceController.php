<?php

namespace App\Controllers;

use App\Models\ProductsModel;


class RetroSpaceController extends Controller
{
    /**
     * Cette methode affichera toutes les liste de mes article 
     *
     * @return void
     */
    public function index()
    {
        $productsModel = new ProductsModel;
        $Consoles = $productsModel->findConsole();
        $Games = $productsModel->findGame();
        $this->title = "Retrospace";
        $this->render('retrospace/index', compact('Consoles', 'Games'), 'default');
    }
}
