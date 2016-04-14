<?php
$page = 'current';
$pagename = 'Current Game';
require_once 'header.php';
?>
<?php

$region = 'na';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}
$username = '';
if(!empty($_GET['name'])) {
    $username = $_GET['name'];
}

if(empty($username)) {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="current.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';
} else {
//    include 'summonerinfo.php';

    echo '<div class="search-summoner">';
    echo '<form action="current.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" value="'.$username.'" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';

    echo '<div class="about">';

    try {
        $api = new riotapi($region, new FileSystemCache('cache/'));
        $id = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))]['id'];
        $r = $api->getCurrentGame($id, strtoupper($region).'1');

        var_dump_pre($r);
    } catch(Exception $e) {
        echo $username.' is not currently not in a game.';
    }

    echo '</div>';
}



?>
<?php require_once 'footer.php'; ?>