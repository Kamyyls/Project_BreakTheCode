 <link rel="stylesheet" href="src/includes/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">

<body>

    <!-- Les questions -->
    <form action="" method="POST">
        <div class="alignement-carte">
        <?php foreach ($_SESSION['cartes'] as $carte) : ?>
            <button class="invisible-button" name="button-carte" value="<?php echo $carte->getImage(); ?>">
                <img class="cartes-question" src="src/img/cartes/<?php echo $carte->getImage(); ?>" >
            </button>
        <?php endforeach; ?>
    </div>
    </form>

    <div class="zone-tuiles">

        <div class="alignement-carte-joueur">
            <?php foreach ($_SESSION['tuilesJoueur'] as $tuile) : ?>
                <img class="tuile" src="src/img/tuiles/<?php echo $tuile->getImage(); ?>" >
            <?php endforeach; ?>
        </div>

            <div class="zone-icon" onclick="soumettreFormulaire()">
                <button class="button button5" name="buzzer">
                   <img class="icon" src="../src/img/buttons/redButton.png" alt="Notebook Icon">
                </button>
            </div>

        <form id="try" action="" method="POST">

            <div class="selection-cartes-adversaire">
                <div class="boutton-selection-cartes-adversaire" name="carte1">
                    <img class="tuile-adversaire" src="src/img/tuiles/card_select_blank.png" onclick="changerImage(this)">
                </div>

                <div class="boutton-selection-cartes-adversaire" name="carte2">
                    <img class="tuile-adversaire" src="src/img/tuiles/card_select_blank.png" onclick="changerImage(this)">
                </div>

                <div class="boutton-selection-cartes-adversaire" name="carte3">
                    <img class="tuile-adversaire" src="src/img/tuiles/card_select_blank.png" onclick="changerImage(this)">
                </div>

                <div class="boutton-selection-cartes-adversaire" name="carte4">
                    <img class="tuile-adversaire" src="src/img/tuiles/card_select_blank.png" onclick="changerImage(this)">
                </div>

                <div class="boutton-selection-cartes-adversaire" name="carte5">
                    <img class="tuile-adversaire" src="src/img/tuiles/card_select_blank.png" onclick="changerImage(this)">
                </div>
            </div>
        </form>
        <script>
            // Fonction pour soumettre le formulaire
            function soumettreFormulaire() {
                // Soumettre le formulaire
                document.getElementById('try').submit();
            }
        </script>
    </div>

    <div class="zone-reponse">
        <div class="question-joueur">
            <img class="icon-small" src="src/img/logo_human.png">
            <img class="cartes-question-choisie" src="src/img/cartes/<?php echo $valeur_Carte ?>">
        </div>

        <div class="reponse-question">
            <p>Réponse : <?php echo $reponse?></p>
        </div>

        <form id="reponse" action="" method="POST">
            <div class="zone-texte">
                <input type="text" name="reponseJoueur" placeholder="saisissez votre reponse"  rows="10" cols="30">
                <button type="button" onclick="submitResponse()">Soumettre</button>
            </div>
        </form>

        <div class="zone-icon" onclick="afficherZoneTexte()">
            <img class="icon" src="src/img/icons/notebook.png" alt="Notebook Icon">
        </div>
        <script>
            // Fonction pour soumettre la réponse du joueur en utilisant AJAX
            function submitResponse() {
                var response = document.getElementById('reponseJoueur').value;

                // Envoyer la réponse à un script PHP via AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'traitement_reponse.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Traiter la réponse du serveur si nécessaire
                        console.log(xhr.responseText);
                    }
                };
                xhr.send('reponseJoueur=' + encodeURIComponent(response));
            }
        </script>

    </div>

    <div class="modal" id="myModal" onclick="fermerZoneTexte()">
        <div class="textarea-container" onclick="event.stopPropagation();">
            <textarea rows="10" cols="30"></textarea>
        </div>
    </div>

    <script>
        function afficherZoneTexte() {
            var modal = document.getElementById("myModal");
            modal.style.display = "flex";
        }

        function fermerZoneTexte() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>

    <!--Pour changer selectionner carte du joueur adversaire -->
    <script>
        var images = [
            "src/img/tuiles/carte_gris_0.png",
            "src/img/tuiles/carte_gris_1.png",
            "src/img/tuiles/carte_gris_2.png",
            "src/img/tuiles/carte_gris_3.png",
            "src/img/tuiles/carte_gris_4.png",
            "src/img/tuiles/carte_gris_6.png",
            "src/img/tuiles/carte_gris_7.png",
            "src/img/tuiles/carte_gris_8.png",
            "src/img/tuiles/carte_gris_9.png",
            "src/img/tuiles/carte_noir_0.png",
            "src/img/tuiles/carte_noir_1.png",
            "src/img/tuiles/carte_noir_2.png",
            "src/img/tuiles/carte_noir_3.png",
            "src/img/tuiles/carte_noir_4.png",
            "src/img/tuiles/carte_noir_6.png",
            "src/img/tuiles/carte_noir_7.png",
            "src/img/tuiles/carte_noir_8.png",
            "src/img/tuiles/carte_noir_9.png",
            "src/img/tuiles/carte_vert_5.png",
        ];

        var indexImage = 0;

        function changerImage(element) {
            // Changer l'image suivante dans la liste
            if (indexImage < images.length - 1) {
                indexImage++;
            } else {
                indexImage = 0;
            }

            element.src = images[indexImage];
        }
    </script>
</body>