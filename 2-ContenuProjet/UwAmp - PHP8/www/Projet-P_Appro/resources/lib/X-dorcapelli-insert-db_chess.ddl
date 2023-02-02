-- Auteur: Dorian Capelli
-- Date: 01.02.2023
-- Description:

USE db_chess;

DROP USER IF EXISTS 'chess'@'%';

CREATE USER 'chess'@'%' IDENTIFIED BY 'chess';

GRANT ALL PRIVILEGES  ON db_chess.* TO 'chess'@'%';

INSERT INTO t_title (titName)
	VALUES ("Maitre"),
		   ("Grand Maitre");

INSERT INTO t_team (idTeam)
	VALUES (1),
		   (2),
		   (3);

INSERT INTO t_category (catName)
	VALUES ("Vétéran"),
		   ("Novice"),
		   ("U20"),
		   ("U18"),
		   ("U16"),
		   ("U14"),
		   ("U12"),
		   ("U10"),
		   ("U8");

INSERT INTO t_member (memLastName, memFirstName, memDateBirth, memPhoneNumber, memLicencing, memRanking, fkTitle, fkCategory)
	VALUES ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "ABCDEFGHIJK", 1500, 1, 1);

INSERT INTO t_play (fkMember, fkTeam, IsCaptain)
	VALUES (1, 2, True),
		   (2, 1, False);

INSERT INTO t_user (useName, usePassword)
	VALUES ("admin", "$2y$10$PkJAgwnXwzmIbHSO9310T.GDh2janmPqBYcrEQGnGdCSL5hUyhvXK");