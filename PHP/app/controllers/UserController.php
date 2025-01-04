<?php
// UserController.php

require_once __DIR__ . '/../models/User.php';

class UserController {
    // Ajouter un utilisateur
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);

            if ($user->save()) {
                echo "Utilisateur ajouté avec succès !";
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur.";
            }
        }
        include __DIR__ . '/../views/users/add.php';
    }

    // Supprimer un utilisateur
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            $user = new User();
            if ($user->delete($id)) {
                echo "Utilisateur supprimé avec succès !";
            } else {
                echo "Erreur lors de la suppression de l'utilisateur.";
            }
        }
        include __DIR__ . '/../views/users/delete.php';
    }
}
?>
