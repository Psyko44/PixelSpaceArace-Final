<?php

namespace App\Controllers;

use App\Models\ConsolesModel;
use App\Models\GameModel;
use App\Models\ProductsModel;
use App\Core\Db;

class AdminProductController extends Controller
{
    /**
     * RETURN ALL THE PRODUCTS OF GAME AND CONSOLE MODEL
     *
     * @return void
     */
    public function index()
    { //AND IF THE USER IS NOT CONECTED THEN ERROR 
        if (!isset($_SESSION["user"])) {

            $this->renderError('error');
            return;
        } // IF THE USER HAVE ROLE ID 2 
        if ($_SESSION['user']['role_id'] == 2) {

            $this->renderError('error');
            return;
        }
        $consolesModel = new ProductsModel();
        $gameModel = new ProductsModel();
        $consoles = $consolesModel->findConsole();
        $games = $gameModel->findGame();
        $this->renderAdmin('adminProduct', compact('consoles', 'games'), 'adminT');
    }
    /**
     * CREATE A NEW CONSOLE IN THE DATA BASE
     *
     * @return void
     */
    public function createConsole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $consoleModel = new ProductsModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $etat = $_POST['etat'];
            $pegi = $_POST['pegi'];
            $consoleModel->setName($name);
            $consoleModel->setDescription($description);
            $consoleModel->setPrice($price);
            $consoleModel->setEtat($etat);
            if (isset($_POST['submit'])) {
                $_SESSION['success_message'] = 'La console a crée supprimée avec succès';
                $consoleModel->createConsole($consoleModel);
            }
        }
        $this->index();
        return;
    }
    /**
     * UPDATE THE CONSOLE IN THE DATA BASE
     *
     * @param [type] $id
     * @return void
     */
    public function updateConsole($id)
    {
        $consolesModel = new ProductsModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $consolesModel->setId($id);
            $consolesModel->setName($name);
            $consolesModel->setDescription($description);
            $consolesModel->setPrice($price);
            $consolesModel->updateConsole($id, $consolesModel);
        }
        if (isset($_POST['submit'])) {
            $_SESSION['success_message'] = 'La console a été modifiée avec succès';
        }
        $console = $consolesModel->find($id);
        $this->index();
        return;
    }
    /**
     * DELETE CONSOLE IN THE DATA BASE
     *
     * @param [type] $id
     * @return void
     */
    public function deleteConsole($id)
    {
        $consolesModel = new ProductsModel();
        $consolesModel->deleteProduct($id);
        if (isset($_POST['submit'])) {
            $_SESSION['success_message'] = 'La console a été supprimée avec succès';
        }
        $this->index();
        return;
    }
    /**
     * CREATE A NEW GAME IN THE DATA BASE
     *
     * @return void
     */
    public function createGame()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $gameModel = new ProductsModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $etat = $_POST['etat'];
            $pegi = $_POST['pegi'];
            $gameModel->setName($name);
            $gameModel->setDescription($description);
            $gameModel->setPrice($price);
            $gameModel->setEtat($etat);
            $gameModel->setPegi($pegi);
            var_dump($_POST);
            if (isset($_POST['submit'])) {
                $_SESSION['success_message'] = 'La console a crée supprimée avec succès';
                $gameModel->createGame($gameModel);
            }
        }
        $this->index();
        return;
    }
    /**
     * UPDATE THE GAME IN THE DATA BASE
     *
     * @param [type] $id
     * @return void
     */
    public function updateGame($id)
    {
        $gameModel = new ProductsModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $gameModel->setId($id);
            $gameModel->setName($name);
            $gameModel->setDescription($description);
            $gameModel->setPrice($price);
            $gameModel->updateGame($id, $gameModel);
            if (isset($_POST['submit'])) {
                $_SESSION['success_message'] = 'Le jeux a été modifié avec succès';
            }
        }
        $game = $gameModel->find($id);
        $this->index();
        return;
    }
    /**
     * DELETE THE GAME IN THE DATA BASE
     *
     * @param [type] $id
     * @return void
     */
    public function deleteGame($id)
    {
        $gameModel = new ProductsModel();
        $gameModel->deleteProduct($id);
        if (isset($_POST['submit'])) {
            $_SESSION['success_message'] = 'Le Jeux à été supprimé avec succès';
        }
        $this->index();
        exit();
    }
    public function uploadPicture()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $target_dir = "uploads/";
            $file_name = uniqid() . "." . pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
            $target_file = $target_dir . $file_name;
            $uploadOk = 1;
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "Le fichier est une image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "Le fichier n'est pas une image.";
                    $uploadOk = 0;
                }
                if (file_exists($target_file)) {
                    echo "Le fichier existe déjà.";
                    $uploadOk = 0;
                }
                if ($_FILES["fileUpload"]["size"] > 500000) {
                    echo "Désolé, fichier trop volumineux.";
                    $uploadOk = 0;
                }
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Désolé, seuls les formats JPG, JPEG, PNG et GIF sont autorisés.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "Désolé, votre fichier n'a pas été téléchargé.";
                } else {
                    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                        return $file_name;
                    } else {
                        echo "Désolé, une erreur est survenue pendant le téléchargement.";
                    }
                }
            }
        }
    }
}
