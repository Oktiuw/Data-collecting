<?php


use Database\MyPdo;

require_once 'vendor/autoload.php';


$g=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/territoires/REG");
$r=$g->xmlToJson($g->sendGetRequest());
$g->saveJson($r, "territoires");

$r=json_decode($r, true)['territoires'];

foreach ($r as $terri) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO Territoire VALUES (:cdTerritoire,:libTerritoire)
SQL
    );

    $stmt->execute([":cdTerritoire"=>$terri['codeTerritoire'],":libTerritoire"=>$terri['libelleTerritoire']]);
}
