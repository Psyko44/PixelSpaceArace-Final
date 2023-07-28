<?php

namespace App\Models;

use PDOException;
use PDO;
use App\Core\Db;

class OrdersModel extends Model
{
    // LIST OF ALL THE ITEM OF THIS TABLE 
    protected $id;
    protected $products_id;
    protected $orders_id;
    protected $quantity;
    protected $price;
    protected $db;
    public function __construct(\PDO $db)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        $this->table = 'product_order';
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


    public function createOrder(
        int $user_id,
        $created_at
    ): int {
        $sql = "INSERT INTO orders (user_id, created_at) VALUES (:user_id, :created_at)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':created_at' => $created_at
        ]);

        // Récupérer l'ID de la commande qui vient d'être créée
        $order_id = $this->db->lastInsertId();

        return $order_id;
    }

    public function addProductToOrder(int $order_id, int $product_id, int $quantity, float $price): void
    {
        $sql = "INSERT INTO product_order (orders_id, products_id, quantity, price) VALUES (:orders_id, :products_id, :quantity, :price)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':orders_id' => $order_id,
            ':products_id' => $product_id,
            ':quantity' => $quantity,
            ':price' => $price
        ]);
    }


    public function deleteOrder(string $orderId)
    {
        try {
            // First delete the order_product entries
            $query = $this->db->prepare("DELETE FROM product_order WHERE orders_id = :orders_id");
            $query->execute(['orders_id' => $orderId]);

            // Then delete the order
            $query = $this->db->prepare("DELETE FROM orders WHERE id = :id");
            $query->execute(['id' => $orderId]);
        } catch (PDOException $e) {
            // Log or display the error message
            echo "Error deleting order: " . $e->getMessage();
        }
    }


    public function getUserOrders(int $userId): array
    {
        $query = "
    SELECT orders.*, products.*, product_order.quantity as order_quantity, orders.created_at as created_at
    FROM orders
    JOIN product_order ON orders.id = product_order.orders_id
    JOIN products ON product_order.products_id = products.id
    WHERE orders.user_id = :user_id
";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $orders;
    }

    public function getAllOrders()
    {
        $stmt = $this->db->prepare("
        SELECT orders.id as order_id, users.id as user_id, users.username as user_name, Products.name as product_name, product_order.quantity, product_order.price, orders.created_at
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        INNER JOIN product_order ON orders.id = product_order.orders_id
        INNER JOIN Products ON product_order.products_id = Products.id
    ");

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
