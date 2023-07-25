<?php

namespace App\Core;

use App\Controllers\MainController;

/**
 * MAIN ROUTEUR
 */
class Main
{
    public function start()
    {
        session_start();
        $uri = $_SERVER['REQUEST_URI'];
        // VERIFY IF URI IS EMPTY AND REMOVE THE SLASH
        if (!empty($uri) && $uri != "/" && $uri[-1] === '/') {
            // REMOVE THE SLASH
            $uri = substr($uri, 0, -1);
            echo "$uri";
            http_response_code(301);
            // GO TO URL WITHOUT THE SLASH 
            header('Location: ' . $uri);
        }
        $params = explode('/', $_GET['p']);
        if ($params[0] != '') {
            //WE GOT ONE PARAMETER 
            //WE TAK ETH ENAME OF THE PARAMETER 
            // WE PUT THE FIRST LETTER IN UPPERCASE
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';
            // WE MAKING THE CONTROLLER
            $controller = new $controller();
            $action = (isset($params[0])) ? array_shift($params) : 'index';
            if (method_exists($controller, $action)) {
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            } else {
                http_response_code(404);
                echo "la page n'existe pas ";
            }
        } else {
            //IF WE HAVENT GOT PARAMETERS 
            //WE TAKING TO THE THE MAIN CONTROLLER 
            $controller = new MainController;
            // WE NAME THE METHODE INDEX 
            $controller->index();
        }
        function generateTitle($controller, $action)
        {
            // PUT THE FIRST LETTER OF ALL WORD IN UPPERCASE
            $controller = ucwords($controller);
            $action = ucwords($action);
            return $controller . ' - ' . $action;
        }
    }
}
