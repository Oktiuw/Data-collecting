<?php

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;

require_once 'vendor/autoload.php';
$data='{
    "codeTypeTerritoire": "REG",

 "codeTerritoire": "75",

 "codeTypeActivite": "ROME",

 "codeActivite": "A1203",

 "codeTypePeriode": "TRIMESTRE",

 "codeTypeNomenclature": "CATCAND"

}';

$s=new postRequestSender("https://api.pole-emploi.io/partenaire/stats-offres-demandes-emploi/v1/indicateur/stat-demandeurs", ["Content-Type: application/json"], json_decode($data, true));
$response=$s->sendPostRequest();
if ($response==="")
{
    echo "probleme connexion API Pole emploi";
    exit;
}





$url = "https://api.insee.fr/donnees-locales/V0.1/donnees/geo-SEXE-AGE15_15_90@GEO2022RP2019/DEP-01.ENS.ENS";

try {
    $g = new getRequestSender(
        $url,
        ["Accept: application/json"],
        true
    );
    // processus parent
    $pid = pcntl_fork();
    // si on est dedans on mesure le temps de la requete
    if ($pid) {
        pcntl_waitpid($pid, $status);
        if (pcntl_wifexited($status)) {
            $exitCode = pcntl_wexitstatus($status);
            if ($exitCode === 0) {
                echo "Tout s'est bien déroulé";
            } else {
                $start=microtime(true);
                $time_elapsed = microtime(true) - $start;
                if ($time_elapsed > 5) {
                    echo "La requête a pris trop de temps à répondre (>5s)" . PHP_EOL;
                    exit(1);
                }
            }
        } else {
            echo "Le processus enfant a échoué" . PHP_EOL;
            exit(1);
        }
    } else {
        $response = $g->sendGetRequest();
        $response=json_decode($response,true);
        if ($response and array_key_exists("Cellule", $response)) {
            exec("composer db");
        } else {
            var_dump($response);
            echo "Erreur de réponse de l'API" . PHP_EOL;
            exit(1);
        }
    }
}
catch (ConnectException $e) {
    echo "Erreur de connexion à l'API: " . $e->getMessage() . PHP_EOL;
    exit(1);
} catch (RequestException $e) {
    echo "Erreur de requête à l'API: " . $e->getMessage() . PHP_EOL;
    exit(1);
}