-------------------------------------p2308249-p2313257----------------------------------------------------------------------
-----------------------------------------BDW-----Project-----Debiclou Race----------------------------------------------------------------------------


----------------------Remplissage des tables-----------------------------
----------------------les requetes -------------------------------------







----------------------------1/coté de tournoi ---------------------------------------------------------------------------------------------------------
---Classement_équipe--------------------------------------------------------------------------------------------------------------------
INSERT INTO `Classement_equipe` (`idClassement`, `idEquipe`, `rang`) VALUES
(3, 1, '3'),
(3, 2, '2'),
(3, 3, '1');
--------------------------------------------------------------------------------------------------------------------------------------
------------------------------Classement_individuel----------------------------------------------------------------------------------
INSERT INTO `Classement_individuel` (`idClassement`, `idJoueur`, `rang`) VALUES
(1, 4, '3'),
(1, 6, '2'),
(1, 7, '1'),
(2, 5, '3'),
(2, 8, '2'),
(2, 10, '1'),
(4, 5, '3'),
(4, 6, '2'),
(4, 7, '1'),
(5, 3, '2'),
(5, 9, '1'),
(5, 10, '3');
----------------------------------------------------------------------------------------------------------------------------------------

-----------------------------Equipe-------------------------------------------------------------------------------------------------------
INSERT INTO `Equipe` (`idEquipe`, `nom`) VALUES
(1, 'Les pédaleurs fous'),
(2, 'Les 42 du cyclos'),
(3, 'Les sans freins'),
(4, 'Les hazardicycles');
-----------------------------------------------------------------------------------------------------------------------------------------

------------------Classement -------------------------------------------------------------------------------------------------------------------------
INSERT INTO `Classement` (`idClassement`, `nom`, `portee`) VALUES
(1, 'Classement ACP', 'internationale'),
(2, 'Classement Français des DicyclerRaces', 'nationale'),
(3, 'Classement ACEEP', 'internationale'),
(4, 'Classement Belge des DicyclerRaces', 'nationale'),
(5, 'Classement Auvergnats des DicyclerRaces', 'régionale');
----------------------------------------------------------------------------------------------------------------------------------------

-----------tournoi-----------------------------------------------------------------------------------------------------------
INSERT INTO `Tournoi` (`idTournoi`, `nom`, `date_D`, `date_F`) VALUES
(1, 'DicyRace', '2024-01-15', '2024-01-30'),
(2, 'DicyMasterRace', '2024-02-15', '2024-02-29'),
(3, 'Masters of DicyRace', '2024-03-15', '2024-03-30'),

(4, 'DyRacer Masters', '2023-04-15', '2023-04-30'),
(5, 'DyRacerCompet', '2023-04-15', '2023-04-30');
----------------------------------------------------------------------------------------------------------------------------------------

--------------2/ Coté Partie------------------------------------------------------------------------------------------------



