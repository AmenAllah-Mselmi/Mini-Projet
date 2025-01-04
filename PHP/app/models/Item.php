<?php

class Item {
    private $db;

    public function __construct() {
        // Connexion à la base de données (ajuster les informations de connexion)
        $this->db = new mysqli('localhost', 'root', '', 'lavage1');
    }

    // Ajouter un item
    public function addItem($name, $description, $price, $quantity, $category) {
        $stmt = $this->db->prepare("INSERT INTO produits (name, description, price, quantity, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssdiss', $name, $description, $price, $quantity, $category);  // 's' pour string, 'd' pour double, 'i' pour int
        $stmt->execute();
        $stmt->close();
    }

    // Supprimer un item
    public function deleteItem($item_id) {
        $stmt = $this->db->prepare("DELETE FROM produits WHERE id = ?");
        $stmt->bind_param('i', $item_id);
        $stmt->execute();
        $stmt->close();
    }

    // Obtenir tous les items
    public function getAllItems() {
        $result = $this->db->query("SELECT * FROM produits");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>
