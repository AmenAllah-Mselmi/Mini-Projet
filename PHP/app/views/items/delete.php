<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #d9534f;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <h1>Supprimer un Item</h1>
    <form action="/public/index.php?controller=item&action=delete" method="POST">
        <label for="item_id">ID de l'Item :</label>
        <input type="number" name="item_id" id="item_id" placeholder="Entrez l'ID de l'item" required>

        <button type="submit">Supprimer l'Item</button>
        <div class="footer">
        <p>Retour à la <a href="/Products.php">Liste des Produits</a></p>
        </div>
    </form>
    
</body>
</html>
