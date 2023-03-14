<?php

use Database\MyPdo;

require_once 'vendor/autoload.php';
$url = 'https://france-geojson.gregoiredavid.fr/repo/regions.geojson';
$data = file_get_contents($url);
$data = json_decode($data,true)['features'];
foreach ($data as $r) {
    $cdP=$r['properties']['code'];
    if (is_array($r)){
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='REG'
    SQL
        );
        $stmt->execute([":cdP"=>$cdP,':nb0'=>json_encode($r)]);
    }
    if ($cdP==='01')
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='DEP'
    SQL
        );
        $stmt->execute([":cdP"=>'971',':nb0'=>json_encode($r)]);
    }
    if ($cdP==='02')
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='DEP'
    SQL
        );
        $stmt->execute([":cdP"=>'972',':nb0'=>json_encode($r)]);
    }
    if ($cdP==='03')
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='DEP'
    SQL
        );
        $stmt->execute([":cdP"=>'973',':nb0'=>json_encode($r)]);
    }
    if ($cdP==='04')
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='DEP'
    SQL
        );
        $stmt->execute([":cdP"=>'974',':nb0'=>json_encode($r)]);
    }
    if ($cdP==='06')
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    UPDATE Territoire
    SET geoJson=:nb0
    WHERE codeTerritoire=:cdP and codeTypeTerritoire='DEP'
    SQL
        );
        $stmt->execute([":cdP"=>'976',':nb0'=>json_encode($r)]);
    }
}