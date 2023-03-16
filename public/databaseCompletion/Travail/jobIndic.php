<?php

use Database\MyPdo;
use Entity\Collection\CollectionTerritoire;

require_once 'vendor/autoload.php';



$terri= CollectionTerritoire::findAll();

$compteur=0;
$listeValeur=[];
foreach ($terri as $item) {
    $data='{
  "codeTypeTerritoire": "'.$item->getCodeTypeTerritoire().'",
  "codeTerritoire": "'.$item->getCodeTerritoire().'",
  "codeTypeActivite": "MOYENNE",
  "codeActivite": "MOYENNE",
  "codeTypePeriode": "TRIMESTRE"
}';
    $g=new postRequestSender(
        "https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-dynamique-emploi",
        ["Content-Type: application/json"],
        json_decode($data, true)
    );
    $response=$g->xmlToJson($g->sendPostRequest());
    if (array_key_exists('listeValeursParPeriode', json_decode($response, true))) {
        $r=json_decode($response, true)['listeValeursParPeriode'];
        foreach ($r as $value) {
            if (!str_starts_with($value['codePeriode'], '2023')) {
                $listeValeur[] = $value['valeurPrincipaleNom'];
            }
            $stmt = MyPDO::getInstance()->prepare(
                <<<'SQL'
INSERT INTO InfosJob VALUES (:cdP,:cdTerri,:cdTpTerri,:val,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)
SQL
            );
            $stmt->execute([":cdP"=>$value['codePeriode'],":cdTerri"=>$value['codeTerritoire'],":val"=>$value['valeurPrincipaleNom'],':cdTpTerri'=>$value['codeTypeTerritoire']]);
            if (count($listeValeur)===4 and !str_starts_with($value['codePeriode'], '2023')) {
                $moyenne=array_sum($listeValeur)/4;
                $stmt = MyPDO::getInstance()->prepare(
                    <<<'SQL'
INSERT INTO InfosJob VALUES (:cdP,:cdTerri,:cdTpTerri,:val,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)
SQL
                );
                $stmt->execute([":cdP"=>substr($value['codePeriode'], 0, 4),":cdTerri"=>$value['codeTerritoire'],":val"=>$moyenne,':cdTpTerri'=>$value['codeTypeTerritoire']]);
                $listeValeur=[];
            }
        }
    }
}
