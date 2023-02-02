<?php

$url = "https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-demandeurs";
$data = array(
    "codeTypeTerritoire"=>"REG",

 "codeTerritoire"=>"75",

 "codeTypeActivite"=>"ROME",

 "codeActivite"=> "A1203",

 "codeTypePeriode"=> "TRIMESTRE",

 "codeTypeNomenclature"=> "CATCAND"
);
$file = __DIR__ . '/vendor/requestClasses/postRequestSender.php';
if (file_exists($file)) {
    echo "Le fichier de la classe postRequestSender existe";
} else {
    echo "Le fichier de la classe postRequestSender n'existe pas";
}

?>
