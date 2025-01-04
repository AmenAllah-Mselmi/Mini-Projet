<?php
// index.php

// Inclure le contrôleur
require_once '../app/controllers/UserController.php';

// Récupérer le contrôleur et l'action via l'URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action = isset($_GET['action']) ? $_GET['action'] : 'add';

// Créer une instance du contrôleur et appeler l'action
if ($controller == 'user') {
    $userController = new UserController();
    if (method_exists($userController, $action)) {
        $userController->$action();
    } else {
        echo "Action invalide";
    }
}
?>
