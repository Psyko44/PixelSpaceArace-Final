<?php

namespace App\Controllers;

use App\Models\ConsolesModel;
use App\Models\GameModel;


class RetroSpaceController extends Controller
{
    /**
     * Cette methode affichera toutes les liste de mes article 
     *
     * @return void
     */
    public function index()
    {
        $consolesModel = new ConsolesModel;
        $videoModel = new GameModel;
        $Consoles = $consolesModel->findAll();
        $Games = $videoModel->findAll();
        $this->render('retrospace/index', compact('Consoles', 'Games'), 'default');
    }
}
