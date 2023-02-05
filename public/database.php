<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
DROP TABLE IF EXISTS Territoire;
DROP TABLE IF EXISTS TypeActivite;
CREATE TABLE Territoire(
    codeTerritoire VARCHAR(3) PRIMARY KEY,
    libelleTerritoire VARCHAR(100)
);
CREATE TABLE TypeActivite(
    codeTpActivite VARCHAR(30) PRIMARY KEY,
    libelleTpActivite VARCHAR(100)
);
SQL
);

$stmt1->execute();
