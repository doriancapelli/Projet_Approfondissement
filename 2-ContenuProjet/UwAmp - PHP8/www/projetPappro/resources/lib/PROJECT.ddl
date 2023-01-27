-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Jan 27 16:19:06 2023 
-- * LUN file: D:\Projet_Approfondissement\2-ContenuProjet\UwAmp - PHP8\www\projetPappro\resources\lib\PROJECT.lun 
-- * Schema: MLD/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database MLD;
use MLD;


-- Tables Section
-- _____________ 

create table t_user (
     idUser -- Compound attribute -- not null,
     useName char(10) not null,
     usePassword varchar(255) not null,
     constraint ID_t_user_ID primary key (idUser -- Compound attribute --));

create table t_member (
     idMember int not null auto_increment,
     memLastName varchar(25) not null,
     memFirstName varchar(50) not null,
     memDateBirth date not null,
     memPhoneNumber int not null,
     memLicencing int not null,
     memRanking int not null,
     idTitle int not null,
     idCategory int not null,
     constraint ID_t_member_ID primary key (idMember));

create table t_category (
     idCategory int not null auto_increment,
     catName varchar(10) not null,
     constraint ID_t_category_ID primary key (idCategory));

create table t_title (
     idTitle int not null auto_increment,
     titName varchar(25) not null,
     constraint ID_t_title_ID primary key (idTitle));

create table t_play (
     idMember int not null,
     IsCaptain char not null,
     idTeam int not null,
     constraint FKt_p_t_m_ID primary key (idMember));

create table t_team (
     idTeam int not null auto_increment,
     constraint ID_t_team_ID primary key (idTeam));


-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table t_member add constraint ID_t_member_CHK
--     check(exists(select * from t_play
--                  where t_play.idMember = idMember)); 

alter table t_member add constraint FKt_toAcquire_FK
     foreign key (idTitle)
     references t_title (idTitle);

alter table t_member add constraint FKt_toBelongTo_FK
     foreign key (idCategory)
     references t_category (idCategory);

alter table t_play add constraint FKt_p_t_t_FK
     foreign key (idTeam)
     references t_team (idTeam);

alter table t_play add constraint FKt_p_t_m_FK
     foreign key (idMember)
     references t_member (idMember);


-- Index Section
-- _____________ 

create unique index ID_t_user_IND
     on t_user (idUser -- Compound attribute --);

create unique index ID_t_member_IND
     on t_member (idMember);

create index FKt_toAcquire_IND
     on t_member (idTitle);

create index FKt_toBelongTo_IND
     on t_member (idCategory);

create unique index ID_t_category_IND
     on t_category (idCategory);

create unique index ID_t_title_IND
     on t_title (idTitle);

create index FKt_p_t_t_IND
     on t_play (idTeam);

create unique index FKt_p_t_m_IND
     on t_play (idMember);

create unique index ID_t_team_IND
     on t_team (idTeam);

