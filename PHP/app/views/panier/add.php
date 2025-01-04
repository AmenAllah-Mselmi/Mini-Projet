<!-- ajouter_au_panier.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter au Panier</title>
</head>
<body>
    <h1>Ajouter au Panier</h1>

    <!-- Formulaire pour ajouter un produit au panier -->
    <form action="panier.php?action=ajouter" method="POST">
        <label for="produit_id">ID du produit :</label>
        <input type="text" name="produit_id" id="produit_id" required><br>

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" min="1" required><br>

        <label for="prix">Prix :</label>
        <input type="text" name="prix" id="prix" required><br>

        <button type="submit">Ajouter au Panier</button>
    </form>
</body>
</html>
