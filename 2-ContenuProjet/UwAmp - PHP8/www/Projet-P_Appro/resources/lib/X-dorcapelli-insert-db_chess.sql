-- Auteur: Dorian Capelli
-- Date: 01.02.2023
-- Description: Script for insert data in db_chess

USE db_chess;

DROP USER IF EXISTS 'chess'@'%';

CREATE USER 'chess'@'%' IDENTIFIED BY 'chess';

GRANT ALL PRIVILEGES  ON db_chess.* TO 'chess'@'%';

INSERT INTO t_title (titName)
	VALUES ("Candidat Maitre"),
		   ("Maitre FIDE"),
		   ("Maitre International"),
		   ("Grand Maitre International");

INSERT INTO t_team (idTeam)
	VALUES (1),
		   (2),
		   (3);

INSERT INTO t_category (catName)
	VALUES ("Vétéran"),
		   ("Sénior"),
		   ("U20"),
		   ("U18"),
		   ("U16"),
		   ("U14"),
		   ("U12"),
		   ("U10"),
		   ("U8");

INSERT INTO t_member (memLastName, memFirstName, memDateBirth, memPhoneNumber, memLicencing, memRanking, fkTitle, fkCategory)
	VALUES ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1),
		   ("Philipona", "Sylvain", "2004-05-11","0791989200", "ABCDEF", 1200, 2, 2),
		   ("Duruz", "Sébastien", "1997-07-25", "0791989200", "JOCA", 1500, 1, 1);

INSERT INTO t_member (memLastName, memFirstName, memDateBirth, memPhoneNumber, memLicencing, memRanking,  fkCategory)
	VALUES ("Praz", "Nolan", "2004-05-11","0791989200", "ABCDEF", 1200, 5);

INSERT INTO t_play (fkMember, fkTeam, IsCaptain)
	VALUES (1, 2, True),
		   (2, 1, False),
		   (3, 1, False),
		   (4, 1, False),
		   (5, 1, False),
		   (6, 1, False),
		   (7, 1, False),
		   (8, 1, False),
		   (9, 1, False),
		   (10, 1, False),
		   (11, 1, False),
		   (12, 1, False),
		   (13, 1, False),
		   (14, 1, False),
		   (15, 1, False),
		   (16, 1, False),
		   (17, 1, False),
		   (18, 1, False),
		   (19, 1, False),
		   (20, 1, False),
		   (21, 1, False),
		   (22, 1, False),
		   (23, 1, False),
		   (24, 1, False),
		   (25, 1, False),
		   (26, 1, False),
		   (27, 1, False),
		   (28, 1, False),
		   (29, 1, False),
		   (30, 1, False),
		   (31, 1, False),
		   (32, 1, False),
		   (33, 1, False),
		   (34, 1, False),
		   (35, 1, False),
		   (36, 1, False),
		   (37, 1, False),
		   (38, 1, False),
		   (39, 1, False),
		   (40, 1, False),
		   (41, 1, False),
		   (42, 1, False),
		   (43, 1, False),
		   (44, 1, False),
		   (45, 1, False),
		   (46, 1, False),
		   (47, 1, False),
		   (48, 1, False),
		   (49, 1, False),
		   (50, 1, False),
		   (51, 1, False),
		   (52, 1, False),
		   (53, 1, False),
		   (54, 1, False),
		   (55, 1, False),
		   (56, 1, False),
		   (57, 1, False),
		   (58, 1, False),
		   (59, 1, False),
		   (60, 1, False);


INSERT INTO t_user (useName, usePassword)
	VALUES ("admin", "$2y$10$PkJAgwnXwzmIbHSO9310T.GDh2janmPqBYcrEQGnGdCSL5hUyhvXK");