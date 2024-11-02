document.addEventListener("DOMContentLoaded", function () {
    const currencySelect = document.getElementById("currency");
    const productPrices = document.querySelectorAll(".product-card p");
    const originalPrices = [15, 20, 25, 30, 35, 40, 45, 50]; 

    let exchangeRates = {
        "TND": 1, // Taux de base pour TND
        "USD": 0.32, //  USD
        "EUR": 0.30  //  EUR
    };

    // Fonction pour convertir et afficher les prix
    function convertPrices() {
        const selectedCurrency = currencySelect.value;
        const rate = exchangeRates[selectedCurrency];

        productPrices.forEach((priceElem, index) => {
            const convertedPrice = (originalPrices[index] * rate).toFixed(2);
            priceElem.textContent = `${convertedPrice} ${selectedCurrency}`;
        });
    }

    // Écouteur d'événement pour changement de devise
    currencySelect.addEventListener("change", convertPrices);

    // Initialisation : Affichage des prix en devise par défaut
    convertPrices();
});