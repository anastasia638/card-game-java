<?php
$message = "";

// récupération des statistiques
$stats = get_statistiques();

if($stats == null || count($stats) == 0) {
    $message .= "Aucune statistique n'est disponible!";
} else {
    // Affichage des statistiques
    $nombre_tables = $stats['nombre_tables'] ?? 'N/A';
    $nombre_nuplets = $stats['nombre_nuplets'] ?? 'N/A';
    $nombre_joueurs = $stats['nombre_joueurs'] ?? 'N/A';
    $nombre_equipes = $stats['nombre_equipes'] ?? 'N/A';
    $nombre_classements = $stats['nombre_classements'] ?? 'N/A';
    $nombre_tournois = $stats['nombre_tournois'] ?? 'N/A';
    $moyenne_participants_par_tournoi= $stats['moyenne_participants_par_tournoi'] ?? 'N/A';

    // Nouvelles statistiques
    $phases_utilisateur = $stats['phases_utilisateur'] ?? [];
    $nombre_equipes_premieres = $stats['nombre_equipes_premieres'] ?? 'N/A';
    $moyenne_participants_trois_dernieres_annees = $stats['moyenne_participants_trois_dernieres_annees'] ?? 'N/A';
    $top_joueurs_nationaux = $stats['top_joueurs_nationaux'] ?? [];
    $nb_parties_par_taille_plateau = $stats['nb_parties_par_taille_plateau'] ?? [];
    $top_joueurs = $stats['top_joueurs'] ?? [];
}
?>