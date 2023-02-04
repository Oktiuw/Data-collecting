<?php

use Database\MyPdo;

require_once 'src/Database/MyPdo.php';

$stmt1 = MyPDO::getInstance()->prepare(
    <<<'SQL'
DROP TABLE IF EXISTS Territoires;
CREATE TABLE Territoires(
    codeTerritoire VARCHAR(3) PRIMARY KEY,
    libelleTerritoire VARCHAR(100)
);
SQL
);

$stmt1->execute();
