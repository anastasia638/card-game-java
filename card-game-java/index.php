<?php
/* Page principale dont le contenu s'adaptera dynamiquement*/
session_start();                      // démarre ou reprend une session
/* Gestion de l'affichage des erreurs */
ini_set('display_errors', 1);         
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL); 

/* Inclusion des fichiers contenant : ...  */          
require('inc/config-bd.php');  /* ... la configuration de connexion à la base de données */
require('inc/includes.php');   /* ... les constantes et variables globales */
require('modele/modele.php');  /* ... la définition du modèle */

/* Création de la connexion ( initiatilisation de la variable globale $connexion )*/
open_connection_DB(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <!-- le titre du document, qui apparait dans l'onglet du navigateur -->
    <title>Débiclou Race</title>

    <!-- lien vers le style CSS externe  -->
    <link rel="stylesheet"  href="css/style.css">
    
    <!-- lien vers une image favicon (qui apparaitra dans l'onglet du navigateur) -->
    <link rel="shortcut icon" type="image/x-icon" href="img/raceD.png" />
</head>
<body>
    <?php 

    /* Inclusion de la partie Entête (Header)*/
    include('static/header.php');
    
    /* Inclusion du menu*/
    include('static/menu.php'); 
    ?>
	

    <!-- Définition du bloc principal -->
     	
	<main class="main_div">
	<?php
	/* Initialisation du contrôleur et de la vue par défaut */
	$controleur = 'accueil_controleur.php';
	$vue = 'accueil_vue.php'; 
	
	/* Affectation du contrôleur et de la vue souhaités */

		if(isset($_GET['page'])) {
			// récupération du paramètre 'page' dans l'URL
			$nomPage = $_GET['page'];
			// construction des noms de contrôleur et de vue
			$controleur = $nomPage . '_controleur.php';
			$vue = $nomPage . '_vue.php';
		}
		include('controleurs/' . $controleur); // Utilisation du bon chemin pour le contrôleur
		include('vues/' . $vue ); // Utilisation du bon chemin pour la vue	
		?>
	</main>
	<?php
    /* Inclusion de la partie Pied de page*/ 
    include('static/footer.php'); 
    ?>
	</body>
    </html>