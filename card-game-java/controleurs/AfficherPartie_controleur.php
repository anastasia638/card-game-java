<?php 
require_once('modele/modele.php');
$message_liste = "";
$message_details = "";

$Partie = getInstances($connexion, "Partie");
if($Partie == null || count($Partie) == 0) {
	$message .= "Aucune Partie n'a été trouvée dans la base de données !";}

 foreach ($Partie as $partie) {
    // Vérifiez que la variable $partie est bien initialisée et n'est pas null
    if (isset($partie['Date_D']) && isset($partie['heure_D'])) {
        // Continuez avec votre code si les indices existent
        $Date_D = $partie['Date_D'];
        $heure_D = $partie['heure_D'];
    
        }
    }
	