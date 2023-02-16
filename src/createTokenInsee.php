<?php

// URL de l'API
$url = "https://api.insee.fr/token";

// Paramètres de la requête
$fields = array(
    "grant_type" => "client_credentials"
);

// En-têtes de la requête
$headers = array(
    "Authorization: Basic " . base64_encode("RA78t0azDgeUlfqd1hfOyUWyonoa:Xo3jeJLmoPasyd0y8f7bfYeTt24a")
);

// Configuration de la requête cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL certificate errors

// Exécution de la requête
$response = curl_exec($ch);

// Vérification des erreurs
if(curl_errno($ch)) {
    echo "Erreur cURL : " . curl_error($ch);
}

// Fermeture de la connexion
curl_close($ch);

// Traitement de la réponse
$response = json_decode($response, true);
if ($response and isset($response['access_token'])) {
    $data = ["access_token" => $response['access_token']];
    $json_data = json_encode($data);
    file_put_contents(__DIR__ . "/jsonFiles/access_tokenInsee.json", $json_data);
}