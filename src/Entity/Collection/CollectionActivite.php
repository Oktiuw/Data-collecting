<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Activite;
use PDO;

require_once 'vendor/autoload.php';



class CollectionActivite
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM Activite 
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Activite::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}