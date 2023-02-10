<?php

use Database\MyPdo;
use Entity\Collection\CollectionTerritoire;

require_once 'vendor/autoload.php';



$terri= CollectionTerritoire::findAll();


foreach ($terri as $item) {
    $data="{
  'codeTypeTerritoire': '{$item->getCodeTypeTerritoire()}',
  'codeTerritoire': '{$item->getCodeTerritoire()}',
  'codeTypeActivite': 'MOYENNE',
  'codeActivite': 'MOYENNE',
  'codeTypePeriode': 'TRIMESTRE'

}";
    $g=new postRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-dynamique-emploi", ["Content-Type: application/json"], json_decode($data, true));
}
