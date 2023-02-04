<?php

require_once 'src/getRequestSender.php';

$g=new getRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/referentiel/territoires/REG");
$r=$g->xmlToJson($g->sendGetRequest());
$g->saveJson($r, "territoires");

