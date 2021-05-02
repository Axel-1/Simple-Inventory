DROP DATABASE IF EXISTS SimpleInventory;
CREATE DATABASE SimpleInventory;
USE SimpleInventory;

create table Supervision
(
    ID_supervision    int auto_increment
        primary key,
    IP                varchar(50) null,
    Date_dernier_ping datetime    null
);

create table Site
(
    ID_site        int auto_increment
        primary key,
    Nom_site       varchar(50)  null,
    Adresse        varchar(100) null,
    CP             varchar(10)  null,
    Ville          varchar(50)  null,
    ID_supervision int          null,
    constraint Site_Supervision_ID_supervision_fk
        foreign key (ID_supervision) references Supervision (ID_supervision)
);

create table Produit
(
    ID_produit      int auto_increment
        primary key,
    Nom_produit     varchar(100) null,
    Fabricant       varchar(50)  null,
    Num_modele      varchar(100) null,
    Num_serie       varchar(100) null,
    Date_achat      date         null,
    Chemin_facture  varchar(150) null,
    Nom_hote        varchar(50)  null,
    Date_expiration date         null,
    ID_supervision  int          null,
    Type            varchar(1)   null,
    ID_site         int          null,
    constraint Produit_Site_ID_site_fk
        foreign key (ID_site) references Site (ID_site)
            on delete cascade,
    constraint Produit_Supervision_ID_supervision_fk
        foreign key (ID_supervision) references Supervision (ID_supervision)
            on delete set null
);

create table Garantie
(
    ID_garantie     int auto_increment
        primary key,
    Nom_garantie    varchar(50) null,
    Date_expiration date        null,
    ID_produit      int         null,
    constraint FK_ProduitGarantie
        foreign key (ID_produit) references Produit (ID_produit)
            on delete cascade
);

DELIMITER $$
CREATE TRIGGER reverse_cascade_Produit_Supervision
    AFTER DELETE ON `Produit`
    FOR EACH ROW
BEGIN
    DELETE FROM `Supervision` WHERE ID_supervision = old.ID_supervision;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER reverse_cascade_Site_Supervision
    AFTER DELETE ON `Site`
    FOR EACH ROW
BEGIN
    DELETE FROM `Supervision` WHERE ID_supervision = old.ID_supervision;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER reverse_cascade_Site_ProduitSupervision
    AFTER DELETE ON `Site`
    FOR EACH ROW
BEGIN
    DELETE FROM Supervision WHERE (ID_supervision NOT IN (SELECT ID_supervision FROM Produit WHERE ID_supervision IS NOT NULL)) AND (ID_supervision NOT IN (SELECT ID_supervision FROM Site WHERE ID_supervision IS NOT NULL));
END$$
DELIMITER ;

create table Utilisateur
(
    ID_utilisateur     int auto_increment
        primary key,
    Prenom             varchar(50)  null,
    Nom                varchar(50)  null,
    Email              varchar(50)  null,
    Mdp                varchar(255) null
);


INSERT INTO Utilisateur (ID_utilisateur, Prenom, Nom, Email, Mdp)
VALUES (1, 'Admin', 'User', 'admin@localhost', '$2y$10$7eFKoDnEN4JFBV4GD59Y1.cODR2XWRKOen/WmMa8bkAbhx93i88Pu');


GRANT ALL PRIVILEGES ON SimpleInventory.* TO 'util'@'localhost';
FLUSH PRIVILEGES;