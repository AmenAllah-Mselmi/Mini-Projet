<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "lavage1"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$message = "";

// Ajout de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Vérification si l'email existe déjà dans la base de données
    $checkEmailQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // L'email existe déjà
        $message = "L'email est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        // L'email n'existe pas, on peut ajouter l'utilisateur
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "L'utilisateur a été ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        label {
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            text-align: left;
        }

        input {
            padding: 14px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            color: #333;
        }

        input:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 14px;
            border: none;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 20px;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            font-size: 1rem;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #007BFF;
        }

        .footer a {
            color: #007BFF;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Utilisateur</h1>
        <form action="" method="POST">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" placeholder="Entrez le nom" required>

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" placeholder="Entrez l'email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" placeholder="Entrez le mot de passe" required>

            <button type="submit">Ajouter</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'succès') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="footer">
            <a href="../../../../../../table.php">Retour à la liste des utilisateurs</a>
        </div>
    </div>
</body>
</html>
