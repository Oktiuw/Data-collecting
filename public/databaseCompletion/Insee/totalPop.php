<?php

use Database\MyPdo;
use Entity\Collection\CollectionTerritoire;

require_once 'vendor/autoload.php';


require_once 'vendor/autoload.php';



$terri= CollectionTerritoire::findAll();
$firstYear=2022;
$nextYear=2019;

for ($i=0;$i<3;$i++){
    $firstYear-=$i;
    $nextYear-=$i;
    foreach ($terri as $item) {
        $url="https://api.insee.fr/donnees-locales/V0.1/donnees/geo-SEXE-AGE15_15_90@GEO$firstYear"."RP"."$nextYear/{$item->getCodeTypeTerritoire()}-{$item->getCodeTerritoire()}.ENS.ENS";
        $g=new getRequestSender(
            $url,
            ["Accept: application/json"],true);
        $response=json_decode($g->sendGetRequest(),true);
        if ($response and array_key_exists("Cellule",$response))
        {
            $stmt = MyPDO::getInstance()->prepare(
                <<<'SQL'
            UPDATE InfosJob
            SET population = :pop
            WHERE codePeriode=:cdP and codeTerritoire=:cdTerri and codeTypeTerritoire=:cdTpTerri
            SQL
            );

            $stmt->execute([":cdP"=>$nextYear,":cdTerri"=>$item->getCodeTerritoire(),':cdTpTerri'=>$item->getCodeTypeTerritoire(),':pop'=>$response['Cellule']['Valeur']]);
}
}}