<?php

class ItemController {
    private $itemModel;

    public function __construct() {
        // Initialiser le modèle
        $this->itemModel = new Item();
    }

    // Ajouter un item
    public function add() {
        // Vérifier si tous les champs nécessaires sont définis dans le formulaire
        if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['category'])) {
            // Récupérer les valeurs des champs
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];

            // Appeler la méthode du modèle pour ajouter l'item
            $this->itemModel->addItem($name, $description, $price, $quantity, $category);
            
            // Redirection après l'ajout
            header('Location: index.php?controller=item&action=list');
        }
    }

    // Supprimer un item
    public function delete() {
        // Vérifier si l'ID de l'item est défini dans le formulaire
        if (isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];
            
            // Appeler la méthode du modèle pour supprimer l'item
            $this->itemModel->deleteItem($item_id);
            
            // Redirection après la suppression
            header('Location: index.php?controller=item&action=list');
        }
    }

    // Liste des items
    public function list() {
        // Obtenir tous les items du modèle
        $items = $this->itemModel->getAllItems();
        
        // Charger la vue pour afficher les items
        // Passer les items à la vue
        include(__DIR__ . '/../views/items/item_list.php');
    }
}
?>
