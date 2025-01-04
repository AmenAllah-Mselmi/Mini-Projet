<?php
// panier.php

// Fonction pour récupérer le panier depuis le cookie
function getPanier() {
    if (isset($_COOKIE['panier'])) {
        return json_decode($_COOKIE['panier'], true);
    }
    return [];
}

// Fonction pour ajouter un produit au panier
function ajouterAuPanier($produit_id, $quantite, $prix) {
    // Récupérer le panier actuel
    $panier = getPanier();

    // Vérifier si le produit existe déjà dans le panier
    if (isset($panier[$produit_id])) {
        // Si le produit existe, ajouter la quantité
        $panier[$produit_id]['quantite'] += $quantite;
    } else {
        // Sinon, ajouter le produit avec sa quantité et son prix
        $panier[$produit_id] = [
            'quantite' => $quantite,
            'prix' => $prix
        ];
    }

    // Sauvegarder le panier dans un cookie
    setcookie('panier', json_encode($panier), time() + 3600, '/');
}

// Fonction pour supprimer un produit du panier
function supprimerDuPanier($produit_id) {
    $panier = getPanier();

    // Supprimer le produit du panier
    if (isset($panier[$produit_id])) {
        unset($panier[$produit_id]);
    }

    // Sauvegarder le panier mis à jour dans un cookie
    setcookie('panier', json_encode($panier), time() + 3600, '/');
}

// Fonction pour calculer le total du panier
function calculerTotal() {
    $panier = getPanier();
    $total = 0;

    foreach ($panier as $produit_id => $produit) {
        $total += $produit['quantite'] * $produit['prix'];
    }

    return $total;
}
?>
