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

$email = $passwordInput = "";
$emailError = $passwordError = $loginError = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input values
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passwordInput = mysqli_real_escape_string($conn, $_POST['password']);

    // Basic validation
    if (empty($email)) {
        $emailError = "L'email est requis.";
    }
    if (empty($passwordInput)) {
        $passwordError = "Le mot de passe est requis.";
    }

    // If no errors, proceed with checking the user's credentials
    if (empty($emailError) && empty($passwordError)) {
        // Query to check if the user exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password using password_verify
            if (password_verify($passwordInput, $row['password'])) {
                // Successful login
                session_start();  // Start the session to store user data
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                // Redirect to a dashboard or home page
                header("Location: index.html");
                exit();
            } else {
                $loginError = "Mot de passe incorrect.";
            }
        } else {
            $loginError = "Aucun compte trouvé avec cet email.";
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
    <title>Se connecter</title>
    <link rel="stylesheet" href="./CSS/styless.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="POST" action="signIn.php">
            <div>
                <input type="email" id="loginEmail" name="email" placeholder="Email" required>
                <span class="error-message"><?php echo $emailError; ?></span>
            </div>
            <div>
                <input type="password" id="loginPassword" name="password" placeholder="Mot de passe" required>
                <span class="error-message"><?php echo $passwordError; ?></span>
            </div>
            <button type="submit">Se connecter</button>
            <span class="error-message"><?php echo $loginError; ?></span>
        </form>
        <p>Vous n'avez pas de compte ? <a href="./SignUp.php">Inscrivez-vous</a></p>
    </div>
</body>
</html>
