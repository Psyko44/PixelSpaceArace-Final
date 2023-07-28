<?php

namespace App\Models;

use App\Core\Db;

/**
 * MODEL FOR CONSOLE TABLE
 */
class ProductsModel extends Model
{
    // LIST OF ALL THE ITEM OF THIS TABLE 
    protected $id;
    protected $name;
    protected $category;
    protected $description;
    protected $created_at;
    protected $pegi;
    protected $etat;
    protected $shipping;
    protected $picture;
    protected $price;
    protected $db;
    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->table = 'Products';
    }

    /**
     * find all the data from this table
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->db->query('SELECT * FROM ' . $this->table);
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findGame(): array
    {
        $query = $this->db->query("SELECT * FROM " . $this->table . " WHERE category = 'Games'");
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findConsole(): array
    {
        $query = $this->db->query("SELECT * FROM " . $this->table . " WHERE category = 'Consoles'");
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findGameById(int $id)
    {
        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id AND category = 'Games'");

        $query->execute(['id' => $id]);
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function findConsoleById(int $id)
    {
        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id AND category = 'Consoles'");

        $query->execute(['id' => $id]);
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function findById(int $id)
    {
        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(\PDO::FETCH_OBJ);
    }




    /**
     * Create a new game in this table
     *
     * @return void
     */
    public function createConsole()
    {
        // IF A FILE HAS BEEN UPLOADED
        if (isset($_FILES['fileUpload']['tmp_name']) && $_FILES['fileUpload']['tmp_name'] != '') {
            $target_dir = "uploads/";
            $file_name = uniqid() . "." . pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
            $target_file = $target_dir . $file_name;
            // REPLACE THE FILE IN THE UPLOADED DIRECTORY
            if (!move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                echo "Désolé une erreur est survenue pendant le téléchargement de l'image.";
                return;
            }
            // SAVE THE LINK IN DATA PICTURE
            $this->picture = $file_name;
        }
        try {
            $query = $this->db->prepare("INSERT INTO `Products` ( `name`, `category`, `pegi`, `etat`, `shipping`, `picture`, `price`, `description`, `created_at`) VALUES (:name, :category, NULL, :etat, :shipping, :picture, :price, :description, NOW())");
            $query->execute([
                'name' => $this->name,
                'category' => 'Consoles', // Ou la valeur que vous voulez utiliser pour la catégorie
                'etat' => 'valeur_par_defaut',
                'shipping' => 12.99,
                'picture' => $this->picture,
                'price' => $this->price,
                'description' => $this->description
            ]);
        } catch (\PDOException $e) {
            // CATCH PDO EXCEPTION
            echo "Error: " . $e->getMessage();
        }
    }

    public function createGame()
    {
        // IF A FILE HAS BEEN UPLOADED
        if (isset($_FILES['fileUpload']['tmp_name']) && $_FILES['fileUpload']['tmp_name'] != '') {
            $target_dir = "uploads/";
            $file_name = uniqid() . "." . pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
            $target_file = $target_dir . $file_name;
            // REPLACE THE FILE IN THE UPLOADED DIRECTORY
            if (!move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                echo "Désolé une erreur est survenue pendant le téléchargement de l'image.";
                return;
            }
            // SAVE THE LINK IN DATA PICTURE
            $this->picture = $file_name;
        }
        try {
            $query = $this->db->prepare("INSERT INTO " . $this->table . " (category, name, pegi, description, price, etat, shipping, picture) 
                                     VALUES ('Games', :name, :pegi, :description, :price, :etat, :shipping, :picture)");
            $query->execute([
                'name' => $this->name,
                'pegi' => $this->pegi,
                'description' => $this->description,
                'price' => $this->price,
                'etat' => 'valeur_par_defaut',
                'shipping' => 12.99,
                'picture' => $this->picture
            ]);
        } catch (\PDOException $e) {
            // CATCH PDO EXCEPTION
            echo "Error: " . $e->getMessage();
        }
    }


    /**
     * Update a game from this table
     *
     * @param integer $id
     * @return void
     */
    public function updateGame(int $id)
    {
        $query = $this->db->prepare("UPDATE {$this->table} SET name = :name, description = :description, price = :price WHERE category = 'Games' AND id = :id");
        $query->execute([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'id' => $id
        ]);
    }

    public function updateConsole(int $id)
    {
        $query = $this->db->prepare("UPDATE {$this->table} SET name = :name, description = :description, price = :price WHERE category = 'Consoles' AND id = :id");
        $query->execute([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'id' => $id
        ]);
    }

    /**
     * Delete a game from this table 
     *
     * @param integer $id
     * @return void
     */
    public function deleteProduct(int $id)
    {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * GET THE VALUE OF ID
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * SET THE VALUE OF ID
     *
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    /**
     * GET THE VALUE OF DESCRIPTION
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * SET THE VALUE OF DESCRIPTION
     *
     * @return  self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * GET THE VALUE OF CREATED_AT
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    /**
     * SET THE VALUE OF CREATED_AT
     *
     * @return  self
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
    /**
     * GET THE VALUE OF NAME
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * SET THE VALUE OF NAME
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * GET THE VALUE OF ETAT
     */
    public function getEtat()
    {
        return $this->etat;
    }
    /**
     * SET THE VALUE OF ETAT
     *
     * @return  self
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }
    /**
     * GET THE VALUE OF PEGI
     */
    public function getPegi()
    {
        return $this->pegi;
    }
    /**
     * SET THE VALUE OF PEGI
     *
     * @return  self
     */
    public function setPegi($pegi)
    {
        $this->pegi = $pegi;
        return $this;
    }
    /**
     * GET THE VALUE OF SHIPPING
     */
    public function getShipping()
    {
        return $this->shipping;
    }
    /**
     * SET THE VALUE OF SHIPPING
     *
     * @return  self
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }
    /**
     * GET THE VALUE OF PICTURE
     */
    public function getPicture()
    {
        return $this->picture;
    }
    /**
     * SET THE VALUE OF PICTURE
     *
     * @return  self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }
    /**
     * GET THE VALUE OF PRICE
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * SET THE VALUE OF PRICE
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }


    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
