let users = [];

// Charger les utilisateurs depuis le localStorage
function loadUsers() {
    const storedUsers = localStorage.getItem('users');
    if (storedUsers) {
        users = JSON.parse(storedUsers);
    }
    updateUserList(); // Mettre à jour l'affichage après chargement
}

// Enregistrer les utilisateurs dans le localStorage
function saveUsers() {
    localStorage.setItem('users', JSON.stringify(users));
}

// Fonction pour valider l'email
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Fonction pour valider le nom
function validateName(name) {
    const nameRegex = /^[A-Z][a-zA-Z]*$/;
    return nameRegex.test(name);
}

// Fonction pour valider le mot de passe
function validatePassword(password) {
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
    return passwordRegex.test(password);
}

// Mettre à jour l'affichage des utilisateurs
function updateUserList() {
    const userListItems = document.getElementById("userListItems");
    if (userListItems) {
        userListItems.innerHTML = "";
        users.forEach((user) => {
            const row = document.createElement("tr");

            const nameCell = document.createElement("td");
            nameCell.textContent = user.name;
            row.appendChild(nameCell);

            const emailCell = document.createElement("td");
            emailCell.textContent = user.email;
            row.appendChild(emailCell);

            userListItems.appendChild(row);
        });
    }
}

// Gestion de l'inscription
document.getElementById("signUpForm")?.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    // Réinitialiser les messages d'erreur
    nameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";

    let hasError = false;

    // Validation du nom
    if (!validateName(name)) {
        nameError.textContent = "Le nom doit commencer par une lettre majuscule.";
        hasError = true;
    }

    // Validation de l'email
    if (!validateEmail(email)) {
        emailError.textContent = "Veuillez entrer un email valide.";
        hasError = true;
    }

    // Validation du mot de passe
    if (!validatePassword(password)) {
        passwordError.textContent = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
        hasError = true;
    }

    // Vérification si l'utilisateur existe déjà
    const existingUser = users.find(u => u.email === email);
    if (existingUser) {
        emailError.textContent = "Un compte avec cet email existe déjà.";
        hasError = true;
    }

    if (hasError) {
        return;
    }

    // Ajouter l'utilisateur
    users.push({ name, email, password });
    saveUsers();
    updateUserList(); // Mettre à jour la liste des utilisateurs
    alert("Inscription réussie !");
    window.location.href = "signIn.html";
});

// Gestion de la connexion
document.getElementById("signInForm")?.addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value;

    console.log("Tentative de connexion avec : ", email, password); // Debug

    // Recherche de l'utilisateur dans le tableau users
    const user = users.find(u => u.email === email && u.password === password);

    // Debug: Vérifier la structure des utilisateurs
    console.log("Utilisateurs chargés : ", users); // Debug

    if (user) {
        alert("Connexion réussie !");
        // Enregistrer l'utilisateur dans le sessionStorage si besoin
        sessionStorage.setItem("currentUser", JSON.stringify(user));
        window.location.href = "index.html";  
    } else {
        alert("Email ou mot de passe incorrect.");
    }
});

// Charger les utilisateurs au chargement de la page
loadUsers();
