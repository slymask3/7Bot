<style>
    .current {
        margin-bottom: 20px;
        color: #1b1b1b;
    }
    .current-info {
        background-color: grey;
        border: 1px black solid;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 5px;
    }
    .current-teams {
        display: flex;
    }
    .current-teams-blue {
        background-color: lightblue;
        border: 1px black solid;
        width: 50%;
        padding: 5px;
        text-align: center;
    }
    .current-teams-red {
        background-color: lightcoral;
        border: 1px black solid;
        width: 50%;
        padding: 5px;
        text-align: center;
    }
    .current-players {
        display: flex;
    }
    .current-blue {
        width: 50%;
        /*background-color: lightblue;*/
        /*border-top-left-radius: 15px;*/
        /*border-bottom-left-radius: 15px;*/
    }
    .current-red {
        width: 50%;
        /*border-top-right-radius: 15px;*/
        /*border-bottom-right-radius: 15px;*/
    }
    .current-middle {
        width: 5%;
        background-color: grey;
    }
    .current-lane{
        border: 1px black solid;
        height: 52px;
    }
    .current-lane-box {
        margin: 5px;
        text-align: center;
        /*margin: auto;*/
    }
    .current-player {
        border: 1px black solid;
        height: 52px;
        padding: 5px;
        position: relative;
    }
    .current-blue .current-player {
        background-color: lightblue;
    }
    .current-red .current-player {
        background-color: lightcoral;
    }

    /*.current-blue .current-player:first-child {*/
        /*border-top-left-radius: 15px;*/
    /*}*/
    /*.current-blue .current-player:last-child {*/
        /*border-bottom-left-radius: 15px;*/
    /*}*/
    /*.current-red .current-player:first-child {*/
        /*border-top-right-radius: 15px;*/
    /*}*/
    /*.current-red .current-player:last-child {*/
        /*border-bottom-right-radius: 15px;*/
    /*}*/
    .current-player-champion {
        position: absolute;
        top: 5px;
        left: 5px;
    }
    .current-player-spells {
        position: absolute;
        top: 5px;
        left: 45px;
    }
    .current-player-keystone {
        position: absolute;
        top: 15px;
        left: 65px;
    }
    .current-player-name {
        position: absolute;
        left: 90px;
        top: 15px;
    }
    .current-player-games {
        position: absolute;
        left: 200px;
        top: 15px;
    }
    .current-player-stats {
        position: absolute;
        left: 200px;
        text-align: left;
        font-size: x-small;
    }
    .current-blue .current-player-active {
        font-weight: bold;
        background-color: #63c1e6;
    }
    .current-red .current-player-active {
        font-weight: bold;
        background-color: #f0382e;
    }
    .current-bans {
        display: flex;
    }
    .current-bans-blue {
        width: 50%;
        text-align: center;
        border: 1px black solid;
        border-bottom-left-radius: 15px;
        padding: 5px;
        background-color: lightblue;
    }
    .current-bans-red {
        width: 50%;
        text-align: center;
        border: 1px black solid;
        border-bottom-right-radius: 15px;
        padding: 5px;
        background-color: lightcoral;
    }
    .current-player-name a, .current-player-name a:hover {
        color: #1b1b1b;
    }
</style>
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

$seasonCode = 'season2016';

