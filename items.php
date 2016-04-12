<?php
$page = 'items';
$pagename = 'Items';
require_once 'header.php';

//https://global.api.pvp.net/api/lol/static-data/na/v1.2/item?api_key=a431e75e-623e-41c2-9515-0253e462a059


//for($i=0) {

//}



//var_dump($itemarray['data']);

$query = 'SELECT * FROM versions';
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();

foreach($table as $row) {
    $itemarray = ((array)json_decode(file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/item?version='.$row[1].'.'.$row[2].'.'.$row[3].'&api_key=' . $apikey)));

    $query = 'DROP TABLE items_'.$row[1].'_'.$row[2].'_'.$row[3].';';
    $result = $conn->prepare($query);
    $result->execute();

    $query = 'CREATE TABLE items_'.$row[1].'_'.$row[2].'_'.$row[3].' (
	id INT PRIMARY KEY,
    name VARCHAR(50),
    grp VARCHAR(50),
    description VARCHAR(2000),
    plaintext VARCHAR(2000)
    );';
    $result = $conn->prepare($query);
    $result->execute();

    foreach ($itemarray['data'] as $i) {
        $item = (array)$i;
        //var_dump($item['id']);

        $query = 'INSERT INTO items_'.$row[1].'_'.$row[2].'_'.$row[3].' VALUES(' . $item['id'] . ', "' . $item['name'] . '", "' . $item['group'] . '", "' . $item['description'] . '", "' . $item['plaintext'] . '")';
        $result = $conn->prepare($query);
        $result->execute();

        var_dump($query);
    }
}


require_once 'footer.php';
?>