<?php

namespace App\Models;

use App\Core\Db;
use PDO;
use PDOStatement;

class Model extends Db
{
    // PROPERTY FOR THE DATABASE
    protected $table;
    // DB INSTANCE
    private $db;
    /**
     * SELECT ALL RECORDS FROM A TABLE
     * @return array ARRAY OF FOUND RECORDS
     */
    public function findAll(): array
    {
        $query = $this->requete("SELECT * FROM {$this->table}");
        return $query->fetchAll(PDO::FETCH_CLASS, get_class($this));
    }
    /**
     * SELECT MULTIPLE RECORDS BASED ON AN ARRAY OF CRITERIA
     * @param array $criteres ARRAY OF CRITERIA
     * @return array ARRAY OF FOUND RECORDS
     */
    public function findBy(array $criteres): array
    {
        $champs = [];
        $valeurs = [];
        // LOOP TO "EXPLODE THE ARRAY"
        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        // TRANSFORM THE ARRAY INTO A STRING SEPARATED BY AND
        $liste_champs = implode(' AND ', $champs);
        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }
    /**
     * SELECT A RECORD BASED ON ITS ID
     * @param int $id ID OF THE RECORD
     * @return array ARRAY CONTAINING THE FOUND RECORD
     */
    public function find(int $id): object
    {
        // EXECUTE THE QUERY
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    /**
     * METHOD THAT WILL EXECUTE THE QUERIES
     * @param string $sql SQL QUERY TO EXECUTE
     * @param array $attributes ATTRIBUTES TO ADD TO THE QUERY 
     * @return PDOStatement|false 
     */
    public function requete(string $sql, array $attributs = null): PDOStatement|false
    {
        $this->db = Db::getInstance();
        // CHECK IF WE HAVE ATTRIBUTES
        if ($attributs !== null) {
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            return $this->db->query($sql);
        }
    }
}
