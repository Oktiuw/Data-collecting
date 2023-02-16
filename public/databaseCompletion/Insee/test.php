<?php
require_once 'vendor/autoload.php';
$url = "https://api.insee.fr/metadonnees/V1/geo/regions/76";
// P1667
$s=new getRequestSender($url,["Accept: application/json"],true);
$s->saveJson($s->sendGetRequest(),'testInsee');