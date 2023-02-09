-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Jan 27 16:19:06 2023 
-- * LUN file: D:\Projet_Approfondissement\2-ContenuProjet\UwAmp - PHP8\www\projetPappro\resources\lib\PROJECT.lun 
-- * Schema: db_chess/1 
-- ********************************************* 
-- * Modify by Dorian Capelli

-- Database Section
-- ________________ 
DROP DATABASE IF EXISTS db_chess;
create database db_chess CHARACTER SET utf8;
use db_chess;


-- Tables Section
-- _____________ 

create table t_user (
     idUser INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     useName char(10) not null,
     usePassword varchar(255) not null);

create table t_category (
     idCategory INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     catName varchar(10) not null);

create table t_title (
     idTitle INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     titName varchar(30) not null);

create table t_member (
     idMember INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     memLastName varchar(50) not null,
     memFirstName varchar(50) not null,
     memDateBirth date not null,
     memPhoneNumber char(20) not null,
     memLicencing char(6),
     memRanking int,
     fkTitle int,
     fkCategory int not null,
     CONSTRAINT FKt_toAcquire_FK FOREIGN KEY (fkTitle) REFERENCES t_title (idTitle),
     CONSTRAINT FKt_toBelongTo_FK FOREIGN KEY (fkCategory) REFERENCES t_category (idCategory));

create table t_team (
     idTeam INT NOT NULL PRIMARY KEY);

create table t_play (
     fkMember INT NOT NULL,
     IsCaptain boolean not null,
     fkTeam int not null,
     CONSTRAINT ID_t_play_ID PRIMARY KEY (fkMember, fkTeam),
     CONSTRAINT FKt_lead_FK FOREIGN KEY (fkMember) REFERENCES t_member (idMember),
     CONSTRAINT FKt_team_FK FOREIGN KEY (fkTeam) REFERENCES t_team (idTeam));