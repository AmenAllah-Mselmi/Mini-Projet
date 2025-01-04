<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/Products.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #5bc0de;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin: 10px 0 5px;
            color: #555;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
            width: 100%;
            background-color: #fafafa;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Enlever les flèches des champs number */
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #5bc0de;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #47a3c7;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer a {
            color: #5bc0de;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Ajouter un Produit</h1>
        <form action="traiter_ajout_produit.php" method="POST" enctype="multipart/form-data">
            <!-- Nom du produit -->
            <label for="name">Nom du Produit :</label>
            <input type="text" name="name" id="name" placeholder="Exemple : Shampoing Voiture" required>

            <!-- Description -->
            <label for="description">Description :</label>
            <textarea name="description" id="description" rows="4" placeholder="Description du produit..." required></textarea>

            <!-- Prix -->
            <label for="price">Prix (en TND) :</label>
            <input type="number" name="price" id="price" step="0.01" placeholder="Exemple : 15.99" required>

            <!-- Quantité -->
            <label for="quantity">Quantité Disponible :</label>
            <input type="number" name="quantity" id="quantity" placeholder="Exemple : 50" required>

            <!-- Catégorie -->
            <label for="category">Catégorie :</label>
            <select name="category" id="category" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="Shampoing Voiture">Shampoing Voiture</option>
                <option value="Nettoyant Pneus">Nettoyant Pneus</option>
                <option value="Polish et Cire">Polish et Cire</option>
                <option value="Nettoyant Moteur">Nettoyant Moteur</option>
                <option value="Dissolvant Rayures">Dissolvant Rayures</option>
                <option value="Nettoyant Intérieur">Nettoyant Intérieur</option>
                <option value="Liquide de Frein">Liquide de Frein</option>
                <option value="Nettoyant Pare-Brise">Nettoyant Pare-Brise</option>
            </select>

            <!-- Bouton d'ajout -->
            <button type="submit">Ajouter le Produit</button>
        </form>
        <div class="footer">
        <p>Retour à la <a href="/public/index.php">Liste des Produits</a></p>
        </div>
    </div>

    

</body>
</html>
