<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        }catch (PDOException $e){
            $this->createTable();
        }
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `role_name` VARCHAR(255) NOT NULL,
    `role_description` TEXT
)";
        $userTableQuery ="CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `role` INT(11) NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
)";

        try {
            $this->db->exec($userTableQuery);
            $this->db->exec($roleTableQuery);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }

    public function readAll()
    {
        try{
            $result = $this ->db->query("SELECT * FROM `users`");
            $users = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                $users[] = $row;
            }
            return $users;
        }catch (PDOException $e){
            return false;
        }

    }

    public function create($data)
    {
        $username= $data['username'];

        $email = $data['email'];
        $role = $data['role'];
        $created_at = date('Y-m-d H:i:s');

        $query ="INSERT INTO users (username,email,password,role,created_at) VALUES  (?,?,?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username,$email,$data['password'],$role,$created_at]);
            return  true;
        }catch (PDOException $e){
            return false;
        }
    }
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        }catch (PDOException $e){
            return false;
        }

    }

    public  function read($id){
        $query ="SELECT * FROM users WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            return false;
        }
    }

    public function update($id,$data)
    {
        $username = $data['username'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $email = $data['email'];
        $role = $data['role'];
        $is_active = $data['is_active'];
        $query = "UPDATE  users SET username = ?, is_admin = ?,email = ?,role = ?,is_active = ? WHERE id = ?";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username,$admin,$email,$role,$is_active,$id]);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }
}