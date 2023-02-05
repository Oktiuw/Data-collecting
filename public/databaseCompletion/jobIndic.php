<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';

$data='{
  "codeTypeTerritoire": "REG",
  "codeTerritoire": "75",
  "codeTypeActivite": "MOYENNE",
  "codeActivite": "MOYENNE",
  "codeTypePeriode": "TRIMESTRE",
  "derniereperiode": true
}';


$s=new postRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-dynamique-emploi", ["Content-Type: application/json"], json_decode($data, true));
$response=$s->xmlToJson($s->sendPostRequest());
$s->saveJson($response, 'jobIndic');
