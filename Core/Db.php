<?php

namespace App\Core;
// IMPORT PDO
use PDO;
use PDOException;

class Db extends PDO
{
    // UNIQ CLASS
    private static $instance;
    // CONEXION INFO
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME = 'SpacePixelArcade';

    /**
     * CONSTRUC THE CONEXION TO THE DATBASE WITH PDO
     */
    private function __construct()
    {
        // DSN CONNEXION
        $_dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;
        // CONSTRUC OF PDO
        try {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * GET AN INSTANCE OF PDOStatement
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
