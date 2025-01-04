<?php
// Inclure les fichiers nécessaires
require_once '../app/models/Item.php';
require_once '../app/controllers/ItemController.php';

// Récupérer les paramètres de l'URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'item';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Créer une instance du contrôleur approprié
if ($controller == 'item') {
    $controllerObj = new ItemController();
    if ($action == 'add') {
        $controllerObj->add();
    } elseif ($action == 'delete') {
        $controllerObj->delete();
    } else {
        $controllerObj->list();
    }
}

?>
 
