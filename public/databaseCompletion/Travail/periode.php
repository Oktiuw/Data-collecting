<?php

declare(strict_types=1);

use Database\MyPdo;

require_once 'vendor/autoload.php';


$g=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/periodes/TRIMESTRE?criteretemporel=past");
$r=$g->xmlToJson($g->sendGetRequest());
$g->saveJson($r, "annees");

$r=json_decode($r, true)['periodes'];

foreach ($r as $terri) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO Periode VALUES (:cdTri,:libTri)
SQL
    );

    $stmt->execute([":cdTri"=>$terri['codePeriode'],":libTri"=>$terri['libellePeriode']]);
}
$g=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/periodes/ANNEE?criteretemporel=past");
$r=$g->xmlToJson($g->sendGetRequest());
$g->saveJson($r, "annees");

$r=json_decode($r, true)['periodes'];

foreach ($r as $terri) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO Periode VALUES (:cdTri,:libTri)
SQL
    );

    $stmt->execute([":cdTri"=>$terri['codePeriode'],":libTri"=>$terri['libellePeriode']]);
}