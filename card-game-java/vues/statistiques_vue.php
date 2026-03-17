<div class="panneau">
  <div>  <!-- Bloc permettant d'afficher les statistiques -->
    <h2>Statistiques de la base</h2>
    <?php if( $message != "" ) { ?>
      <p class="notification"><?= $message ?></p>
    <?php } else { ?>
      <table class="table_resultat">
        <thead>
          <tr><th>Propriété</th><th>Valeur</th></tr>
        </thead>
        <tbody>
          <tr><td>Nombre de tables</td><td><?= $stats['nombre_tables'] ?></td></tr>
          <tr><td>Nombre de tuples</td><td><?= $stats['nombre_nuplets'] ?></td></tr>
          <!-- Nouvelles fonctionnalités -->
          <tr><td>Nombre de joueurs</td><td><?= $stats['nombre_joueurs'] ?></td></tr>
          <tr><td>Nombre d'équipes</td><td><?= $stats['nombre_equipes'] ?></td></tr>
          <tr><td>Nombre de classements</td><td><?= $stats['nombre_classements'] ?></td></tr>
          <tr><td>Nombre de tournois</td><td><?= $stats['nombre_tournois'] ?></td></tr>
          <tr><td>Moyenne des participants par tournoi</td><td><?= $stats['moyenne_participants_par_tournoi'] ?></td></tr>
          <tr><td>Phases de tournoi jouées par l'utilisateur courant</td><td>
            <ul>
              <?php foreach ($stats['phases_utilisateur'] as $phase) { ?>
                <li><?= $phase['nom_tournoi'] ?> (<?= $phase['annee_tournoi'] ?>) - niveau: <?= $phase['niveau_phase'] ?></li>
              <?php } ?>
            </ul>
          </td></tr>
          <tr><td>Nombre d'équipes classées premières</td><td><?= $stats['nombre_equipes_premieres'] ?></td></tr>
          <tr><td>Moyenne des participants par tournoi (trois dernières années)</td><td><?= $stats['moyenne_participants_trois_dernieres_annees'] ?></td></tr>
          <tr><td>Top joueurs nationaux</td><td>
            <ol>
              <?php foreach ($stats['top_joueurs_nationaux'] as $Joueur) { ?>
                <li><?= $Joueur['nom'] ?> <?= $Joueur['prenom'] ?></li>
              <?php } ?>
            </ol>
          </td></tr>
          <tr><td>Nombre de parties par taille de plateau</td><td>
<ul>
    <?php foreach ($stats['nb_parties_par_taille_plateau'] as $taille => $nb_parties) { ?>
        <li>Taille <?= $taille ?>: <?= is_array($nb_parties) ? '0' : $nb_parties ?></li>
    <?php } ?>
</ul>
          </td></tr>
          <tr><td>Top 5 des joueurs qui ont joué le plus de parties</td><td>
            <ol>
              <?php foreach ($stats['top_joueurs'] as $Joueur) { ?>
                <li><?= $Joueur['pseudo'] ?> (<?= $Joueur['nb_parties_jouees'] ?> parties)</li>
              <?php } ?>
            </ol>
          </td></tr>
        </tbody>
      </table>
    <?php }?>
  </div>
</div>