-------------------------Joueur---------------------------------------------------------------------------------------------------------
INSERT INTO `joueur` (`idJoueur`, `nom`, `prénom`, `pseudo`, `date_naiss`, `email`, `id_équipe`) VALUES
(1, 'ATOUTALURE', 'Alphonse', 'AA99', '1999-06-12', NULL, 1),
(2, 'AVITE', 'Yves', 'YA01', '2001-12-06', NULL, 1),
(3, 'HERE', 'Axel', 'AH02', '2002-02-04', NULL, 1),
(4, 'LENTI', 'Sarah', 'SL98', '1998-05-11', NULL, 2),
(5, 'BAUL', 'Pat', 'PB01', '2001-10-06', NULL, 2),
(6, 'DESFREINS', 'Ella', 'ED00', '2000-05-05', NULL, 2),
(7, 'RALENTI', 'Sam', 'SR99', '1999-07-07', NULL, NULL),
(8, 'PARTIR', 'Eva', 'EP97', '1997-09-21', NULL, NULL),
(9, 'HERE', 'Axel', 'AH00', '2000-09-09', NULL, NULL),
(10, 'NAUBERDEAU', 'René-Jean', 'RJN', '1956-07-08', NULL, NULL);
---------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------Participe-----------------------------------------------------------------------------------------------
INSERT INTO `Participe` (`idTournoi`, `Niveau`, `idJoueur`, `a_joué`, `est_qualifié`) VALUES
(1, 'Demi-finale', 1, '1', '1'),
(1, 'Demi-finale', 4, '1', '1'),
(1, 'Finale', 1, '1', '0'),
(1, 'Finale', 4, '1', '1'),
(1, 'Quart de finale', 1, '1', '1'),
(1, 'Quart de finale', 2, '1', '0'),
(1, 'Quart de finale', 3, '1', '0'),
(1, 'Quart de finale', 4, '1', '1'),
(2, 'Finale', 5, '1', '0'),
(2, 'Finale', 6, '1', '1'),
(3, 'Finale', 7, '1', '0'),
(3, 'Finale', 8, '1', '1'),
(4, 'Demi-finale', 2, '1', '1'),
(4, 'Demi-finale', 10, '1', '1'),
(4, 'Finale', 2, '1', '0'),
(4, 'Finale', 10, '1', '1'),
(4, 'Quart de finale', 2, '1', '1'),
(4, 'Quart de finale', 5, '1', '0'),
(4, 'Quart de finale', 9, '1', '0'),
(4, 'Quart de finale', 10, '1', '1');
--------------------------------------------------------------------------------------------------------------------------------------
-------------------------------Phase---------------------------------------------------------------------------------------------------
INSERT INTO `Phase` (`idTournoi`, `Niveau`, `DateP`) VALUES
(1, 'Demi-finale', '2024-01-25'),
(2, 'Demi-finale', '2024-02-25'),
(3, 'Demi-finale', '2024-03-25'),
(4, 'Demi-finale', '2023-04-25'),
(5, 'Demi-finale', '2022-04-25'),
(1, 'Finale', '2024-01-30'),
(2, 'Finale', '2024-02-29'),
(3, 'Finale', '2024-03-30'),
(4, 'Finale', '2023-04-30'),
(5, 'Finale', '2022-04-30'),
(1, 'Huitième de finale', '2024-01-21'),
(2, 'Huitième de finale', '2024-02-21'),
(3, 'Huitième de finale', '2024-03-21'),
(4, 'Huitième de finale', '2023-04-21'),
(5, 'Huitième de finale', '2022-04-21'),
(1, 'Quart', '2024-01-20'),
(2, 'Quart', '2024-02-20'),
(3, 'Quart', '2024-03-20'),
(4, 'Quart', '2023-04-20'),
(5, 'Quart', '2022-04-20'),
(1, 'Quart de finale', '2024-01-22'),
(2, 'Quart de finale', '2024-02-22'),
(3, 'Quart de finale', '2024-03-22'),
(4, 'Quart de finale', '2023-04-22'),
(5, 'Quart de finale', '2022-04-22'),
(1, 'Sélection', '2024-01-15'),
(2, 'Sélection', '2024-02-15'),
(3, 'Sélection', '2024-03-15'),
(4, 'Sélection', '2023-04-15'),
(5, 'Sélection', '2022-04-15');

--------------------------------------------------------------------------------------------------------------------------------------
-------- carte ----------------------------
INSERT INTO carte (IdCarte,image,niveau,points)
Select DISTINCT 
id_carte ,
image,
niveau,
points,
FROM instances2;
--------------------------------------------------------------------------------------------------------------------------------------







---------------------------------Pour remplir les contraintes----------------------------------------------------------------------------
INSERT INTO Les_memes_aux_choix (idContrainte,nom,valeur,couleur)
SELECT INDISTINCT
    id_contrainte,
    nom,
    couleur,
    valeur
