<?php
// Database connection
$servername = "localhost";
$username = "root";  // default XAMPP MySQL username
$password = "";      // default XAMPP MySQL password (if not set, leave it blank)
$dbname = "lavage1";  // replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $email = $password = "";
$nameError = $emailError = $passwordError = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input values
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Basic validation
    if (empty($name)) {
        $nameError = "Le nom est requis.";
    }
    if (empty($email)) {
        $emailError = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "L'email n'est pas valide.";
    }
    if (empty($password)) {
        $passwordError = "Le mot de passe est requis.";
    }

    // Vérifier si l'email existe déjà
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $emailError = "Un compte avec cet email existe déjà.";
    }

    // If no errors, insert data into the database
    if (empty($nameError) && empty($emailError) && empty($passwordError)) {
        // Password hashing for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Manually handle the `id` insertion (get the last inserted `id` and add 1)
        $sql = "SELECT MAX(id) AS last_id FROM users";
        $result = $conn->query($sql);
        $lastId = 0; // Default to 0 if there are no users
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastId = $row['last_id'];
        }
        $newId = $lastId + 1; // New ID is the last one + 1

        // Insert data into the database
        $sql = "INSERT INTO users (id, name, email, password) VALUES ('$newId', '$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Compte créé avec succès!";
            // Redirect to login page or another page
            header("Location: signIn.php");
            exit();
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <form method="POST" action="signUp.php">
            <div>
                <input type="text" id="name" placeholder="Nom complet" name="name" value="<?php echo $name; ?>" required>
                <span class="error-message"><?php echo $nameError; ?></span>
            </div>
            <div>
                <input type="email" id="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                <span class="error-message"><?php echo $emailError; ?></span>
            </div>
            <div>
                <input type="password" id="password" placeholder="Mot de passe" name="password" required>
                <span class="error-message"><?php echo $passwordError; ?></span>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="signIn.php">Connectez-vous</a></p>
    </div>
</body>
</html>
