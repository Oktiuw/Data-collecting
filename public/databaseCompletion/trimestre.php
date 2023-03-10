<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$s=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/periodes/TRIMESTRE");
$r=$s->xmlToJson($s->sendGetRequest());
$s->saveJson($r, "trimestres");

