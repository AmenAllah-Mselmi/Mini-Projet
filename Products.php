<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'lavage1');
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les produits
$sql = "SELECT * FROM produits";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Collecter les produits dans un tableau associatif
        $products[] = [
            'name' => $row['name'],
            'price' => $row['price'],
        ];
    }
} else {
    echo '<p>Aucun produit trouvé.</p>';
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit de Lavage</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/Products.css">
    <link rel="shortcut icon" href="../Images/icones/projectIcone.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <input type="checkbox" id="nav-check">
        <label for="nav-check" id="nav-checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label id="nav-logo">
            <img src="./Images/acceuil.png" alt="Erreur">
        </label>
        <ul id="nav-links">
            <li><a id="nav-home" href="./index.html" >Accueil</a></li>
            <li><a id="nav-products" href="./Products.php">Produits</a></li>
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

    <!-- Titre -->
    <header>
        <h1>Produits Offerts par Lavage</h1>
    </header>

    <!-- Sélecteur de devise -->
    <div class="currency-converter">
        <label for="currency">Choisissez la devise :</label>
        <select id="currency">
            <option value="TND">TND</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select>
    </div>

    <!-- Produits -->
    <div class="product-grid">
        <?php
        foreach ($products as $product) {
            echo '<div class="product-card">
                    <img src="./Images/produits/Tire-Cleaner.avif" alt="Nettoyant Pneus" width="200px">
                    <h3>' . $product['name'] . '</h3>
                    <p class="price" data-price="' . $product['price'] . '">' . $product['price'] . ' TND</p>
                    <button>Acheter Maintenant</button>
                  </div>';
        }
        ?>
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
        <p>&copy; 2024 Réalisé par AmenAllah et Firas.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currencySelect = document.getElementById("currency");
            const productPrices = document.querySelectorAll(".product-card .price");

            const exchangeRates = {
                "TND": 1,
                "USD": 0.32,
                "EUR": 0.30
            };

            function convertPrices() {
                const selectedCurrency = currencySelect.value;
                const rate = exchangeRates[selectedCurrency];

                productPrices.forEach((priceElem) => {
                    const originalPrice = parseFloat(priceElem.getAttribute('data-price'));
                    const convertedPrice = (originalPrice * rate).toFixed(2);
                    priceElem.textContent = `${convertedPrice} ${selectedCurrency}`;
                });
            }

            currencySelect.addEventListener("change", convertPrices);
            convertPrices();
        });
        function login() {
            window.location.href = "./signIn.php"; 
        }
    </script>
</body>
</html>
