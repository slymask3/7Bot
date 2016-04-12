<?php
$page = 'spells';
$pagename = 'Spells';
require_once 'header.php';

$query = 'DROP TABLE IF EXISTS spells;';
$result = $conn->prepare($query);
$result->execute();
echo '<div class="query">'.$query.'</div>';

$query = 'CREATE TABLE spells ( id INT, pic VARCHAR(30), name VARCHAR(30), description VARCHAR(500) );';
$result = $conn->prepare($query);
$result->execute();
echo '<div class="query">'.$query.'</div>';

try {
    //$spell = ((array)json_decode(file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/summoner-spell/?api_key='.$apikey)));

    for($i=0; $i < 33; $i++) {
        //$ver = explode('.', $spells[$i]);
        $spell = ((array)json_decode(file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/summoner-spell/'.$i.'?api_key='.$apikey)));

        $query = 'INSERT INTO spells VALUES('.$spell['id'].', "'.$spell['key'].'", "'.$spell['name'].'", "'.$spell['description'].'")';
        $result = $conn->prepare($query);
        $result->execute();
        echo '<div class="query">'.$query.'</div>';
    }
} catch(Exception $e) {
    //echo '<div class="query">'.$i.' is not a correct id.</div>';
}

//$championarray = ((array)json_decode(file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/' . 202 . '?champData=info&api_key='.$apikey)));
//$champion = $championarray['key'];

//var_dump($championarray);

require_once 'footer.php';
?>