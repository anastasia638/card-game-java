<?php 

////////////////////////////////////////////////////////////////////////
///////    Gestion de la connxeion   ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

/**
 * Initialise la connexion à la base de données courante (spécifiée selon constante 
 *	globale SERVEUR, UTILISATEUR, MOTDEPASSE, BDD)			
 */
function open_connection_DB() {
	global $connexion;

	$connexion = mysqli_connect(SERVEUR, UTILISATEUR, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
}


/**
 *  	Ferme la connexion courante
 * */
function close_connection_DB() {
	global $connexion;

	mysqli_close($connexion);
}


////////////////////////////////////////////////////////////////////////
///////   Accès au dictionnaire       ///////////////////////////////////
////////////////////////////////////////////////////////////////////////


/**
 *  Retourne la liste des tables définies dans la base de données courantes (BDD)
 * */
function get_tables() {
	global $connexion;

	$requete = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '". BDD ."'";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}


/**
 *  Retourne les statistiques sur la base de données courante
 * */
function get_statistiques() {
    global $connexion;

    // Requête pour obtenir le nombre de tables
    $requete_tables = "SELECT COUNT(table_name) AS total_tables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '" . BDD . "'";

    // Requête pour obtenir le nombre cumulé de n-uplets
    $requete_nuplets = "SELECT SUM(TABLE_ROWS) AS total_nuplets FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '" . BDD . "'";

    // Requête pour obtenir le nombre de joueurs
    $requete_joueurs = "SELECT COUNT(*) AS total_joueurs FROM Joueur";

    // Requête pour obtenir le nombre d'équipes
    $requete_equipes = "SELECT COUNT(*) AS total_equipes FROM Equipe";

    // Requête pour obtenir le nombre de classements
    $requete_classements = "SELECT COUNT(*) AS total_classements FROM Classement";

    // Requête pour obtenir le nombre de tournois
    $requete_tournois = "SELECT COUNT(*) AS total_tournois FROM Tournoi";

    // Requête pour obtenir la moyenne des participants par tournoi
    $requete_moyenne_participants = "SELECT AVG(participants) AS moyenne_participants_par_tournoi
    FROM (SELECT COUNT(*) AS Participants
    FROM Participe GROUP BY idT) AS moyenne_participants_par_tournoi";
                                    
    // Requête pour obtenir les phases de tournoi jouées par l'utilisateur courant
    $requete_phases_utilisateur = "SELECT t.nom AS nom_tournoi, YEAR(t.Date_D) AS annee_Tournoi, p.niveau AS niveau_Phase
    FROM Phase p JOIN Tournoi t ON p.idT = t.idTournoi WHERE p.idTournoi = (SELECT idTournoi FROM Tournoi
    WHERE nom = 'DicyRace') ORDER BY YEAR(t.Date_D) DESC, p.niveau DESC ";
                                   
                                   

    // Requête pour obtenir le nombre d'équipes classées premières des classements et dont aucun des membres n'est premier dans un classement individuel
    $requete_equipes_premieres = "SELECT COUNT(*) AS nombre_equipes
    FROM ( SELECT Equipe.idEquipe FROM Equipe JOIN Classement_Equipe ce ON Equipe.idEquipe = ce.idEquipe
    WHERE ce.rang = 1 AND NOT EXISTS ( SELECT * FROM Joueur JOIN Classement_Individuel ci ON Joueur.idJoueur = ci.idJoueur
    WHERE ci.rang = 1 AND Equipe.idEquipe = Joueur.idJoueur ) ) AS sous_requete";
   
    // Requête pour obtenir le nombre moyen de participants aux tournois pour les trois dernières années
    $requete_moyenne_participants_trois_dernieres_annees = "SELECT AVG(nb_participants) AS moyenne_participants
    FROM ( SELECT COUNT(*) AS nb_participants FROM participe_a JOIN Tournoi ON participe_a.idTournoi = Tournoi.idTournoi
    WHERE YEAR(Tournoi.Date_D) >= YEAR(CURDATE()) - 2 GROUP BY Tournoi.idTournoi ) AS subquery";

   
    // Requête pour obtenir le nom et le prénom des joueurs classés dans le top 5 d'au moins deux classements nationaux
    $requete_top_joueurs_nationaux = "SELECT nom, prenom
    FROM Joueur WHERE idJ IN ( SELECT ci.idJoueur
    FROM Classement c INNER JOIN Classement_Individuel ci ON c.idC = ci.idClassement
    WHERE c.portée = 'nationale' GROUP BY ci.idJoueur HAVING COUNT(*) >= 2 AND MAX(ci.rang) <= 5 ) ";

   

    // Requête pour obtenir le nombre de parties jouées pour chaque taille de plateau
    $requete_nb_parties_par_taille_plateau = "SELECT p.nbCartes, COUNT(*) AS nb_parties_jouees
    FROM Plateau p GROUP BY p.nbCartes ";
                                          
    // Requête pour obtenir le top 5 des joueurs qui ont joué le plus de parties
    $requete_top_joueurs = "SELECT Joueur.pseudo, COUNT(Joue.IdPartie) AS nombre_parties
    FROM Joueur INNER JOIN joue_a ON Joueur.idJoueur = Joue.idJoueur
    GROUP BY Joueur.idJoueur ORDER BY nombre_parties DESC LIMIT 5 ";

   
   
    // Exécution des requêtes
    $res_tables = mysqli_query($connexion, $requete_tables);
    $res_nuplets = mysqli_query($connexion, $requete_nuplets);
    $res_joueurs = mysqli_query($connexion, $requete_joueurs);
    $res_equipes = mysqli_query($connexion, $requete_equipes);
    $res_classements = mysqli_query($connexion, $requete_classements);
    $res_tournois = mysqli_query($connexion, $requete_tournois);
    $res_moyenne_participants = mysqli_query($connexion, $requete_moyenne_participants);
    $res_phases_utilisateur = mysqli_query($connexion, $requete_phases_utilisateur);
    $res_equipes_premieres = mysqli_query($connexion, $requete_equipes_premieres);
    $res_moyenne_participants_trois_dernieres_annees = mysqli_query($connexion, $requete_moyenne_participants_trois_dernieres_annees);
    $res_top_joueurs_nationaux = mysqli_query($connexion, $requete_top_joueurs_nationaux);
    $res_nb_parties_par_taille_plateau = mysqli_query($connexion, $requete_nb_parties_par_taille_plateau);
    $res_top_joueurs = mysqli_query($connexion, $requete_top_joueurs);

    // Récupération des résultats
    $resultats_tables = mysqli_fetch_assoc($res_tables);
    $resultats_nuplets = mysqli_fetch_assoc($res_nuplets);
    $resultats_joueurs = mysqli_fetch_assoc($res_joueurs);
    $resultats_equipes = mysqli_fetch_assoc($res_equipes);
    $resultats_classements = mysqli_fetch_assoc($res_classements);
    $resultats_tournois = mysqli_fetch_assoc($res_tournois);
    $resultats_moyenne_participants = mysqli_fetch_assoc($res_moyenne_participants);
    $resultats_phases_utilisateur = mysqli_fetch_all($res_phases_utilisateur, MYSQLI_ASSOC);
    $resultats_equipes_premieres = mysqli_fetch_assoc($res_equipes_premieres);  
    $resultats_moyenne_participants_trois_dernieres_annees = mysqli_fetch_assoc($res_moyenne_participants_trois_dernieres_annees);
    $resultats_top_joueurs_nationaux = mysqli_fetch_all($res_top_joueurs_nationaux, MYSQLI_ASSOC);
    $resultats_nb_parties_par_taille_plateau = mysqli_fetch_all($res_nb_parties_par_taille_plateau, MYSQLI_ASSOC);
    $resultats_top_joueurs = mysqli_fetch_all($res_top_joueurs, MYSQLI_ASSOC);


    // Retourner les statistiques sous forme de tableau
    return array(
        'nombre_tables' => $resultats_tables['total_tables'],
        'nombre_nuplets' => $resultats_nuplets['total_nuplets'],
        'nombre_joueurs' => $resultats_joueurs['total_joueurs'],
        'nombre_equipes' => $resultats_equipes['total_equipes'],
        'nombre_classements' => $resultats_classements['total_classements'],
        'nombre_tournois' => $resultats_tournois['total_tournois'],
        'moyenne_participants_par_tournoi' => $resultats_moyenne_participants['moyenne_participants_par_tournoi'],
        'phases_utilisateur' => $resultats_phases_utilisateur,
        'nombre_equipes_premieres' => $resultats_equipes_premieres['nombre_equipes'],
        'moyenne_participants_trois_dernieres_annees' => $resultats_moyenne_participants_trois_dernieres_annees['moyenne_participants'],
        'top_joueurs_nationaux' => $resultats_top_joueurs_nationaux,
        'nb_parties_par_taille_plateau' => $resultats_nb_parties_par_taille_plateau,
        'top_joueurs' => $resultats_top_joueurs
   
    );
}



////////////////////////////////////////////////////////////////////////
///////    Informations (structure et contenu) d'une table    //////////
////////////////////////////////////////////////////////////////////////

/**
 *  Retourne le détail des infos sur une table
 * */
function get_infos( $typeVue, $nomTable ) {
	global $connexion;

	switch ( $typeVue) {
		case 'schema': return get_infos_schema( $nomTable ); break;
		case 'data': return get_infos_instances( $nomTable ); break;
		default: return null; 
	}
}

/**
 * Retourne le détail sur le schéma de la table
*/
function get_infos_schema( $nomTable ) {
	global $connexion;

	// récupération des informations sur la table (schema + instance)
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);

	// construction du schéma qui sera composé du nom de l'attribut et de son type	
	$schema = array( array( 'nom' => 'nom_attribut' ), array( 'nom' => 'type_attribut' ) , array('nom' => 'clé')) ;

	// récupération des valeurs associées au nom et au type des attributs
	$metadonnees = mysqli_fetch_fields($res);

	$infos_att = array();
	foreach( $metadonnees as $att ){
		//var_dump($att);

 		$is_in_pk = ($att->flags & MYSQLI_PRI_KEY_FLAG)?'PK':'';
 		$type = convertir_type($att->{'type'});

		array_push( $infos_att , array( 'nom' => $att->{'name'}, 'type' => $type , 'cle' => $is_in_pk) );	
	}

	return array('schema'=> $schema , 'instances'=> $infos_att);

}

/**
 * Retourne les instances de la table
*/
function get_infos_instances( $nomTable ) {
	global $connexion;

	// récupération des informations sur la table (schema + instance)
	$requete = "SELECT * FROM $nomTable";  
 	$res = mysqli_query($connexion, $requete);  

 	// extraction des informations sur le schéma à partir du résultat précédent
	$infos_atts = mysqli_fetch_fields($res); 

	// filtrage des information du schéma pour ne garder que le nom de l'attribut
	$schema = array();
	foreach( $infos_atts as $att ){
		array_push( $schema , array( 'nom' => $att->{'name'} ) ); // syntaxe objet permettant de récupérer la propriété 'name' du de l'objet descriptif de l'attribut courant
	}

	// récupération des données (instances) de la table
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);

	// renvoi d'un tableau contenant les informations sur le schéma (nom d'attribut) et les n-uplets
	return array('schema'=> $schema , 'instances'=> $instances);

}


