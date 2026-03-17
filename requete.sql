

-------------------------------------p2308249-p2313257----------------------------------------------------------------------


-------------------------------------REQUETE STATIQUE SQL-----------------------------------------------------------------

--un n-uplet contenant le nombre de joueurs, le nombre d’équipes, le nombre de classements, le nombre de tournois et la moyenne des participants par tournoi
SELECT
    (SELECT COUNT(*) FROM Joueur) AS nombre_joueurs, 
    (SELECT COUNT(*) FROM Equipe) AS nombre_equipes,
    (SELECT COUNT(*) FROM Classement) AS nombre_classements,
    (SELECT COUNT(*) FROM Tournoi) AS nombre_tournois,
    (SELECT AVG(participants) FROM (SELECT COUNT(*) AS participants FROM Participe GROUP BY idTournoi) AS moyenne_participants_par_tournoi) AS moyenne_participants_par_tournoi;

--------------------------------------------------------------------------------------------------------------------------------------


--les phases de tournoi (nom et année de tournoi, niveau de phase) jouées et pour lesquelles s’est qualifié l’utilisateur courant. Le résultat sera trié sur les années selon l’ordre antéchronologique puis sur les niveaux de phase selon l’ordre lexicographique inverse ------------------------------------------------------------------------
SELECT t.nom AS nom_tournoi, YEAR(t.Date_D) AS annee_tournoi, p.Niveau AS niveau_phase
FROM Phase p
JOIN Tournoi t ON p.idTournoi = t.idTournoi
WHERE p.idTournoi = (SELECT idTournoi FROM Tournoi WHERE nom = 'DicyRace') //// this exemple of the current player of this game

ORDER BY YEAR(t.Date_D) DESC, p.Niveau DESC;
---------------------------------------------------------------------------------------------------------------------------------------------------7


--"le nombre d’équipes classées premières des classements et dont aucun des membres n’est premier dans un classement individue--------------------------------------------------------------------------------------------------------
SELECT COUNT(*) AS nombre_equipes
FROM (
    SELECT Equipe.IDEquipe
    FROM Equipe
    JOIN Classement_equipe ce ON Equipe.IDEquipe = ce.IDEquipe
    WHERE ce.rang = 1
    AND NOT EXISTS (
        SELECT *
        FROM Joueur
        JOIN Classement_individuel ci ON Joueur.IDJoueur = ci.IDJoueur
        WHERE ci.rang = 1 AND Equipe.IDEquipe = Joueur.IDEquipe
    )
) AS sous_requete;

----------------------------------------------------------------------------------------------------------------------------------


--Pour les 3 dernières années, donner le nombre moyen de participants aux tournois------------------------------------------------------------------
SELECT AVG(nb_participants) AS moyenne_participants
FROM (
    SELECT COUNT(*) AS nb_participants
    FROM Participe
    JOIN Tournoi ON Participe.idTournoi = Tournoi.idTournoi
    WHERE YEAR(Tournoi.Date_D) >= YEAR(CURDATE()) - 2
    GROUP BY Tournoi.idTournoi
) AS subquery;
----------------------------------------------------------------------------------------------------------------------------------


--Donner  le nom et le prénom des joueurs classés de manière individuelle dans le top 5 d’au moins 2 classements de portée nationale----------------------------------------------------------------------------------------------
SELECT nom, prenom
FROM Joueur
WHERE idJoueur IN (
    SELECT ci.idJoueur
    FROM Classement c
    INNER JOIN Classement_individuel ci ON c.idClassement = ci.idClassement
    WHERE c.portee = 'nationale'
    GROUP BY ci.idJoueur
    HAVING COUNT(*) >= 2 AND MAX(ci.rang) <= 5
);
----------------------------------------------------------------------------------------------------------------------------------


---"Pour chaque taille de plateau, donner le nombre de parties jouées avec un plateau de cette taille --------------------------
SELECT Plateau.taille, COUNT(Partie.IDPartie) AS nombre_parties_jouees

FROM Plateau

INNER JOIN Partie ON Plateau.IDPlateau = Partie.IDPlateau

GROUP BY Plateau.taille;
----------------------------------------------------------------------------------------------------------------------------------


---Le top 5 des joueurs (pseudo) qui ont joué le plus de parties"-------------------------------------------------------------------------------------------------------------------------------

SELECT Joueur.pseudo, COUNT(joue.IDPartie) AS nombre_parties

FROM Joueur

INNER JOIN joue ON Joueur.IDJoueur = joue.IDJoueur

GROUP BY Joueur.IDJoueur

ORDER BY nombre_parties DESC

LIMIT 5;
----------------------------------------------------------------------------------------------------------------------------------