CREATE DATABASE FNESITE;

USE FNESITE;



/* ASSOCIATION */
CREATE TABLE ASSOCIATION (
    ID              INT AUTO_INCREMENT PRIMARY KEY,
    NAME            VARCHAR(100),
    TERRITORY_ID    INT NOT NULL,
    
    CONSTRAINT FK_ASSOTERRITORY FOREIGN KEY (TERRITORY_ID) REFERENCES TERRITORY(ID)
);

/* UTILISATEURS */
CREATE TABLE USER   (
	ID                  INT AUTO_INCREMENT PRIMARY KEY,
	LOGIN               VARCHAR(50) NOT NULL,
	PASSWORD            VARCHAR(100) NOT NULL,
	ASSOCIATION_ID      INT NOT NULL,
	THEME_ID            INT ,
	THEME_INTEREST_ID   INT ,
	THEME_DETAILS       VARCHAR(250),
	ROLE                VARCHAR(50) NOT NULL,
	NAME                VARCHAR(100) NOT NULL,
    SURNAME             VARCHAR(100) NOT NULL,
    MAIL                VARCHAR(100) NOT NULL,
    ADRESS              VARCHAR(250) NOT NULL,
    CP                  INT NOT NULL,
    PROFESSION          VARCHAR(50) NOT NULL,
    PROFESSION2         VARCHAR(50),
    PRESENTATION        BLOB,
    PHOTOPATH           VARCHAR(50),


    CONSTRAINT FK_USER_THEME FOREIGN KEY (THEME_ID) REFERENCES THEME(ID),
    CONSTRAINT FK_USER_THEMEINT FOREIGN KEY (THEME_INTEREST_ID) REFERENCES THEME(ID),
    CONSTRAINT FK_USER_ASSOCID FOREIGN KEY (ASSOCIATION_ID) REFERENCES ASSOCIATION(ID)
);



/* THEMATIQUES (EAU, SANTE, ETC...) */
CREATE TABLE THEME   (
    ID          INT AUTO_INCREMENT PRIMARY KEY,
    NAME        VARCHAR(100) NOT NULL
);

/* TERRITORY (ETANG DE TRUC, ETC...) */ 
CREATE TABLE TERRITORY   (
    ID          INT AUTO_INCREMENT PRIMARY KEY,
    NAME        VARCHAR(100) NOT NULL
);


/* MESSAGES PRIVES STOCKES */
CREATE TABLE MESSAGES  (
    ID          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    SENDER_ID       INT NOT NULL,
    RECEIVER_ID     INT NOT NULL,
    TITLE           VARCHAR(150) NOT NULL,
    CONTENT         BLOB NOT NULL,
    
    CONSTRAINT FK_MESSAGE_SENDER FOREIGN KEY (SENDER_ID) REFERENCES USER(USER_ID),
    CONSTRAINT FK_MESSAGE_RECEIVER FOREIGN KEY (RECEIVER_ID) REFERENCES USER(USER_ID)
);


/* ARTICLES STOCKES */
CREATE TABLE POST (
    ID          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    WRITER_ID   INT NOT NULL,
    TITLE       VARCHAR(150) NOT NULL,
    DESCRIPTION VARCHAR(200),
    PDATE       DATE NOT NULL,
    DURATION    INT,
    CONTENT     LONGTEXT,
    STATUS      INT,       
    IMAGEPATH   VARCHAR(150),
    
    CONSTRAINT FK_POSTWRITER FOREIGN KEY (WRITER) REFERENCES USER(USER_ID)
);


/* RAPPORTS D'ACTIONS */
CREATE TABLE REPORT (
    ID      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    RDATE   DATE NOT NULL,
    TYPE    INT,
    CONTENT VARCHAR(300)
);


/* NEWSLETTERS */
CREATE TABLE NEWSLETTER (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NLDATE DATE NOT NULL,
    CONTENT LONGTEXT,
    PATH VARCHAR(200)
);


/* DONNEES */
/* Thématiques (8) */
INSERT INTO THEME (NAME) VALUES ('Transports');
INSERT INTO THEME (NAME) VALUES ('Mission Juridique');
INSERT INTO THEME (NAME) VALUES ('Climat, Air, Energie');
INSERT INTO THEME (NAME) VALUES ('Santé Environnement');
INSERT INTO THEME (NAME) VALUES ('Aménagement durable du territoire');
INSERT INTO THEME (NAME) VALUES ('Industrie');
INSERT INTO THEME (NAME) VALUES ('Eau et milieux naturels');
INSERT INTO THEME (NAME) VALUES ('Agriculture');

