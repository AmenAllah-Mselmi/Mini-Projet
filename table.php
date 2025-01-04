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

// Récupérer les utilisateurs
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./CSS/index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            font-size: 0.9rem;
            background-color: #f8f9fa;
            color: #777;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
     <!-- Navbar -->
     <nav>
      <input type="checkbox" id="nav-check" />
      <label for="nav-check" id="nav-checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label id="nav-logo">
        <img src="./Images/acceuil.png" alt="Erreur" />
      </label>
      <ul id="nav-links">
        <li><a id="nav-home" href="./index.html">Accueil</a></li>
        <li><a id="nav-products" href="./Products.php">Produits</a></li>
        <li>
          <a id="nav-products" href="./PHP/app/views/items/add.php"
            >Gestion Produits</a
          >
        </li>
        <li><a id="nav-services" href="./Services.html">Services</a></li>
        <li><a id="nav-blogs" href="./Blogs.html">Blogs</a></li>
        <li><a id="nav-contact" href="#contact">Contact</a></li>
        <li><a id="nav-table" href="./table.php">Table</a></li>

        <li>
          <a id="nav-logout" href="#" onclick="login()">
            <i class="fas fa-sign-in-alt" id="loginIcon"></i> Log
          </a>
        </li>
      </ul>
    </nav>
    <div id="cart-container" class="hidden">
        <div id="cart-content">
          <h2>Mon Panier</h2>
          <ul id="cart-items">
            <li>Aucun article dans le panier.</li>
          </ul>
        </div>
      </div>
    <header>
        <h1>Gestion des Utilisateurs</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="PHP/app/views/users/add.php" class="btn"><i class="fas fa-user-plus"></i> Ajouter un utilisateur</a>
            <a href="PHP/app/views/users/delete.php" class="btn"><i class="fas fa-user-minus"></i> Supprimer un utilisateur</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php $conn->close(); ?>
     <!-- contact-us  -->
  <div id="contact" class="contact-section">
    <div class="container">
      <div class="title text-center">
        <h1>Contactez-Nous</h1>
        <p>Dites-nous ce dont vous avez besoin et nous vous répondrons dans les plus brefs délais.</p>
      </div>
      <div class="form">
        <div class="form-group">
          <label for="firstname">Prénom</label>
          <input type="text" name="firstname" id="firstname" placeholder="foulen">
        </div>
        <div class="form-group">
          <label for="lastname">Nom de famille</label>
          <input type="text" name="lastname" id="lastname" placeholder="BenFoulen">
        </div>
        <div class="form-group full-width">
          <label for="email">Adresse e-mail</label>
          <input type="email" name="email" id="email" placeholder="foulen@example.com">
        </div>
        <div class="form-group full-width">
          <label for="subject">Sujet</label>
          <input type="text" name="subject" id="subject" placeholder="Nom du Sujet">
        </div>
        <div class="form-group full-width">
          <label for="message">Message</label>
          <textarea name="message" id="message" placeholder="Votre message..." rows="5"></textarea>
        </div>
        <div class="submit">
          <button id="sendButton">Envoyer Message</button>
          <div id="loading" class="loading"></div>
        </div>
      </div>
    </div>
  </div>
        <!-- Footer -->
        <footer>
        <div class="footer-container">
            <div class="footer-links">
                <h3>Liens Rapides</h3>
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="./HTML/Products.php">Produits</a></li>
                    <li><a href="./HTML/Services.html">Services</a></li>
                    <li><a href="./HTML/Blogs.html">Blogs</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Nous Contacter</h3>
                <p>Email: <a href="mailto:contact@washandgo.com">foulen@gmail.com</a></p>
                <p>Téléphone: +1 234 567 890</p>
                <p>Adresse: 123 Wash & Go Rue, Sousse,Tunisie</p>
            </div>
            <div class="footer-social">
                <h3>Suivez-Nous</h3>
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <p>&copy; 2025 Réalisé par AmenAllah et Firas.</p>
    </footer>
    
    <script>
        function login() {
        window.location.href = "./signIn.php";
      }
      // script.js

      // Gestion du panier
      let cartVisible = false;

      function toggleCart() {
        const cartContainer = document.getElementById("cart-container");
        cartContainer.classList.toggle("hidden");
      }


      // Masquer le panier si on clique à l'extérieur
      document.addEventListener("click", (e) => {
        const cartContainer = document.getElementById("cart-container");
        const cartIcon = document.getElementById("cart-icon");

        if (!cartContainer.contains(e.target) && e.target !== cartIcon) {
          cartContainer.classList.add("hidden");
          cartVisible = false;
        }
      });
    </script>
</body>
</html>
