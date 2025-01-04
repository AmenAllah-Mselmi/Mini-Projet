<?php
// models/User.php

class User {
    private $id;
    private $name;
    private $email;
    private $password;

    // Connexion à la base de données
    private function dbConnect() {
        return new PDO('mysql:host=localhost;dbname=lavage1', 'root', '');
    }

    // Getter et Setter
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Ajouter un utilisateur
    public function save() {
        $pdo = $this->dbConnect();
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$this->name, $this->email, password_hash($this->password, PASSWORD_DEFAULT)]);
    }

    // Supprimer un utilisateur
    public function delete($id) {
        $pdo = $this->dbConnect();
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$id]);
    }

    // Obtenir un utilisateur par son ID
    public function getById($id) {
        $pdo = $this->dbConnect();
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtenir tous les utilisateurs
    public function getAll() {
        $pdo = $this->dbConnect();
        $query = "SELECT * FROM users";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
 
