<?php

$query = 'SELECT accounts_'.$region.'.id, username, r.id, r.rank, division, lp FROM accounts_'.$region.' LEFT JOIN ranks r ON accounts_'.$region.'.tier=r.rank ORDER BY 3 DESC,5 ASC,6 DESC';
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();
//var_dump($result->errorInfo());

$rank = 1;
foreach($table as $acc) {
    $query = 'UPDATE accounts_'.$region.' SET rank=:rank WHERE id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':rank', $rank, PDO::PARAM_INT);
    $result->bindParam(':id', $acc[0], PDO::PARAM_INT);
    $result->execute();
//    var_dump($result->errorInfo());
    $rank++;
}

?>