function convertir_type( $code ){
	switch( $code ){
		case 1 : return 'BOOL/TINYINT';
		case 2 : return 'SMALLINT';
		case 3 : return 'INTEGER';
		case 4 : return 'FLOAT';
		case 5 : return 'DOUBLE';
		case 7 : return 'TIMESTAMP';
		case 8 : return 'BIGINT/SERIAL';
		case 9 : return 'MEDIUMINT';
		case 10 : return 'DATE';
		case 11 : return 'TIME';
		case 12 : return 'DATETIME';
		case 13 : return 'YEAR';
		case 16 : return 'BIT';
		case 246 : return 'DECIMAL/NUMERIC/FIXED';
		case 252 : return 'BLOB/TEXT';
		case 253 : return 'VARCHAR/VARBINARY';
		case 254 : return 'CHAR/SET/ENUM/BINARY';
		default : return '?';
	}

}

////////////////////////////////////////////////////////////////////////
///////    Traitement de requêtes                             //////////
////////////////////////////////////////////////////////////////////////

/**
 * Retourne le résultat (schéma et instances) de la requ$ete $requete
 * */
function getInstances($connexion, $nomTable) {
    $requete = "SELECT * FROM " . mysqli_real_escape_string($connexion, $nomTable);
    $res = mysqli_query($connexion, $requete);

    // Vérifiez si la requête est exécutée correctement
    if (!$res) {
        die("Erreur d'exécution de la requête : " . mysqli_error($connexion));
    }

    // Récupérer les résultats
    $instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $instances;
}


function getIstances($connexion, $idPartie ,$Date_D,$heure_D){
    $Tab = array();
	$requete = "SELECT `$idPartie`, `$Date_D`, `$heure_D` FROM Partie";
    $prepare = mysqli_query($connexion, $requete);
    while($row=mysqli_fetch_assoc($prepare))
    {
		$Tab[] = [
            'idPartie' => $row[$idPartie],
            'Date_D' => $row[$Date_D],
            'heure_D' => $row[$heure_D]
			
        ];

    }
    return $Tab;
}


	
 function executer_une_requete( $requete ) {
	
	//TODO

	return null;
}

?>
