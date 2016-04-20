<?php
$page = 'versions';
$pagename = 'Versions';
require_once 'header.php';
if($_SERVER['REMOTE_ADDR'] != $ip) {
    header('Location:404.php');
}

$query = 'DROP TABLE IF EXISTS versions;';
$result = $conn->prepare($query);
$result->execute();
echo '<div class="query">'.$query.'</div>';

$query = 'CREATE TABLE versions ( id INT, ver1 INT, ver2 INT, ver3 INT );';
$result = $conn->prepare($query);
$result->execute();
echo '<div class="query">'.$query.'</div>';

try {
    $versions = ((array)json_decode(file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/versions/?api_key='.$apikey)));

    for($i=0; $i < count($versions); $i++) {
        $ver = explode('.', $versions[$i]);

        $query = 'INSERT INTO versions VALUES('.($i+1).', '.$ver[0].', '.$ver[1].', '.$ver[2].')';
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