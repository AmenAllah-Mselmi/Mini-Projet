<?php
// panier.php

// Inclure le fichier panier.php pour utiliser les fonctions
require_once 'panier.php';

// Récupérer l'action via l'URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Ajouter un produit au panier
if ($action == 'ajouter' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $produit_id = $_POST['produit_id'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];

    ajouterAuPanier($produit_id, $quantite, $prix);

    header('Location: afficher_panier.php');
    exit();
}

// Supprimer un produit du panier
if ($action == 'supprimer' && isset($_GET['produit_id'])) {
    $produit_id = $_GET['produit_id'];
    supprimerDuPanier($produit_id);

    header('Location: afficher_panier.php');
    exit();
}
?>