if(empty($username)) {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="current.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger" style="border-bottom-right-radius: 4px; border-top-right-radius: 4px; "><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';
} else {
//    include 'summonerinfo.php';

    echo '<div class="search-summoner" style="width:300px">';
    echo '<form action="current.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" value="'.$username.'" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger" style="border-bottom-right-radius: 4px; border-top-right-radius: 4px; "><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';

//    echo '<div class="about">';

    try {
        $apiCache = new riotapi($region, new FileSystemCache('cache/'));
        $id = $apiCache->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))]['id'];
        $r = $apiCache->getCurrentGame($id, strtoupper($region).'1');


        $length = $r['gameLength'];

        $query = 'SELECT id, name FROM maps WHERE id='.$r['mapId'];
        $result = $conn->prepare($query);
        $result->execute();
        $mapname = $result->fetchAll()[0]['name'];


        echo '<div class="current">';
        echo '<div class="current-info">';
        echo 'Game Length: '.getTime($length).'<br>';
        echo 'Map: '.getMapIMG($r['mapId'], $mapname);
        echo '</div>';
        echo '<div class="current-players">';
        echo '<div class="current-blue">';
        for($i=0; $i<count($r['participants']); $i++) {
            if($r['participants'][$i]['teamId'] == 100) {
                $query = 'SELECT id, name, pic FROM champions WHERE id='.$r['participants'][$i]['championId'];
                $result = $conn->prepare($query);
                $result->execute();
                $champion = $result->fetchAll()[0];

                $query = 'SELECT id, name, pic FROM spells WHERE id='.$r['participants'][$i]['spell1Id'];
                $result = $conn->prepare($query);
                $result->execute();
                $spell1 = $result->fetchAll()[0];

                $query = 'SELECT id, name, pic FROM spells WHERE id='.$r['participants'][$i]['spell2Id'];
                $result = $conn->prepare($query);
                $result->execute();
                $spell2 = $result->fetchAll()[0];

                $keystone = 0;
                $keystonename = '';
                for($k=0; $k<count($r['participants'][$i]['masteries']); $k++) {
                    $query = 'SELECT id, name FROM keystones WHERE id='.$r['participants'][$i]['masteries'][$k]['masteryId'];
                    $result = $conn->prepare($query);
                    $result->execute();
                    if($result->rowCount() > 0) {
                        $keystone = $r['participants'][$i]['masteries'][$k]['masteryId'];
                        $keystonename = $result->fetchAll()[0]['name'];
                    }
                }

                $games = 0;
                $query = "SELECT COUNT(*), getPInt(".$r['participants'][$i]['summonerId'].", data, '.championId'),
                ROUND(AVG(getPInt(".$r['participants'][$i]['summonerId'].", data, '.stats.kills')), 2) as 'kills',
                ROUND(AVG(getPInt(".$r['participants'][$i]['summonerId'].", data, '.stats.deaths')), 2) as 'deaths',
                ROUND(AVG(getPInt(".$r['participants'][$i]['summonerId'].", data, '.stats.assists')), 2) as 'assists'
                FROM matches_".$region."_".$seasonCode."
                WHERE (".accountidEquals($r['participants'][$i]['summonerId']).") AND getPInt(".$r['participants'][$i]['summonerId'].", data, '.championId')=".$r['participants'][$i]['championId']."
                GROUP BY 2 ORDER BY 1 DESC";
                $result = $conn->prepare($query);
                $result->execute();
//                print_r_pre($query);
//                print_r_pre($result->errorInfo());
                $table = $result->fetchAll()[0];
                if($result->rowCount() > 0) {
                    $games = $table[0];
                    $kills = $table['kills'];
                    $deaths = $table['deaths'];
                    $assists = $table['assists'];
                } else {
                    $games = -1;
                    $kills = -1;
                    $deaths = -1;
                    $assists = -1;
                }

                echo ($r['participants'][$i]['summonerId']==$id?'<div class="current-player current-player-active">':'<div class="current-player">');
                echo '<div class="current-player-champion">'.getChampionIMG($champion['pic'], $champion['name'], $ddver_latest, 40, 40).'</div>';
                echo '<div class="current-player-spells">'.getSpellIMG($spell1['pic'], $spell1['name']).'<br>';
                echo getSpellIMG($spell2['pic'], $spell2['name']).'</div>';
                echo '<div class="current-player-keystone">'.getMasteryIMG($keystone, $keystonename).'</div>';
                echo '<div class="current-player-name">';
                echo '<a href="index.php?r='.$region.'&name='.$r['participants'][$i]['summonerName'].'" target="_blank">'.$r['participants'][$i]['summonerName'].'</a>';
                echo '</div>';
                echo '<div class="current-player-games">';
                echo '('.$games.') '.$kills.' / '.$deaths.' / '.$assists;
                echo '</div>';
                echo '</div>';
            }
        }
        echo '</div>';
        echo '<div class="current-red">';
        for($i=0; $i<count($r['participants']); $i++) {
            if($r['participants'][$i]['teamId'] == 200) {
                $query = 'SELECT id, name, pic FROM champions WHERE id='.$r['participants'][$i]['championId'];
                $result = $conn->prepare($query);
                $result->execute();
                $champion = $result->fetchAll()[0];

                $query = 'SELECT id, name, pic FROM spells WHERE id='.$r['participants'][$i]['spell1Id'];
                $result = $conn->prepare($query);
                $result->execute();
                $spell1 = $result->fetchAll()[0];

                $query = 'SELECT id, name, pic FROM spells WHERE id='.$r['participants'][$i]['spell2Id'];
                $result = $conn->prepare($query);
                $result->execute();
                $spell2 = $result->fetchAll()[0];

                $keystone = 0;
                $keystonename = '';
                for($k=0; $k<count($r['participants'][$i]['masteries']); $k++) {
                    $query = 'SELECT id, name FROM keystones WHERE id='.$r['participants'][$i]['masteries'][$k]['masteryId'];
                    $result = $conn->prepare($query);
                    $result->execute();
                    if($result->rowCount() > 0) {
                        $keystone = $r['participants'][$i]['masteries'][$k]['masteryId'];
                        $keystonename = $result->fetchAll()[0]['name'];
                    }
                }

                echo ($r['participants'][$i]['summonerId']==$id?'<div class="current-player current-player-active">':'<div class="current-player">');
                echo '<div class="current-player-champion">'.getChampionIMG($champion['pic'], $champion['name'], $ddver_latest, 40, 40).'</div>';
                echo '<div class="current-player-spells">'.getSpellIMG($spell1['pic'], $spell1['name']).'<br>';
                echo getSpellIMG($spell2['pic'], $spell2['name']).'</div>';
                echo '<div class="current-player-keystone">'.getMasteryIMG($keystone, $keystonename).'</div>';
                echo '<div class="current-player-name">';
                echo '<a href="index.php?r='.$region.'&name='.$r['participants'][$i]['summonerName'].'" target="_blank">'.$r['participants'][$i]['summonerName'].'</a>';
                echo '</div>';
                echo '</div>';
            }
        }
        echo '</div>';
        echo '</div>';
        if(array_key_exists('bannedChampions', $r)) {
            echo '<div class="current-bans">';
            echo '<div class="current-bans-blue">';
            echo 'Bans: ';
            for ($i = 0; $i < count($r['bannedChampions']); $i++) {
                if ($r['bannedChampions'][$i]['teamId'] == 100) {
                    $query = 'SELECT id, name, pic FROM champions WHERE id=' . $r['bannedChampions'][$i]['championId'];
                    $result = $conn->prepare($query);
                    $result->execute();
                    $champion = $result->fetchAll()[0];
                    echo getChampionIMG($champion['pic'], $champion['name']) . ' ';
                }
            }
            echo '</div>';
            echo '<div class="current-bans-red">';
            echo 'Bans: ';
            for ($i = 0; $i < count($r['bannedChampions']); $i++) {
                if ($r['bannedChampions'][$i]['teamId'] == 200) {
                    $query = 'SELECT id, name, pic FROM champions WHERE id=' . $r['bannedChampions'][$i]['championId'];
                    $result = $conn->prepare($query);
                    $result->execute();
                    $champion = $result->fetchAll()[0];
                    echo getChampionIMG($champion['pic'], $champion['name']) . ' ';
                }
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';

        echo '<pre>';
        print_r($r);
        echo '</pre>';

    } catch(Exception $e) {
        echo $username.' is not currently not in a game.';
    }


//    echo '</div>';
}



?>
<?php require_once 'footer.php'; ?>