/* Territoires (5) */
INSERT INTO TERRITORY (NAME) VALUES ('Vallée du Rhône');
INSERT INTO TERRITORY (NAME) VALUES ('Vallée de l\'Huveaune');
INSERT INTO TERRITORY (NAME) VALUES ('Les Alpilles');
INSERT INTO TERRITORY (NAME) VALUES ('Etang de Berre, Fos-sur-Mer');
INSERT INTO TERRITORY (NAME) VALUES ('Métropole Marseille');


/* JEU DE TEST */

/* ASSO 1 - Nom - FNE13 */
/* ASSO 2 - Nom - TrucAsso */
/* ASSO 3 - Nom - MachinAsso */
/* ASSO 4 - Nom - BiduleAsso */
INSERT INTO ASSOCIATION(NAME) VALUES ('FNE13');
INSERT INTO ASSOCIATION(NAME) VALUES ('TrucAsso');
INSERT INTO ASSOCIATION(NAME) VALUES ('MachinAsso');
INSERT INTO ASSOCIATION(NAME) VALUES ('BiduleAsso');

/* USER 1 - Nicolas Damien (rôle SADMIN dans la FNE13) */
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('nicolas.damien','mdp',1,NULL,NULL,NULL,'SADMIN','Damien','Nicolas','nicolas.damien@truc.fr','33 Somewhere over the rainbow','69696','Chef Suprême',NULL,'Coucou ! Tu veux voir ma FNE ?','../Photos/nicdam.png');

/* USER 2 - Huguette1 Lavieille1 (role MEMBRE dans TrucAsso, spécialiste Santé, intéressée Agriculture) */ 
/* USER 3 - Huguette2 Lavieille2 (role MEMBRE dans MachinAsso, intéressée Transports) */ 
/* USER 4 - Huguette3 Lavieille3 (role VALIDATOR dans BiduleAsso,intéressée Industrie) */
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('huguette1','mdp',2, 4, 8, 'Infirmerie','MEMBRE','Lavieille1','Huguette1','huguette1@machin.com','11 Highway to hell','16666','Gogo-danseuse','Retraitée','Bonjour tout le monde. Signé : Huguette1','../Photos/huguette1.png');
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('huguette2','mdp',3, NULL, 1,NULL,'MEMBRE','Lavieille2','Huguette2','huguette2@machin.com','22 Highway to hell','26666','Pole-danseuse','Retraitée','Bonjour tout le monde. Signé : Huguette2','../Photos/huguette2.png');
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('huguette3','mdp',4,NULL,6,NULL,'VALIDATOR','Lavieille3','Huguette3','huguette3@machin.com','33 Highway to hell','36666','Strip-teaseuse','Retraitée','Bonjour tout le monde. Signé : Huguette3','../Photos/huguette3.png');

/* USER 5 - Francis1 Lotre1 (role ADMIN dans TrucAsso, specialiste Eau, intéressé Santé) */
/* USER 6 - Francis2 Lotre2 (role ADMIN dans MachinAsson, specialiste Agriculture, intéressé Transports) */
/* USER 7 - Francis3 Lotre3 (role ADMIN dans BiduleAsso, intéressé Santé) */
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('francis1','mdp',2, 7, 4,'Barrages hydroliques','ADMIN','Lotre1','Francis1','francis1@truc.fr','01 Quelque part','19000','Ingénieur Eau',NULL,'...1','../Photos/francis1.png'); 
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('francis2','mdp',3, 8, 1,'Plantations','ADMIN','Lotre2','Francis2','francis2@truc.fr','02 Quelque part','29000','Ingénieur Terre',NULL,'...2','../Photos/francis2.png'); 
INSERT INTO USER (LOGIN, PASSWORD, ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, THEME_DETAILS, ROLE, NAME, SURNAME, MAIL, ADRESS, CP, PROFESSION, PROFESSION2, PRESENTATION, PHOTOPATH) 
          VALUES ('francis3','mdp',4, NULL,4,NULL,'ADMIN','Lotre3','Francis3','francis3@truc.fr','03 Quelque part','39000','Ingénieur Air',NULL,'...3','../Photos/francis3.png'); 

/* ASSO 2 -> Thème Eau  */
/* ASSO 3 -> Thème Agriculture  */
/* ASSO 4 -> Thème Aménagement durable du territoire  */

