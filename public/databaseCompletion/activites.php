<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$s=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/activites");
$r=$s->xmlToJson($s->sendGetRequest());
$s->saveJson($r, "activites");
$r=json_decode($r, true)['activites'];



foreach ($r as $a) {
    $stmt = MyPDO::getInstance()->prepare(
        <<<'SQL'
INSERT INTO Activite VALUES (:cdActivite,:libelleActivite,:cdTypeActivite);
SQL
    );
    $stmt->execute([":cdActivite"=>$a['codeActivite'],":libelleActivite"=>$a['libelleActivite'],":cdTypeActivite"=>$a['codeTypeActivite']]);
}
