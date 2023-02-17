<?php

use Database\MyPdo;
use Entity\Collection\CollectionTerritoire;

require_once 'vendor/autoload.php';


require_once 'vendor/autoload.php';



$terri= CollectionTerritoire::findAll();
$firstYear=2022;
$nextYear=2019;
$modalites=['0','1','2','3'];
for ($i=0;$i<3;$i++){
    $firstYear-=$i;
    $nextYear-=$i;
    foreach ($terri as $item) {
        $valeurs=[];
        foreach ($modalites as $modalite){
            $url="https://api.insee.fr/donnees-locales/V0.1/donnees/geo-VOIT@GEO$firstYear"."RP"."$nextYear/{$item->getCodeTypeTerritoire()}-{$item->getCodeTerritoire()}.$modalite";
            $g=new getRequestSender(
                $url,
                ["Accept: application/json"],true);
            $response=json_decode($g->sendGetRequest(),true);
            if ($response and array_key_exists("Cellule",$response))
            {
                $valeurs[]=$response['Cellule']['Valeur'];
            }
    }   if (count($valeurs)==4){
            $stmt = MyPDO::getInstance()->prepare(
                <<<'SQL'
                    INSERT INTO InfosLogement VALUES (:cdP,:cdTerri,:cdTpTerri,:nb1,:nb2,:nb3,:nb4)
                    SQL
            );
            $stmt->execute([':cdP'=>$nextYear,':cdTerri'=>$item->getCodeTerritoire(),':cdTpTerri'=>$item->getCodeTypeTerritoire(),':nb1'=>$valeurs[0],':nb2'=>$valeurs[1],':nb3'=>$valeurs[2],'nb4'=>$valeurs[3]]);

    }}
}