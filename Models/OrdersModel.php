<?php

namespace App\Models;

use PDOException;
use PDO;
use App\Core\Db;

class OrdersModel extends Model
{
    // LIST OF ALL THE ITEM OF THIS TABLE 
    protected $id;
    protected $user_id;
    protected $name;
    protected $quantity;
    protected $price;
    protected $created_at;
    protected $db;
    public function __construct(\PDO $db)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        $this->table = 'orders';
        $this->db = $db;
    }


    /**
     * fetch all the order of this table
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->db->query('SELECT * FROM ' . $this->table);
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * create a new order in the database
     *
     * @param string  $name
     * @param integer $quantity
     * @param integer $price
     * @param [type]  $created_at
     * @param integer $user_id
     * @param string  $order_id
     * @return void
     */
    public function createCartOrder(string $name, int $quantity, int $price, $created_at, int $user_id, string $order_id): void
    {
        $sql = "INSERT INTO orders (id, name, quantity, price, created_at, user_id) VALUES (:id, :name, :quantity, :price, :created_at, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $order_id,
            ':name' => $name,
            ':quantity' => $quantity,
            ':price' => $price,
            ':created_at' => $created_at,
            ':user_id' => $user_id
        ]);
    }

    /**
     * delete an order in the table 
     *
     * @param string $id
     * @return void
     */
    public function deleteOrder(string $id)
    {
        try {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $query->execute(['id' => $id]);
        } catch (PDOException $e) {
            // Log or display the error message
            echo "Error deleting order: " . $e->getMessage();
        }
    }

    /**
     * Get userOrders in the table 
     *
     * @param integer $userId
     * @return array
     */
    public function getUserOrders(int $userId): array
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $orders;
    }

    /**
     * Create a uniq Id 
     *
     * @return string
     */
    public function createUniqueId(): string
    {
        $randomBytes = random_bytes(5);
        $randomHex = bin2hex($randomBytes);
        $uniqueId = uniqid();
        $orderId = $randomHex . $uniqueId;
        return $orderId;
    }

    public function getAllOrdersWithUsers()
    {
        $query = "SELECT orders.id AS order_id, users.id AS user_id, orders.*, users.*
                    FROM orders
                    JOIN users ON orders.user_id = users.id";

        $statement = $this->db->query($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
