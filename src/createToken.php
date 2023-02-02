<?php

$clientId = "PAR_analysedata_120bb0d3ffce53c90a8e133832e7d9b4431b76f625e5e71cbba39e594f831375";
$clientSecret = "913cee3ab7181d067d794cdcfb9e82762a6562b93540e897ff795825f8da0f70";
$scopes = "api_stats-offres-demandes-emploiv1 offresetdemandesemploi";

// Définir l'URL pour obtenir le jeton d'authentification
$tokenUrl = "https://api.emploi-store.fr/partenaire/token";

// Paramètres de la demande
$params = array(
    "grant_type" => "client_credentials",
    "client_id" => $clientId,
    "client_secret" => $clientSecret,
    "scope" => $scopes
);

// Initialiser cURL
$ch = curl_init();

// Configurer cURL pour la demande POST
curl_setopt($ch, CURLOPT_URL, $tokenUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Exécuter la demande et récupérer la réponse
$response = curl_exec($ch);

// Décoder la réponse JSON
$responseData = json_decode($response, true);

// Vérifier si la demande a réussi
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Récupérer le jeton d'authentification
    $accessToken = $responseData["access_token"];

    // Utiliser le jeton pour les demandes futures
    // ...
}

// Fermer cURL
curl_close($ch);

?>