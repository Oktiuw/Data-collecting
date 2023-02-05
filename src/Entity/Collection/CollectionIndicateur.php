<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\JobIndic;
use PDO;

require_once 'vendor/autoload.php';

class CollectionIndicateur
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM JobIndic 
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, JobIndic::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
