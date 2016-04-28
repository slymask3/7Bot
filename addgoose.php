<?php
$page = 'champions';
$pagename = 'Add Goose';
require_once 'header.php';
if($_SERVER['REMOTE_ADDR'] != $ip) {
    header('Location:404.php');
}

//var_dump($_SERVER);

$query = 'SELECT id, name FROM champions';
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();
var_dump($result->errorInfo());

foreach($table as $row) {
    $oose = getOose($row['name']);

    $query = "UPDATE champions SET oose=:oose WHERE id=:id";
    $result = $conn->prepare($query);
    $result->bindParam(':oose', $oose, PDO::PARAM_STR);
    $result->bindParam(':id', $row['id'], PDO::PARAM_INT);
    $result->execute();

    var_dump('added oose to champ with id '.$row['id'], $oose, $result->errorInfo());
}

?>

<?php require_once 'footer.php'; ?>