<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="src/includes/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
</head>

<body>
<div class="zone_logo_connexion">
    <img class="logo_gros" src="src/img/bigLogo.png" alt="Logo">
</div>

<form class="Formulaire_connexion" action="" method="POST">
    <input type="text" class="pure-input-rounded" name="pseudo_Joueur_connexion" placeholder="Username">
    <br><br>
    <input type="password" class="pure-input-rounded" name="mdp_Joueur_connexion" placeholder="Password">
    <br><br>
    <button type="submit" class="boutonJouer" name="connexion">Connexion</button>
</form>

<div class="zone_bouton_redirection_inscription">
    <a href="inscription" class="boutonTexte">Pas de compte ? M'inscrire</a>
</div>
</body>
</html>
