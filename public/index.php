<?php

require '../vendor/autoload.php';

$data='{
    "codeTypeTerritoire": "REG",

 "codeTerritoire": "75",

 "codeTypeActivite": "ROME",

 "codeActivite": "A1203",

 "codeTypePeriode": "TRIMESTRE",

 "codeTypeNomenclature": "CATCAND"

}';

$s=new postRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-demandeurs",json_decode($data,true),["Content-Type: application/json"]);
$response=$s->sendPostRequest();
$s->saveJson($s->xmlToJson($response),'example');
