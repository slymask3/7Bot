<?php
/*
 * This php page is responsible for keeping track of the matches failed to update into the system,
 * and displaying the error to the user.
 */

$query = 'CREATE TABLE IF NOT EXISTS matcherrors (matchid BIGINT PRIMARY KEY, code INT, error VARCHAR(30), amount INT, msg VARCHAR(500))';
$result = $conn->prepare($query);
$result->execute();

$query = 'SELECT * FROM matcherrors WHERE matchid='.$r['matches'][$i]['matchId'];
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();
//var_dump($table);

if($result->rowCount() > 0) {
    $query = 'UPDATE matcherrors SET amount='.($table[0]['amount']+1).' WHERE matchid='.$r['matches'][$i]['matchId'];
    $result = $conn->prepare($query);
    $result->execute();
} else {
    $query = 'INSERT INTO matcherrors VALUES('.$r['matches'][$i]['matchId'].', '.$e->getCode().', "'.$e->getMessage().'", 1, "")';
    $result = $conn->prepare($query);
    $result->execute();
}
//    var_dump($query, $result->errorInfo());

$query = 'SELECT * FROM matcherrors WHERE matchid='.$r['matches'][$i]['matchId'];
$result = $conn->prepare($query);
$result->execute();
$error = $result->fetchAll()[0];

if(empty($error['msg'])) {
    echo '<span class="error">';
    echo 'Failed to add game with match id of '.$error['matchid'].' ('.$error['code'].' - '.$error['error'].') - (This match failed to update '.$error['amount'].' time'.addS($error['amount']).')';
    echo '</span><br>';
} else {
    echo '<span class="error">';
    echo 'Failed to add game with match id of '.$error['matchid'].' ('.$error['code'].' - '.$error['error'].') - (This match failed to update '.$error['amount'].' time'.addS($error['amount']).') - ('.$error['msg'].')';
    echo '</span><br>';
}

?>