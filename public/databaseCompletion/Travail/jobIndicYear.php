<?php

use Database\MyPdo;
use Entity\Collection\CollectionTerritoire;
require_once 'vendor/autoload.php';


$listeAnnees=['2023','2022','2021','2020','2019'];
$terri= CollectionTerritoire::findAll();
foreach ($terri as $item) {
    foreach ($listeAnnees as $annee){
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
SELECT *
FROM InfosJob
WHERE codeTerritoire=:cdTerri and codePeriode LIKE CONCAT(:cdP, '%') AND codeTypeTerritoire=:cdTpTerri
SQL
    );
    $stmt->execute([":cdP"=>$annee,":cdTerri"=>$item->getCodeTerritoire(),':cdTpTerri'=>$item->getCodeTypeTerritoire()]);
    $res=$stmt->fetchAll();
    if (count($res)===4)
    {
        $s=0;
        foreach ($res as $r)
        {
            $s+=$r['valeurIndic'];
        }
        $m=$s/4;
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
INSERT INTO InfosJob VALUES (:cdP,:cdTerri,:cdTpTerri,:val,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)
SQL
        );
        $stmt->execute([":cdP"=>$annee,":cdTerri"=>$item->getCodeTerritoire(),':cdTpTerri'=>$item->getCodeTypeTerritoire(),':val'=>$m]);
    }
    }
}