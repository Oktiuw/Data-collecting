<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TypeActivite;
use PDO;

require_once 'vendor/autoload.php';



class CollectionTypeActivite
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM TypeActivite 
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, TypeActivite::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
