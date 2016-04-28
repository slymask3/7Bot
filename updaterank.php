<?php
$page = 'index';
$pagename = 'Update Ranks';
require_once 'header.php';
if($_SERVER['REMOTE_ADDR'] != $ip) {
    header('Location:404.php');
}

$query = 'SELECT accounts_na.id, username, r.id, r.rank, division, lp FROM accounts_na LEFT JOIN ranks r ON accounts_na.tier=r.rank ORDER BY 3 DESC,5 ASC,6 DESC';
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();
var_dump($result->errorInfo());

$rank = 1;
foreach($table as $acc) {
    $query = 'UPDATE accounts_na SET rank=:rank WHERE id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':rank', $rank, PDO::PARAM_INT);
    $result->bindParam(':id', $acc[0], PDO::PARAM_INT);
    $result->execute();
    var_dump($result->errorInfo());
    $rank++;
}

require_once 'footer.php';
?>