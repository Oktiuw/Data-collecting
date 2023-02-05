<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
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

SQL
);

$stmt1->execute();
