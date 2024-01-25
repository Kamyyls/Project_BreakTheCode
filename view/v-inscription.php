<link rel="stylesheet" href="src/includes/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">

<body>
    <div class="zone_titre_inscription">
        <p class="Titre">INSCRIPTION</p>
    </div>

    <div class="zone_logo_inscription">
        <img class="logo_inscription" src="src/img/inscriptionEtape2.jpg"</img>
    </div>

    <form class="Formulaire_connexion" action="" method="POST">
        <div class="form_deux_boutons">
            <input type="text" class="pure-input-rounded-name" name="prenomJoueur_inscription" placeholder="Prenom">
            <input type="text" class="pure-input-rounded" name="nomJoueur_inscription" placeholder="Nom">
        </div>

        <br>
        <input type="date" class="pure-input-rounded" name="dateJoueur_inscription" placeholder="Date">
        <br>
        <input type="text" class="pure-input-rounded" name="pseudoJoueur_inscription" placeholder="Pseudo">
        <br>
        <input type="email" class="pure-input-rounded" name="emailJoueur_inscription" placeholder="Saissisez un mail">
        <br>
        <input type="password" class="pure-input-rounded" name="mdpJoueur_inscription" placeholder="Choissisez un Password">
        <br>
        <input type="password" class="pure-input-rounded" name="mdpConfirmationJoueur_inscription" placeholder="Confirmer Password">

        <div class="Conditions_mdp">
            <p class="condition" id="condition-taille"> - 8 caractères</p>
            <p class="condition" id="condition-chiffre"> - 1 chiffre</p>
            <p class="condition" id="condition-special"> - 1 caractère spécial</p>
        </div>

        <button type="submit" class="boutonJouer" name="inscription">Inscription</button>
    </form>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.querySelector('input[name="mdpJoueur_inscription"]');
        const conditions = {
            taille: document.getElementById('condition-taille'),
            chiffre: document.getElementById('condition-chiffre'),
            special: document.getElementById('condition-special')
        };

        passwordInput.addEventListener('input', function() {
            const passwordValue = passwordInput.value;

            // Vérifiez les conditions et mettez à jour la couleur en conséquence
            conditions.taille.style.color = passwordValue.length >= 8 ? 'green' : '#E26868';
            conditions.chiffre.style.color = /\d/.test(passwordValue) ? 'green' : '#E26868';
            conditions.special.style.color = /[^A-Za-z0-9]/.test(passwordValue) ? 'green' : '#E26868';
        });
    });
</script>

