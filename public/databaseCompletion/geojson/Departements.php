<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';
$url = 'https://france-geojson.gregoiredavid.fr/repo/departements.geojson';
$data = file_get_contents($url);
$data = json_decode($data,true)['features'];
foreach ($data as $r) {
    if (is_array($r)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0, libelleTerritoire=:lib
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='DEP'
    SQL
        );
        $stmt->execute([":cdP"=>$r['properties']['code'],':nb0'=>json_encode($r),':lib'=>$r['properties']['nom']]);
    }
}