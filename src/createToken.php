<?php
$clientId = "PAR_analysedata_120bb0d3ffce53c90a8e133832e7d9b4431b76f625e5e71cbba39e594f831375";
$clientSecret = "913cee3ab7181d067d794cdcfb9e82762a6562b93540e897ff795825f8da0f70";
$scope = "api_stats-offres-demandes-emploiv1 offresetdemandesemploi";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=/partenaire",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=$clientId&client_secret=$clientSecret&scope=$scope",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
    ),
));
$response = curl_exec($curl);
if (!$response) {
    echo curl_error($curl);
}
curl_close($curl);

var_dump($response);
$response = json_decode($response, true);



// Utilisez le jeton d'accès pour effectuer d'autres requêtes avec l'API
?>