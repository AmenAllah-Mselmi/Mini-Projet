<!-- afficher_panier.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
</head>
<body>
    <h1>Mon Panier</h1>

    <?php
    // Inclure le fichier panier.php pour utiliser les fonctions
    require_once 'panier.php';

    // Récupérer le panier
    $panier = getPanier();

    if (empty($panier)) {
        echo "<p>Votre panier est vide.</p>";
    } else {
        echo "<table border='1'>
            <tr>
                <th>ID Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Prix Total</th>
                <th>Action</th>
            </tr>";

        foreach ($panier as $produit_id => $produit) {
            $totalProduit = $produit['quantite'] * $produit['prix'];
            echo "<tr>
                    <td>{$produit_id}</td>
                    <td>{$produit['quantite']}</td>
                    <td>{$produit['prix']} €</td>
                    <td>{$totalProduit} €</td>
                    <td><a href='panier.php?action=supprimer&produit_id={$produit_id}'>Supprimer</a></td>
                </tr>";
        }

        echo "</table>";
        echo "<h3>Total du panier : " . calculerTotal() . " €</h3>";
    }
    ?>

</body>
</html>