FROM instances2
WHERE nom ='meme_au_choix';
---------------------------------------------------------------------------------------------------------------------------------------------
------------Pour remplir Dé_lancé---------------------------------------------------------------------------------------------------------
INSERT INTO Dé_lancé (rang_couleur_valeur)
SELECT CONCAT_WS('_', numL, 'J', dé1) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'B', dé1) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'R', dé1) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'J', dé2) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'B', dé2) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'R', dé2) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'J', dé3) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'B', dé3) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'R', dé3) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'J', dé4) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'B', dé4) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'R', dé4) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'J', dé5) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'B', dé5) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'R', dé5) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'J', dé6) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'B', dé6) AS rang_couleur_valeur FROM instances3
UNION
SELECT CONCAT_WS('_', numL, 'R', dé6) AS rang_couleur_valeur FROM instances3;
-----------------------------------------------------------------------------------------------------------------------------------
-----------------------------------Tente de validation---------------------------------------------------------------------------------------
INSERT INTO tente_de_validation (idJoueur, idCarte, NumT, nb_tentatives)
SELECT
    i3.id_joueur,
    i2.id_carte,
    i3.numTour,
    i3.carteAvalider
FROM
    instances3 AS i3
JOIN
    instances2 AS i2 ON i3.carteAvalider = i2.id_carte;
----------------------------------------------------------------------------------------------------------------------------------------









-----------------pour remplir ETat : 
-- Mise à jour de l'état des parties à venir
UPDATE Partie SET etat = 'À venir' WHERE ADDTIME(Date_D, SEC_TO_TIME(duree)) > NOW();

-- Mise à jour de l'état des parties en cours
UPDATE Partie SET etat = 'En cours' WHERE Date_D < NOW() AND ADDTIME(Date_D, SEC_TO_TIME(duree)) > NOW();

-- Mise à jour de l'état des parties terminées
UPDATE Partie SET etat = 'Terminée' WHERE ADDTIME(Date_D, SEC_TO_TIME(duree)) <= NOW();
----------------------------------------------------------------------------------------------------------------------------------------------







-------------------- table joueur---------------------------------------------------------------------------------------
INSERT INTO Joueur (idJoueur, nom, prenom, datenaiss, pseudo, mail, idEquipe)
SELECT id_joueur, nom, prénom, date_naiss, pseudo, email, 
       CASE 
        WHEN équipe IS NOT NULL THEN ASCII(équipe)
        ELSE NULL
       END AS idEquipe
    FROM instances1
GROUP BY id_joueur
ORDER BY équipe ASC;
------Afficher nombre de lignes sans doublons pour-------------------------------------------------------------------------------------------
SELECT COUNT(*) AS total_rows FROM Joueur;==59 (sans doublons peut etre) 
----on peut checker sur table instances1 si on veut : lignes sans doublons 
SELECT COUNT(DISTINCT nom) AS total_distinct_rows FROM instances1;=57
SELECT COUNT(DISTINCT nom) AS total_distinct_rows FROM instances1;=57
--------------------------------------------------------------------
SELECT COUNT(DISTINCT pseudo) AS total_distinct_rows FROM instances1;=59
SELECT COUNT(DISTINCT pseudo) AS total_distinct_rows FROM joueur;=59
----------------------------------------------------------------------------------------------------------------------------------------------

---------------pour remplir PLATEAU------------------------------------
INSERT INTO plateau (taille)
SELECT taille
FROM instances1;
----------------------------------------------------------------------------------------------------------------------------------------------














--------------remplir Partie-----------------------------------------------------------
INSERT IGNORE INTO Partie (idPlateau, Date_D, heure_D, Date_F, heure_F, etat)
SELECT 
    (SELECT idPlateau FROM Plateau 
    HeureP AS heure_D,
    DateF AS Date_F,
    heure_F AS heure_f,
    etat )
FROM instances1;
------------------------------------------------------------------------------------------------------

-------------------------------fin---------------------------------------------------------------------------------------------------------------




