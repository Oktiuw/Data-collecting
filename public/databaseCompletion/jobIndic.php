<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';
/* A faire a changer code type periode

$data='{
  "critereindicateursansnomenclature": {
    "codetypeterritoire": "REG",
    "codeterritoire": "44",
    "codetypeactivite": "NOEUD",
    "codeactivite": "00001",
    "codetypeperiode": "string",
    "derniereperiode": true,
    "sanscaracteristiques": true,
}';


$s=new postRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-dynamique-emploi", ["Content-Type: application/json"], json_decode($data, true));
$response=$s->sendPostRequest();
$s->saveJson($s->xmlToJson($response), 'example');
