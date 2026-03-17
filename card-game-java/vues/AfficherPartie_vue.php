<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Parties</title>
    <!-- Lien vers votre fichier CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styles pour centrer les boutons dans le milieu de la page */
        .parties-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Centre les éléments horizontalement */
            gap: 10px; /* Espace entre les boutons */
        }
        /* Styles pour chaque bouton de partie */
        .partie-bouton {
            border: 1px solid #ccc; /* Bordure */
            border-radius: 5px; /* Bordures arrondies */
            padding: 10px; /* Espace intérieur */
            text-align: center;
            cursor: pointer; /* Affiche la main au survol */
        }
        /* Styles pour les détails de la partie */
        .details {
            display: none; /* Cacher les détails par défaut */
            margin-top: 20px; /* Espace au-dessus des détails */
        }
    </style>
</head>
<body>
    <main>
        <!-- Affichage du message -->
        <?php if (isset($message)) { ?>
            <p style="background-color: yellow;"><?= $message ?></p>
        <?php } ?>

        <!-- Formulaire pour les choix -->
        <form method="POST" action="">
            <label for="choix">Choisir un critère:</label>
            <select name="choix" id="choix">
                <option value="toutes">Toutes les parties</option>
                <option value="50-recentes">Les 50 parties les plus récentes</option>
                <option value="50-rapides">Les 50 parties plus rapides par taille de plateau</option>
            </select>
            <button type="submit" name="confirmer">Confirmer</button>
        </form>

        <!-- Affichage des parties en fonction du choix -->
        <center>
            <h2>Liste des Parties:</h2>
            <?php
            
            // Vérifier si le formulaire a été soumis
            if (isset($_POST['confirmer'])) {
                $choix = $_POST['choix'];

                // Exécuter la requête en fonction du choix
                $Parties = getInstances($connexion, "Partie");
                if ($choix === '50-recentes') {
                    // Trier les 50 parties les plus récentes
                    usort($Parties, function($a, $b) {
                        return strtotime($b['Date_D'] . ' ' . $b['heure_D']) - strtotime($a['Date_D'] . ' ' . $a['heure_D']);
                    });
                    $Parties = array_slice($Parties, 0, 50);
                } elseif ($choix === '50-rapides') {
                    // Trier les 50 parties les plus rapides par taille de plateau
                    usort($Parties, function($a, $b) {
                        return $a['taille'] - $b['taille'] ?: strtotime($a['Date_D'] . ' ' . $a['heure_D']) - strtotime($b['Date_D'] . ' ' . $b['heure_D']);
                    }
				);
                    $Parties = array_slice($Parties, 0, 50);
                }

                // Afficher les parties sous forme de boutons
                if (!empty($Parties)) {
                    echo '<div class="parties-container">';
                    foreach ($Parties as $partie) {
                        echo '<div class="partie-bouton" onclick="afficherDetails(' . $partie['idPartie'] . ')">';
                        echo 'Partie ' . $partie['idPartie'];
                        echo '</div>';

                        // Créer une div pour les détails de la partie (cachée par défaut)
                        echo '<div class="details" id="details-' . $partie['idPartie'] . '">';
                        echo 'Numéro de partie : ' . $partie['idPartie'] . '<br>';
                        echo 'Heure D : ' . $partie['heure_D'] . '<br>';
                        echo 'Date D : ' . $partie['Date_D'] . '<br>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>Aucune partie à afficher pour le moment.</p>';
                }
            }
            ?>
        </center>
    </main>
    <!-- Script JavaScript pour afficher les détails de la partie -->
    <script>
        function afficherDetails(idPartie) {
            // Cacher tous les détails
            const detailsElements = document.querySelectorAll('.details');
            detailsElements.forEach(element => element.style.display = 'none');

            // Afficher les détails de la partie cliquée
            const detailsElement = document.getElementById('details-' + idPartie);
            if (detailsElement) {
                detailsElement.style.display = 'block';
            }
        }
    </script>
</body>
</html>
