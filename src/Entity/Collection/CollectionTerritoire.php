<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Territoire;
use PDO;

require_once 'vendor/autoload.php';

class CollectionTerritoire
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM Territoire t
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Territoire::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
