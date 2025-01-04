<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $category = htmlspecialchars($_POST['category']);
    
    // (Optionnel) Enregistrement dans une base de données
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=lavage1', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO produits (name, description, price, quantity, category) VALUES (:name, :description, :price, :quantity, :category)");
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':quantity' => $quantity,
            ':category' => $category,
        ]);

        // Redirection vers index.html
        header("Location: ../../../../Products.php");
        exit(); // Assurez-vous d'arrêter l'exécution après la redirection
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
