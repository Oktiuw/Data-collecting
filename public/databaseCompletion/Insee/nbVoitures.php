<?php

use Database\MyPdo;
use Entity\Collection\CollectionTerritoire;

require_once 'vendor/autoload.php';




$terri= CollectionTerritoire::findAll();
$firstYear=2023;
$nextYear=2020;
for ($i=0;$i<4;$i++) {
    $firstYear-=1;
    $nextYear-=1;
    foreach ($terri as $item) {
        $listeVal=[];
        query:
        $url="https://api.insee.fr/donnees-locales/V0.1/donnees/geo-VOIT@GEO$firstYear"."RP"."$nextYear/{$item->getCodeTypeTerritoire()}-{$item->getCodeTerritoire()}.all";
        $g=new getRequestSender($url, ['Accept: application/json'], true);
        $response=$g->sendGetRequest();
        $response=json_decode($response, true);
        if ($response) {
            if (array_key_exists("fault", $response)) {
                sleep(1);
                goto query;
            }
            if (array_key_exists('Cellule', $response)) {
                $valeurs=$response['Cellule'];
                foreach ($valeurs as $valeur) {
                    if ($valeur["Modalite"]["@code"]!=='ENS') {
                        $listeVal[]=$valeur['Valeur'];
                    }
                }
                query2:
                $url="https://api.insee.fr/donnees-locales/V0.1/donnees/geo-GARL@GEO$firstYear"."RP"."$nextYear/{$item->getCodeTypeTerritoire()}-{$item->getCodeTerritoire()}.1";
                $g=new getRequestSender($url, ['Accept: application/json'], true);
                $response=$g->sendGetRequest();
                $response=json_decode($response, true);
                if ($response) {
                    if (array_key_exists("fault", $response)) {
                        sleep(1);
                        goto query2;
                    }
                    $listeVal[]=$response['Cellule']['Valeur'];
                    $stmt = MyPDO::getInstance()->prepare(
                        <<<'SQL'
    UPDATE InfosJob
    SET nbLogements0VOIT=:nb0, nbLogements1VOIT=:nb1,nbLogements2VOIT=:nb2,nbLogements3VOITOuPlus=:nb3,nbLogementsAvecPlacesResa=:resa
    WHERE codePeriode=:cdP and codeTerritoire=:cdTerri and codeTypeTerritoire=:cdTpTerri
    SQL
                    );
                    $stmt->execute([":cdP"=>$nextYear,":cdTerri"=>$item->getCodeTerritoire(),':cdTpTerri'=>$item->getCodeTypeTerritoire(),':nb0'=>$listeVal[0],':nb1'=>$listeVal[1],':nb2'=>$listeVal[2],':nb3'=>$listeVal[3],':resa'=>$listeVal[4]]);
                }
            }
        }
    }
}
