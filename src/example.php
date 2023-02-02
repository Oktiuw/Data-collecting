<?php

$url = "https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-demandeurs";
$token = get_object_vars(json_decode(file_get_contents(__DIR__ . "\jsonFiles/access_token.json")))['access_token'];
$data = array(
    "codeTypeTerritoire"=>"REG",

 "codeTerritoire"=>"75",

 "codeTypeActivite"=>"ROME",

 "codeActivite"=> "A1203",

 "codeTypePeriode"=> "TRIMESTRE",

 "codeTypeNomenclature"=> "CATCAND"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
));

$response = curl_exec($ch);
curl_close($ch);
$json = json_encode(simplexml_load_string($response));
file_put_contents(__DIR__ . "\jsonFiles/example.json", $json);


?>
