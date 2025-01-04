<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
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
            color: #5bc0de;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        thead {
            background-color: #5bc0de;
            color: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #5cb85c;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #4cae4c;
        }
        a:last-child {
            background-color: #d9534f;
        }
        a:last-child:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <h1>Liste des Produits</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['id']); ?></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['description']); ?></td>
                <td><?php echo htmlspecialchars(number_format($item['price'], 2)); ?> €</td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td><?php echo htmlspecialchars($item['category']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <a href="../../../../Products.php">retourner vers produits</a>
    </div>
</body>
</html>
