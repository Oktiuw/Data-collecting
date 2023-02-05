<?php


use Database\MyPdo;

require_once 'vendor/autoload.php';

$s=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/type-activites");

$r=$s->xmlToJson($s->sendGetRequest());
$s->saveJson($r, "territoires");
$r=json_decode($r, true)['typeActivites'];

foreach ($r as $tp) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO TypeActivite VALUES (:cdTpActivite,:libelleTpActivite)
SQL
    );

    $stmt->execute([":cdTpActivite"=>$tp['codeTypeActivite'],":libelleTpActivite"=>$tp['libelleTypeActivite']]);
}

var_dump(\Entity\Collection\CollectionTypeActivite::findAll());
