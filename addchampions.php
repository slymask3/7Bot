<?php
$page = 'champions';
$pagename = 'Add Champions';
require_once 'header.php';

$query = 'SELECT id FROM champions';
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();

foreach($table as $row) {
    $champ = ((array)json_decode(file_get_contents('https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/'.$row['id'].'?champData=skins&api_key='.$apikey)));
    $skins = json_encode($champ['skins']);
    $id = (int)$row['id'];

    $query = "UPDATE champions SET skins=:skins WHERE id=:id";
    $result = $conn->prepare($query);
    $result->bindParam(':skins', $skins, PDO::PARAM_STR);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();

    var_dump('added skins to champ with id '.$id, $skins, $result->errorInfo(), $id);
}

?>

<?php require_once 'footer.php'; ?>