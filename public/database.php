<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
DROP TABLE IF EXISTS InfosLogement;
DROP TABLE IF EXISTS Informations;
DROP TABLE IF EXISTS InfosJob;
DROP TABLE IF EXISTS IndicateurJob;
DROP TABLE IF EXISTS Territoire;
DROP TABLE IF EXISTS TypeTerritoire;
DROP TABLE IF EXISTS Periode;
CREATE TABLE TypeTerritoire(
    codeTypeTerritoire VARCHAR(20) PRIMARY KEY,
    libelleTypeTerritoire VARCHAR(200)
);
CREATE TABLE Territoire(
    codeTerritoire VARCHAR(3),
    libelleTerritoire VARCHAR(100),
    codeTypeTerritoire VARCHAR(20),
    PRIMARY KEY (codeTerritoire,codeTypeTerritoire),
    FOREIGN KEY (codeTypeTerritoire) REFERENCES TypeTerritoire(codeTypeTerritoire)
);
CREATE TABLE Periode(
    codePeriode VARCHAR(200) PRIMARY KEY ,
    libellePeriode VARCHAR(200)
);

CREATE TABLE InfosJob(
    codePeriode VARCHAR(200) ,
    codeTerritoire VARCHAR(200),
    valeurIndic FLOAT,
    codeTypeTerritoire VARCHAR(20),
    population INTEGER,
    PRIMARY KEY (codeTerritoire,codePeriode,codeTypeTerritoire),
    FOREIGN KEY (codePeriode) REFERENCES Periode(codePeriode),
    FOREIGN KEY (codeTerritoire) REFERENCES  Territoire(codeTerritoire),
    FOREIGN KEY (codeTypeTerritoire) REFERENCES Territoire(codeTypeTerritoire)
);
CREATE TABLE InfosLogement(
    codePeriode VARCHAR(200) ,
    codeTerritoire VARCHAR(200),
    codeTypeTerritoire VARCHAR(20),
    nbLogements0VOIT INTEGER,
    nbLogements1VOIT INTEGER,
    nbLogements2VOIT INTEGER,
    nbLogements3VOIT INTEGER,
    nbLogementsAvecPlacesResa INTEGER,
    PRIMARY KEY (codePeriode,codeTerritoire,codeTypeTerritoire),
    FOREIGN KEY (codePeriode) REFERENCES Periode(codePeriode),
    FOREIGN KEY (codeTerritoire) REFERENCES  Territoire(codeTerritoire),
    FOREIGN KEY (codeTypeTerritoire) REFERENCES Territoire(codeTypeTerritoire)
);
INSERT INTO TypeTerritoire VALUES ('REG','Région française');
INSERT INTO TypeTerritoire VALUES ('DEP','Département français');

SQL
);

$stmt1->execute();
