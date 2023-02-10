<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'

DROP TABLE IF EXISTS TypeTerritoire;
DROP TABLE IF EXISTS Territoire;
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
INSERT INTO TypeTerritoire VALUES ('REG','Région française');
INSERT INTO TypeTerritoire VALUES ('DEP','Département français');

SQL
);

$stmt1->execute();
