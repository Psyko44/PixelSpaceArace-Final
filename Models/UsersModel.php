<?php

namespace App\Models;

use PDOException;
use PDO;

class UsersModel extends Model
{
    // LIST OF ALL THE ITEM OF THIS TABLE 
    protected $id;
    protected $email;
    protected $pass;
    protected $username;
    protected $phone;
    protected $role_id;
    protected $db;
    public function __construct(\PDO $db)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        $this->table = 'users';
        $this->db = $db;
    }

    /**
     * create a new data in the data base
     *
     * @return void
     */
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];
        // LOOP TO EXPLODE THE ARRAY
        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ !== 'db' && $champ !== 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        // TRANSFORM THE "FIELDS" ARRAY INTO A STRING
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);
        // EXECUTE THE QUERY
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ') VALUES (' . $liste_inter . ')', $valeurs);
    }

    /**
     * update a data from the database
     *
     * @param integer $id
     * @return void
     */
    public function update(int $id)
    {
        $champs = [];
        $valeurs = [];
        // LOOP TO EXPLODE THE ARRAY
        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ !== 'db' && $champ !== 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        // TRANSFORM THE "FIELDS" ARRAY INTO A STRING
        $liste_champs = implode(', ', $champs);
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }

    /**
     * delete a data from the database
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }



    /**
     * Get user by Email from the database
     * return $result
     */

    public function getUserByEmail($email)
    {
        $query = $this->requete(
            "SELECT * FROM {$this->table} WHERE `email` = ?",
            [$email]
        );
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->setId($result['id'])
                ->setEmail($result['email'])
                ->setPassword($result['pass'])
                ->setUsername($result['username'])
                ->setRoleId($result['role_id'])
                ->setPhone($result['phone']);
        }
        return $result ? $this : null;
    }

    /**
     * Assign a new role to the user in the table users join role_users
     *
     * @param [type] $user_id
     * @param [type] $role_id
     * @return void
     */
    public function assignRole($user_id, $role_id)
    {
        $this->requete('UPDATE users SET role_id = ? WHERE id = ?', [$role_id, $user_id]);
    }

    /**
     * Get the role id of a user from the table users
     *
     * @return void
     */
    public function getRoleId()
    {
        return $this->role_id;
    }
    public function setRoleId($roleId)
    {
        $this->role_id = $roleId;
        return $this;
    }

    /**
     * Create a new user from this table 
     *
     * @param [type] $data
     * @return void
     */
    public function createUser($data)
    {
        $defaultRoleId = 2;
        $sql = "INSERT INTO users (username, pass, email, phone, role_id) VALUES (:username, :pass, :email, :phone, :role_id)";
        $this->db->beginTransaction();
        $stmt = $this->db->prepare($sql);
        if (!isset($data['role_id'])) {
            $data['role_id'] = $defaultRoleId;
        }
        $stmt->execute([
            ':username' => $data['username'],
            ':pass' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':role_id' => $data['role_id'],
        ]);
        $id = $this->db->lastInsertId();
        $this->db->commit();
        return $id;
    }

    /**
     * Update  role user from database
     *
     * @param integer $userId
     * @param integer $roleId
     * @return void
     */
    public function updateUserRole(int $userId, int $roleId)
    {
        $query = $this->db->prepare("UPDATE {$this->table} SET role_id = :role_id WHERE id = :id");
        $query->execute([
            'role_id' => $roleId,
            'id' => $userId
        ]);
    }

    /**
     * find user in the table 
     *
     * @param [type] $userId
     * @return void
     */
    public function findUser($userId)
    {
        $statement = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $statement->execute(['id' => $userId]);
        return $statement->fetchObject('UsersModel');
    }

    /**
     * Get all the user of this table
     *
     * @return void
     */
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $users = array();
        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $user = new UsersModel($this->db);
            $user->setId($data['id'])
                ->setEmail($data['email'])
                ->setUsername($data['username'])
                ->setRoleId($data['role_id']) // Assuming role_id is passed as an integer
                ->setPhone($data['phone']);
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Get user by Id in this table
     *
     * @param integer $id
     * @return void
     */
    public function getUserById(int $id)
    {
        // PREPARE THE SQL QUERY TO GET USER DATA BY THEIR ID
        $query = "SELECT * FROM users WHERE id = :id";
        $params = ['id' => $id];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * Update User from the database
     *
     * @param [type] $id
     * @param [type] $userData
     * @return void
     */
    public function updateUser($id, $userData)
    {
        $query = "UPDATE users SET username = :username, pass = :pass, email = :email, phone = :phone WHERE id = :id";
        $params = [
            'username' => $userData['username'],
            'pass' => $userData['pass'],
            'email' => $userData['email'],
            'phone' => $userData['phone'],
            'id' => $id
        ];
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            echo 'Utilisateur mis à jour avec succès.';
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo "Une erreur est survenue lors de la mise à jour de l'utilisateur. Veuillez réessayer.";
            return false;
        }
    }






    public function setPassword($password)
    {
        $this->pass = $password;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    /**
     * Get the value of pass
     */
    public function getPass()
    {
        return $this->pass;
    }
    /**
     * Set the value of pass
     *
     * @return  self
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }
}
