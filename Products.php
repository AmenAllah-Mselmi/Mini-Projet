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
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
        ];
    }
} else {
    echo '<p>Aucun produit trouvé.</p>';
}
$conn->close();

// Gestion des requêtes pour le panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add_to_cart') {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;

        if ($id && $name && $price) {
            // Récupérer le panier existant dans le cookie
            $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

            // Vérifier si le produit est déjà dans le panier
            $alreadyInCart = false;
            foreach ($cart as $item) {
                if ($item['id'] == $id) {
                    $alreadyInCart = true;
                    break;
                }
            }

            if ($alreadyInCart) {
                echo "<script>alert('Vous ne pouvez pas ajouter le même produit deux fois au panier.');</script>";
                exit;
            }

            // Ajouter le produit au panier
            $cart[] = [
                'id' => $id,
                'name' => $name,
                'price' => $price
            ];

            // Sauvegarder le panier dans le cookie
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 30 jours
            echo "Produit ajouté au panier";
            exit;
        }
    }

    if ($_POST['action'] === 'remove_from_cart') {
        $id = $_POST['id'] ?? null;

        if ($id) {
            // Récupérer le panier existant
            $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

            // Filtrer les produits pour enlever celui avec l'ID spécifié
            $cart = array_filter($cart, function($item) use ($id) {
                return $item['id'] !== $id;
            });

            // Réindexer le tableau après filtrage
            $cart = array_values($cart);

            // Sauvegarder le panier mis à jour dans le cookie
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
            echo "Produit supprimé du panier";
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits et Panier</title>
    <link rel="stylesheet" href="../CSS/Products.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <li><a href="./index.html">Accueil</a></li>
            <li><a href="./Products.php">Produits</a></li>
            <li><a href="./PHP/app/views/items/add.php">Gestion Produits</a></li>
            <li><a href="./Services.html">Services</a></li>
            <li><a href="./Blogs.html">Blogs</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="./table.php">Table</a></li>
            <li>
                <a href="#" id="cart-icon" onclick="toggleCart()">
                    <i class="fas fa-shopping-cart"></i> Panier
                </a>
            </li>
            <li><a href="#" id="nav-logout" onclick="login()">Log</a></li>
        </ul>
    </nav>

    <!-- Cart Section -->
    <div id="cart-container" class="hidden">
        <div id="cart-content">
            <h2>Mon Panier</h2>
            <ul id="cart-items">
                <?php
                $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
                $total = 0;
                if (!empty($cart)): 
                    foreach ($cart as $item): 
                        $total += $item['price'];
                ?>
                    <li>
                        <?= htmlspecialchars($item['name']); ?> - <?= htmlspecialchars($item['price']); ?> TND
                        <button onclick="removeFromCart(<?= $item['id']; ?>)">Supprimer</button>
                    </li>
                <?php endforeach; ?>
                <p><strong>Total:</strong> <?= $total; ?> TND</p>
                <?php else: ?>
                    <li>Aucun article dans le panier.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Produits Section -->
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
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="./Images/produits/Tire-Cleaner.avif" alt="Nettoyant Pneus" width="200px">
                <h3><?= htmlspecialchars($product['name']); ?></h3>
                <p class="price" data-price="<?= htmlspecialchars($product['price']); ?>"><?= htmlspecialchars($product['price']); ?> TND</p>
                <button onclick="addToCart(<?= $product['id']; ?>, '<?= htmlspecialchars($product['name']); ?>', <?= $product['price']; ?>)">Acheter Maintenant</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <h3>Liens Rapides</h3>
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="./Products.php">Produits</a></li>
                    <li><a href="./Services.html">Services</a></li>
                    <li><a href="./Blogs.html">Blogs</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Nous Contacter</h3>
                <p>Email: <a href="mailto:contact@washandgo.com">foulen@gmail.com</a></p>
                <p>Téléphone: +1 234 567 890</p>
                <p>Adresse: 123 Wash & Go Rue, Sousse, Tunisie</p>
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

        // Ajouter un produit au panier via AJAX
        function addToCart(productId, name, price) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "Products.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert("Produit ajouté au panier !");
                    location.reload(); // Rafraîchir la page pour mettre à jour le panier
                } else {
                    alert("Erreur lors de l'ajout au panier.");
                }
            };
            xhr.send(`action=add_to_cart&id=${productId}&name=${name}&price=${price}`);
        }

        // Supprimer un produit du panier
        function removeFromCart(productId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "Products.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert("Produit supprimé du panier.");
                    location.reload(); // Rafraîchir la page pour mettre à jour le panier
                } else {
                    alert("Erreur lors de la suppression du produit.");
                }
            };
            xhr.send(`action=remove_from_cart&id=${productId}`);
        }
    </script>
</body>
</html>
