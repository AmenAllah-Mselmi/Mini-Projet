let users = [   
];

// Charger les utilisateurs depuis le localStorage
function loadUsers() {
    const storedUsers = localStorage.getItem('users');
    if (storedUsers) {
        users = JSON.parse(storedUsers);
    }
    updateUserList();
}

// Enregistrer les utilisateurs dans le localStorage
function saveUsers() {
    localStorage.setItem('users', JSON.stringify(users));
}

// Mettre à jour l'affichage des utilisateurs (pour debug)
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


// Fonction pour valider l'email
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Gestion de l'inscription
document.getElementById("signUpForm")?.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    // Validation des données
    if (name.length < 3) {
        alert("Le nom doit contenir au moins 3 caractères.");
        return;
    }

    if (!validateEmail(email)) {
        alert("Veuillez entrer un email valide.");
        return;
    }

    if (password.length < 6) {
        alert("Le mot de passe doit contenir au moins 6 caractères.");
        return;
    }

    // Vérification si l'utilisateur existe déjà
    const existingUser = users.find(u => u.email === email);
    if (existingUser) {
        alert("Un compte avec cet email existe déjà. Veuillez en choisir un autre.");
        return;
    }

    // Ajout de l'utilisateur au tableau users
    users.push({ name, email, password });
    alert("Inscription réussie !");

    // Sauvegarde des utilisateurs dans le localStorage
    saveUsers();

    // Mettre à jour l'affichage après l'inscription
    updateUserList();

    // Redirection vers la page de connexion
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
        // Vous pouvez enregistrer l'utilisateur dans le sessionStorage si besoin
        window.location.href = "index.html";  
    } else {
        alert("Email ou mot de passe incorrect.");
    }
});

// Charger les utilisateurs au chargement de la page
loadUsers();
