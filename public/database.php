<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
DROP TABLE IF EXISTS IndicateurJob;
DROP TABLE IF EXISTS Territoire;
DROP TABLE IF EXISTS TypeTerritoire;
DROP TABLE IF EXISTS Trimestre;
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
CREATE TABLE Trimestre(
    codePeriode VARCHAR(200) PRIMARY KEY ,
    libellePeriode VARCHAR(200)
);
CREATE TABLE IndicateurJob(
    codePeriode VARCHAR(200) ,
    codeTerritoire VARCHAR(200),
    valeurIndic INTEGER,
    PRIMARY KEY (codeTerritoire,codePeriode),
    FOREIGN KEY (codePeriode) REFERENCES Trimestre(codePeriode),
    FOREIGN KEY (codeTerritoire) REFERENCES  Territoire(codeTerritoire)
);
INSERT INTO TypeTerritoire VALUES ('REG','Région française');
INSERT INTO TypeTerritoire VALUES ('DEP','Département français');

SQL
);

$stmt1->execute();
