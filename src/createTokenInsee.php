<?php

declare(strict_types=1);


$clientId = 'RA78t0azDgeUlfxqd1hfOyUWy';
$clientSecret = 'Xo3jeJLmoPasyd0y8f7bfYeTt24a';
$grantType = 'client_credentials';

$url = 'https://api.insee.fr/token';

$headers = [
    'Authorization: Basic '.base64_encode($clientId.':'.$clientSecret),
];

$data = [
    'grant_type' => $grantType,
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close($ch);
var_dump($response);
