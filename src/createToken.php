<?php
$clientId = 'PAR_analysedata_120bb0d3ffce53c90a8e133832e7d9b4431b76f625e5e71cbba39e594f831375';
$clientSecret = '913cee3ab7181d067d794cdcfb9e82762a6562b93540e897ff795825f8da0f70';

$headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Basic '.base64_encode($clientId.':'.$clientSecret)
);

$postData = 'grant_type=client_credentials';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https:/pole-emploi.io/data/api/marche-travail');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($httpCode >= 200 && $httpCode < 300) {
    $result = json_decode($result, true);
    $accessToken = $result['access_token'];
    echo 'Access token: '.$accessToken;
} else {
    echo 'Error: '.$httpCode;
}
?>