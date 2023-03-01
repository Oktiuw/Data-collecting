<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
DROP TABLE IF EXISTS InfosJob;
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
    geoJson JSON,
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
    nbLogements0VOIT INTEGER,
    nbLogements1VOIT INTEGER,
    nbLogements2VOIT INTEGER,
    nbLogements3VOITOuPlus INTEGER,
    nbLogementsAvecPlacesResa INTEGER,
    chauffageCollectif INTEGER,
    chauffageIndiv INTEGER,
    chauffageElect INTEGER,
    chauffageAutre INTEGER,
    PRIMARY KEY (codeTerritoire,codePeriode,codeTypeTerritoire),
    FOREIGN KEY (codePeriode) REFERENCES Periode(codePeriode),
    FOREIGN KEY (codeTerritoire) REFERENCES  Territoire(codeTerritoire),
    FOREIGN KEY (codeTypeTerritoire) REFERENCES Territoire(codeTypeTerritoire)
);
INSERT INTO TypeTerritoire VALUES ('REG','Région française');
INSERT INTO TypeTerritoire VALUES ('DEP','Département français');

SQL
);

$stmt1->execute();
