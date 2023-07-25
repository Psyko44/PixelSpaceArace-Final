<?php

namespace App\Models;

use PDO;
use App\Core\Db;

class MessageModel extends Model
{
    // LIST OF ALL THE ITEM OF THIS TABLE 
    protected $id;
    protected $name;
    protected $email;
    protected $message;
    protected $created_at;
    protected $db;
    public function __construct(\PDO $db)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        $this->table = 'Message';
        $this->db = $db;
    }

    /**
     * Create a new message in the form
     *
     * @param string $name
     * @param string $email
     * @param string $message
     * @param [type] $created_at
     * @return boolean
     */
    public function createContactMessage(string $name, string $email, string $message, $created_at): bool
    {
        $sql = "INSERT INTO Message (name, email, message, created_at) VALUES (:name, :email, :message, :created_at)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message,
            ':created_at' => $created_at,
        ]);
    }
    /**
     * Find all the message in the database 
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->db->query('SELECT * FROM ' . $this->table);
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Delete the message from the database
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteMessage(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}
