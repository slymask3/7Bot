<?php
$page = 'index';
$pagename = 'Convert Accounts';
require_once 'header.php';
if($_SERVER['REMOTE_ADDR'] != $ip) {
    header('Location:404.php');
}

$query = 'SELECT * FROM accounts WHERE region="na"';
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();

foreach($table as $acc) {
    $lvl = 30;
    $ln = '';
    $wins = 0;
    $losses = 0;
    $lastupdated = (new DateTime())->getTimestamp();

    $queues = '';
    $acc['s6']==1?$queues.='1':$queues.='0';
    $acc['s5']==1?$queues.='1':$queues.='0';
    $acc['s4']==1?$queues.='1':$queues.='0';
    $acc['s3']==1?$queues.='1':$queues.='0';
    $acc['s6dynamic']==1?$queues.='1':$queues.='0';
    $acc['s6solo']==1?$queues.='1':$queues.='0';
    $acc['s6team5']==1?$queues.='1':$queues.='0';
    $acc['s6team3']==1?$queues.='1':$queues.='0';
    $acc['s5dynamic']==1?$queues.='1':$queues.='0';
    $acc['s5solo']==1?$queues.='1':$queues.='0';
    $acc['s5team5']==1?$queues.='1':$queues.='0';
    $acc['s5team3']==1?$queues.='1':$queues.='0';
    $acc['s4dynamic']==1?$queues.='1':$queues.='0';
    $acc['s4solo']==1?$queues.='1':$queues.='0';
    $acc['s4team5']==1?$queues.='1':$queues.='0';
    $acc['s4team3']==1?$queues.='1':$queues.='0';
    $acc['s3dynamic']==1?$queues.='1':$queues.='0';
    $acc['s3solo']==1?$queues.='1':$queues.='0';
    $acc['s3team5']==1?$queues.='1':$queues.='0';
    $acc['s3team3']==1?$queues.='1':$queues.='0';

    $query = 'INSERT INTO accounts_'.$region.' VALUES(:id, :un, :dn, :icon, :lvl, :rev, :tier, :div, :lp, :ln, :wins, :losses, :lu, :q, -1)';
    $result = $conn->prepare($query);
    $result->bindParam(':id', $acc['id'], PDO::PARAM_INT);
    $result->bindParam(':un', $acc['username'], PDO::PARAM_STR, 16);
    $result->bindParam(':dn', $acc['displayname'], PDO::PARAM_STR, 16);
    $result->bindParam(':icon', $acc['icon'], PDO::PARAM_INT);
    $result->bindParam(':lvl', $lvl, PDO::PARAM_INT);
    $result->bindParam(':rev', $revision, PDO::PARAM_INT);
    $result->bindParam(':tier', $acc['tier'], PDO::PARAM_STR, 10);
    $result->bindParam(':div', $acc['division'], PDO::PARAM_STR, 3);
    $result->bindParam(':lp', $acc['lp'], PDO::PARAM_INT);
    $result->bindParam(':ln', $ln, PDO::PARAM_STR, 36);
    $result->bindParam(':wins', $wins, PDO::PARAM_INT);
    $result->bindParam(':losses', $losses, PDO::PARAM_INT);
    $result->bindParam(':lu', $lastupdated, PDO::PARAM_INT);
    $result->bindParam(':q', $queues, PDO::PARAM_STR, 20);
    $result->execute();
}

require_once 'footer.php';
?>