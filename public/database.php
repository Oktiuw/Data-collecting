<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
DROP TABLE IF EXISTS JobIndic;
DROP TABLE IF EXISTS Activite ;
DROP TABLE IF EXISTS TypeActivite;
DROP TABLE IF EXISTS Territoire;
CREATE TABLE Territoire(
    codeTerritoire VARCHAR(3) PRIMARY KEY,
    libelleTerritoire VARCHAR(100)
);


CREATE TABLE TypeActivite(
    codeTpActivite VARCHAR(30) PRIMARY KEY,
    libelleTpActivite VARCHAR(100)
);
CREATE TABLE Activite(
    codeActivite VARCHAR(30),
    libelleActivite VARCHAR(300),
    codeTpActivite VARCHAR(30),
    CONSTRAINT PK_Activite PRIMARY KEY (codeActivite, codeTpActivite),
    CONSTRAINT FK_Activite_TypeActivite FOREIGN KEY (codeTpActivite)
    REFERENCES TypeActivite(codeTpActivite)
);

CREATE TABLE JobIndic(
    codeTerritore VARCHAR(3),
    codeActivite VARCHAR(100),
    libelleIndicateur VARCHAR(300),
    valeurIndicateur FLOAT,
    CONSTRAINT PK_JobIndic PRIMARY KEY (codeActivite,codeTerritore),
    CONSTRAINT FK_JobIndic_Activite FOREIGN KEY (codeActivite) REFERENCES Activite(codeActivite),
    CONSTRAINT FK_JobIndic_Territoire FOREIGN KEY (codeTerritore) REFERENCES Territoire(codeTerritoire)
)
SQL
);

$stmt1->execute();
