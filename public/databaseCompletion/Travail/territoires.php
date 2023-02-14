<?php


use Database\MyPdo;

require_once 'vendor/autoload.php';


$g=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/territoires/REG");
$r=$g->xmlToJson($g->sendGetRequest());
$g->saveJson($r, "régions");

$r=json_decode($r, true)['territoires'];

foreach ($r as $terri) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO Territoire VALUES (:cdTerritoire,:libTerritoire,:cdTypeTerri)
SQL
    );

    $stmt->execute([":cdTerritoire"=>$terri['codeTerritoire'],":libTerritoire"=>$terri['libelleTerritoire'],":cdTypeTerri"=>$terri['codeTypeTerritoire']]);
}
$g=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/territoires/DEP");
$r=$g->xmlToJson($g->sendGetRequest());
$g->saveJson($r, "departements");

$r=json_decode($r, true)['territoires'];

foreach ($r as $terri) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO Territoire VALUES (:cdTerritoire,:libTerritoire,:cdTypeTerri)
SQL
    );

    $stmt->execute([":cdTerritoire"=>$terri['codeTerritoire'],":libTerritoire"=>$terri['libelleTerritoire'],":cdTypeTerri"=>$terri['codeTypeTerritoire']]);
}
