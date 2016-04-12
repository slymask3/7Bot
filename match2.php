<?php
$page = 'match';
$pagename = 'Match';
require_once 'header.php';

//echo '<div class="container">';
//echo '<div class="about">';

$matchid = '';
if(!empty($_GET['match'])) {
    $matchid = $_GET['match'];
}
$region = '';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}

$api = new riotapi($region);

try {
    $query = createMatchesTableIfNotExists($region);
    $result = $conn->prepare($query);
    $result->execute();

    if(!empty($region) && !empty($matchid)) {

        $query = 'SELECT matchid FROM matches_' . strtoupper($region) . ' WHERE matchid=' . $matchid;
        $result = $conn->prepare($query);
        $result->execute();

        if ($result->rowCount() == 0) {
            echo '<div class="topinfo">Started: ' . date('Y/m/d H:i:s');
            $r = $api->getMatch($matchid);
            //echo '<pre>';
            //print_r($r);
            //echo '</pre>';
            $query = 'INSERT INTO matches_'.$region.' VALUES(:id, :game);';
            $result = $conn->prepare($query);
            $result->bindParam(':id', $matchid, PDO::PARAM_INT);
            $result->bindParam(':game', json_encode($r), PDO::PARAM_STR);
            $result->execute();
            echo 'Added game with match id of ' . $matchid . '.';
            echo '<div class="query">Ended: ' . date('Y/m/d H:i:s') . '</div>';
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
};

$query ='SELECT matchid, CAST(data as CHAR) FROM matches_'.$region.' WHERE matchid='.$matchid;
$result = $conn->prepare($query);
$result->execute();
$match = json_decode(utf8_decode($result->fetchAll()[0][1]), true);

//var_dump($query, $result->fetchAll(), $result->rowCount(), $match);

if($result->rowCount() > 0) {

    $creation = $match['matchCreation'];
    $length = $match['matchDuration'];
    $queue = $match['queueType'];
    $season = $match['season'];
    $mode = $match['matchMode'];
    $type = $match['matchType'];
    $version = $match['version'];
    $ddver = getDDVer($match['version']);
    $mapid = $match['mapId'];
    if($match['teams'][0]['winner']) {
        $winner = 100;
    } else {
        $winner = 200;
    }

//$participants = $r['participants'];
//$participantsI = $r['participantIdentities'];

//var_dump_pre($participants);

    $id = array();
    $name = array();
    $lane = array();
    $championsid = array();
    $championskey = array();
    $champions = array();
    $team = array();
    $spell1 = array();
    $spell2 = array();
    $item0 = array();
    $item1 = array();
    $item2 = array();
    $item3 = array();
    $item4 = array();
    $item5 = array();
    $item6 = array();
    $kills = array();
    $deaths = array();
    $assists = array();
    $damage = array();
    $gold = array();
    $cs = array();
    $wards = array();
    for ($i = 0; $i < 10; $i++) {
        array_push($id, $match['participantIdentiies'][$i]['summonerId']);
        array_push($name, $match['participantIdentiies'][$i]['summonerName']);
        array_push($lane,getCorrectLane($match, $i));
        array_push($championsid, $match['participants'][$i]['championId']);
//        array_push($championskey, $match['p' . $i . 'championpic']);
//        array_push($champions, $match['p' . $i . 'champion']);
        array_push($team, $match['participants'][$i]['teamId']);
        array_push($spell1, $match['participants'][$i]['spell1Id']);
        array_push($spell2, $match['participants'][$i]['spell2Id']);
        array_push($item0, $match['participants'][$i]['stats']['item0']);
        array_push($item1, $match['participants'][$i]['stats']['item1']);
        array_push($item2, $match['participants'][$i]['stats']['item2']);
        array_push($item3, $match['participants'][$i]['stats']['item3']);
        array_push($item4, $match['participants'][$i]['stats']['item4']);
        array_push($item5, $match['participants'][$i]['stats']['item5']);
        array_push($item6, $match['participants'][$i]['stats']['item6']);;
        array_push($kills, $match['participants'][$i]['stats']['kills']);
        array_push($deaths, $match['participants'][$i]['stats']['deaths']);
        array_push($assists, $match['participants'][$i]['stats']['assists']);
        array_push($damage, $match['participants'][$i]['stats']['totalDamageDealtToChampions']);
        array_push($gold, $match['participants'][$i]['stats']['goldEarned']);
        array_push($cs, $match['participants'][$i]['stats']['minionsKilled']+$match['participants'][$i]['stats']['neutralMinionsKilled']);
        array_push($wards, $match['participants'][$i]['stats']['wardsPlaced']);
    }

    $t1b1id = $match['teams'][0]['bans'][0]['championId'];
    $t1b1key = $match['t1b1key'];
    $t1b1champ = $match['t1b1champ'];

    $t1b2id = $match['teams'][0]['bans'][1]['championId'];
    $t1b2key = $match['t1b2key'];
    $t1b2champ = $match['t1b2champ'];

    $t1b3id = $match['teams'][0]['bans'][2]['championId'];
    $t1b3key = $match['t1b3key'];
    $t1b3champ = $match['t1b3champ'];

    $t2b1id = $match['teams'][1]['bans'][0]['championId'];
    $t2b1key = $match['t2b1key'];
    $t2b1champ = $match['t2b1champ'];

    $t2b2id = $match['teams'][1]['bans'][1]['championId'];
    $t2b2key = $match['t2b2key'];
    $t2b2champ = $match['t2b2champ'];

    $t2b3id = $match['teams'][1]['bans'][2]['championId'];
    $t2b3key = $match['t2b3key'];
    $t2b3champ = $match['t2b3champ'];

    $tkblue = 0;
    $tkred = 0;
    $tdblue = 0;
    $tdred = 0;
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100) {
            $tkblue += $kills[$i];
            $tdblue += $deaths[$i];
        } else if ($team[$i] == 200) {
            $tkred += $kills[$i];
            $tdred += $deaths[$i];
        }
    }

    /*echo '<div class="update">';
    echo '<ul class="nav nav-pills" id="navbarmain"><li><img src="assets/logo.png" /></li>
    <li><a href="index.php">Summoner</a></li>
    <li class="active"><a href="match.php">Match</a></li>
    <li><a href="toplist.php">Top List</a></li>
    <li><a href="about.php">About</a></li>
</ul>';
    echo '</div>';

    echo '<div class="div text-center" id="header">';
    echo '<h1 style="margin: 0px">' . $websitename . '</h1>';
    echo '<h2 style="margin: 0px">';
    echo 'Match ID: ' . $matchid;
    echo '</h2>';
    echo '</div>';*/

//    echo '<div class="div text-right" id="options">';
    if (!empty($matchid)) {
        echo '<div class="search-summoner no-summoner">';
        echo '<form action="match.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key == "r") {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo '<input type="text" class="form-control" name="name" placeholder="Enter a Match ID.." required />';
        echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<div class="search-summoner">';
        echo '<form action="match.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key == "r") {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo '<input type="number" class="form-control" name="name" value="'.$matchid.'" placeholder="Enter a Match ID.." required />';
        echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
        echo '</form>';
        echo '</div>';
    }
//    echo '</div>';

    echo '<div class="about">';

    $queueString = $queue;
    if($queue == 'CUSTOM') {
        $queueString = 'Custom Game';
    } else if($queue == 'NORMAL_5x5_BLIND') {
        $queueString = 'Normal 5v5 (Blind Pick)';
    } else if($queue == 'RANKED_SOLO_5x5') {
        $queueString = 'Ranked Solo 5v5';
    } else if($queue == 'RANKED_PREMADE_5x5') {
        $queueString = 'Ranked Team 5v5';
    } else if($queue == 'BOT_5x5') {
        $queueString = 'Bot Game 5v5';
    } else if($queue == 'NORMAL_3x3') {
        $queueString = 'Normal 3v3 (Blind Pick)';
    } else if($queue == 'RANKED_PREMADE_3x3') {
        $queueString = 'Ranked Team 3v3';
    } else if($queue == 'NORMAL_5x5_DRAFT') {
        $queueString = 'Normal 5v5 (Draft Pick)';
    } else if($queue == 'ODIN_5x5_BLIND') {
        $queueString = 'Odin 5v5 (Blind Pick)';
    } else if($queue == 'ODIN_5x5_DRAFT') {
        $queueString = 'Odin 5v5 (Draft Pick)';
    } else if($queue == 'BOT_ODIN_5x5') {
        $queueString = 'Odin Bot 5v5';
    } else if($queue == 'BOT_5x5_INTRO') {
        $queueString = 'Bot Game 5v5 (Intro)';
    } else if($queue == 'BOT_5x5_BEGINNER') {
        $queueString = 'Bot Game 5v5 (Beginner)';
    } else if($queue == 'BOT_5x5_INTERMEDIATE') {
        $queueString = 'Bot Game 5v5 (Intermediate)';
    } else if($queue == 'RANKED_TEAM_3x3') {
        $queueString = 'Ranked Team 3v3';
    } else if($queue == 'RANKED_TEAM_5x5') {
        $queueString = 'Ranked Team 5v5';
    } else if($queue == 'BOT_TT_3x3') {
        $queueString = 'Bot Game 3v3';
    } else if($queue == 'GROUP_FINDER_5x5') {
        $queueString = 'Team Builder 5v5';
    } else if($queue == 'ARAM_5x5') {
        $queueString = 'Aram';
    } else if($queue == 'ONEFORALL_5x5') {
        $queueString = 'One For All 5v5';
    } else if($queue == 'FIRSTBLOOD_1x1') {
        $queueString = 'Firstblood 1v1';
    } else if($queue == 'FIRSTBLOOD_2x2') {
        $queueString = 'Firstblood 2v2';
    } else if($queue == 'SR_6x6') {
        $queueString = 'Normal 6v6';
    } else if($queue == 'URF_5x5') {
        $queueString = 'URF 5v5';
    } else if($queue == 'ONEFORALL_MIRRORMODE_5x5') {
        $queueString = 'One For All Mirrormode 5v5';
    } else if($queue == 'BOT_URF_5x5') {
        $queueString = 'Bot Urf 5v5';
    } else if($queue == 'NIGHTMARE_BOT_5x5_RANK1') {
        $queueString = 'Nightmare Bots 5v5 (Rank 1)';
    } else if($queue == 'NIGHTMARE_BOT_5x5_RANK2') {
        $queueString = 'Nightmare Bots 5v5 (Rank 2)';
    } else if($queue == 'NIGHTMARE_BOT_5x5_RANK5') {
        $queueString = 'Nightmare Bots 5v5 (Rank 5)';
    } else if($queue == 'ASCENSION_5x5') {
        $queueString = 'Ascension 5v5';
    } else if($queue == 'HEXAKILL') {
        $queueString = 'Hexakill';
    } else if($queue == 'BILGEWATER_ARAM_5x5') {
        $queueString = 'Aram (Bilgewater)';
    } else if($queue == 'KING_PORO_5x5') {
        $queueString = 'King Poro';
    } else if($queue == 'COUNTER_PICK') {
        $queueString = 'Counter Pick';
    } else if($queue == 'BILGEWATER_5x5') {
        $queueString = 'Bilgewater 5v5';
    } else if($queue == 'TEAM_BUILDER_DRAFT_UNRANKED_5x5') {
        $queueString = 'Dynamic Normal 5v5';
    } else if($queue == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
        $queueString = 'Dynamic Ranked 5v5';
    }

    $seasonString = $season;
    if($season == 'PRESEASON3') {
        $seasonString = 'Pre-Season 3';
    } else if($season == 'SEASON3') {
        $seasonString = 'Season 3';
    } else if($season == 'PRESEASON2014') {
        $seasonString = 'Pre-Season 4';
    } else if($season == 'SEASON2014') {
        $seasonString = 'Season 4';
    } else if($season == 'PRESEASON2015') {
        $seasonString = 'Pre-Season 5';
    } else if($season == 'SEASON2014') {
        $seasonString = 'Season 5';
    } else if($season == 'PRESEASON2016') {
        $seasonString = 'Pre-Season 6';
    } else if($season == 'SEASON2016') {
        $seasonString = 'Season 6';
    }

    //echo '<div class="container">';
    echo '<div class="matchdetails">';
    echo 'Match ID: ' . $matchid;
    echo '<br>';
    echo 'Date Played: ' . date('Y/m/d H:i:s', $creation / 1000);
    echo '<br>';
    echo 'Length: ' . getTime($length);
    echo '<br>';
    echo 'Queue: ' . $queueString;
    echo '<br>';
    echo 'Season: ' . $seasonString;
    echo '</div>';
//echo '<br>';

    $blueclass = '';
    $redclass = '';
    if ($winner == 100) {
        $blueclass = ' class="success"';
        $redclass = ' class="danger"';
    } else if ($winner == 200) {
        $blueclass = ' class="danger"';
        $redclass = ' class="success"';
    }

    //echo '<div class="query">';

    $ka = 0;
    $da = 0;
    $aa = 0;
    $dmga = 0;
    $golda = 0;
    $csa = 0;
    $tka = 0;
    $tda = 0;
/////////////////////////////////////
    $kh = 0;
    $kl = 1000000;
    $dh = 0;
    $dl = 1000000;
    $ah = 0;
    $al = 1000000;
    $dmgh = 0;
    $dmgl = 1000000;
    $goldh = 0;
    $goldl = 1000000;
    $csh = 0;
    $csl = 1000000;
    $tkh = 0;
    $tkl = 1000000;
    $tdh = 0;
    $tdl = 1000000;
    for ($i = 0; $i < 10; $i++) {
        $ka += $kills[$i];
        $da += $deaths[$i];
        $aa += $assists[$i];
        $dmga += $damage[$i];
        $golda += $gold[$i];
        $csa += $cs[$i];
        if ($team[$i] == 100) {
            $tka += (($kills[$i] + $assists[$i]) / $tkblue) * 100;
            $tda += (($deaths[$i]) / $tdblue) * 100;
            if ((($kills[$i] + $assists[$i]) / $tkblue) * 100 > $tkh) {
                //echo 'is $i('.((($kills[$i] + $assists[$i]) / $tkblue) * 100).') > $tkh('.$tkh.') == yes<br>';
                $tkh = (($kills[$i] + $assists[$i]) / $tkblue) * 100;
            }
            if((($kills[$i] + $assists[$i]) / $tkblue) * 100 < $tkl) {
                $tkl = (($kills[$i] + $assists[$i]) / $tkblue) * 100;
            }
            if ((($deaths[$i]) / $tdblue) * 100 > $tdh) {
                $tdh = (($deaths[$i]) / $tdblue) * 100;
            }
            if((($deaths[$i]) / $tdblue) * 100 < $tdl) {
                $tdl = (($deaths[$i]) / $tdblue) * 100;
            }
        } else if ($team[$i] == 200) {
            $tka += (($kills[$i] + $assists[$i]) / $tkred) * 100;
            $tda += (($deaths[$i]) / $tdred) * 100;
            if ((($kills[$i] + $assists[$i]) / $tkred) * 100 > $tkh) {
                $tkh = (($kills[$i] + $assists[$i]) / $tkred) * 100;
            }
            if((($kills[$i] + $assists[$i]) / $tkred) * 100 < $tkl) {
                $tkl = (($kills[$i] + $assists[$i]) / $tkred) * 100;
            }
            if ((($deaths[$i]) / $tdred) * 100 > $tdh) {
                $tdh = (($deaths[$i]) / $tdred) * 100;
            }
            if((($deaths[$i]) / $tdred) * 100 < $tdl) {
                $tdl = (($deaths[$i]) / $tdred) * 100;
            }
        }
        /////////////////////////////////
        if ($kills[$i] > $kh) {
            $kh = $kills[$i];
        }
        if ($kills[$i] < $kl) {
            $kl = $kills[$i];
        }
        if ($deaths[$i] > $dh) {
            $dh = $deaths[$i];
        }
        if ($deaths[$i] < $dl) {
            $dl = $deaths[$i];
        }
        if ($assists[$i] > $ah) {
            $ah = $assists[$i];
        }
        if ($assists[$i] < $al) {
            $al = $assists[$i];
        }
        if ($damage[$i] > $dmgh) {
            $dmgh = $damage[$i];
        }
        if ($damage[$i] < $dmgl) {
            $dmgl = $damage[$i];
        }
        if ($gold[$i] > $goldh) {
            $goldh = $gold[$i];
        }
        if ($gold[$i] < $goldl) {
            $goldl = $gold[$i];
        }
        if ($cs[$i] > $csh) {
            $csh = $cs[$i];
        }
        if ($cs[$i] < $csl) {
            $csl = $cs[$i];
        }
    }
    $ka /= 10;
    $da /= 10;
    $aa /= 10;
    $dmga /= 10;
    $golda /= 10;
    $csa /= 10;
    $tka /= 10;
    $tda /= 10;

   /* echo '</div>';

    echo '<div class="query">';
    echo '$tkh = '.$tkh; echo '<br>';
    echo '$tkl = '.$tkl; echo '<br>';
    echo '$tdh = '.$tdh; echo '<br>';
    echo '$tdl = '.$tdl; echo '<br>';
    echo '</div>';*/

    echo '<table class="table table-striped" id="tableidm">';
    echo '<caption class="captionavg">Average</caption>';
    echo '<thead>';
    echo getMatchHeader();
    echo '</thead>';
    echo '<tbody>';
    echo '<tr class="info">';
    echo '<td class="avg">-</td>';
    echo '<td class="avg">-</td>';
    echo '<td class="avg">-</td>';
    echo '<td class="avg">-</td>';
    echo '<td class="avg">-</td>';
    echo '<td class="avg">-</td>';
    echo '<td class="avg">' . $ka . '</td>';
    echo '<td class="avg">' . $da . '</td>';
    echo '<td class="avg">' . $aa . '</td>';
    echo '<td class="avg">' . $dmga . '</td>';
    echo '<td class="avg">' . $golda . '</td>';
    echo '<td class="avg">' . $csa . '</td>';
    echo '<td class="avg">' . round($dmga / ($length / 60), 2) . '</td>';
    echo '<td class="avg">' . round($golda / ($length / 60), 2) . '</td>';
    echo '<td class="avg">' . round($csa / ($length / 60), 2) . '</td>';
    echo '<td class="avg">' . round($tka, 2) . '</td>';
    echo '<td class="avg">' . round($tda, 2) . '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';

    //echo '<div style="background-color: blue; padding: 5px; border: 1px solid black">';
    echo '<table class="table table-striped" id="tableidmblue">';
    echo '<caption class="captionblue">Blue Team - Bans:
        <img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/champion/' . $t1b1key . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/>
        <img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/champion/' . $t1b2key . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/>
        <img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/champion/' . $t1b3key . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/>
       - (' . $tkblue . '/' . $tdblue . ')</caption>';
    echo '<thead>';
    echo getMatchHeader();
    echo '</thead>';
    echo '<tbody>';
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100 && $lane[$i] == 'Top') {
            echo getMatchRow($conn, $match, $i, $blueclass, $tkblue, $tdblue, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100 && $lane[$i] == 'Jungle') {
            echo getMatchRow($conn, $match, $i, $blueclass, $tkblue, $tdblue, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100 && $lane[$i] == 'Mid') {
            echo getMatchRow($conn, $match, $i, $blueclass, $tkblue, $tdblue, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100 && $lane[$i] == 'ADC') {
            echo getMatchRow($conn, $match, $i, $blueclass, $tkblue, $tdblue, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100 && $lane[$i] == 'Support') {
            echo getMatchRow($conn, $match, $i, $blueclass, $tkblue, $tdblue, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 100 && $lane[$i] == '') {
            echo getMatchRow($conn, $match, $i, $blueclass, $tkblue, $tdblue, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    echo '</tbody>';
    echo '</table>';
    //echo '</div>';

    echo '<table class="table table-striped" id="tableidmred">';
    echo '<caption class="captionred">Red Team - Bans:
        <img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/champion/' . $t2b1key . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/>
        <img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/champion/' . $t2b2key . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/>
        <img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/champion/' . $t2b3key . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/>
       - (' . $tkred . '/' . $tdred . ')</caption>';
    echo '<thead>';
    echo getMatchHeader();
    echo '</thead>';
    echo '<tbody>';
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 200 && $lane[$i] == 'Top') {
            echo getMatchRow($conn, $match, $i, $redclass, $tkred, $tdred, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 200 && $lane[$i] == 'Jungle') {
            echo getMatchRow($conn, $match, $i, $redclass, $tkred, $tdred, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 200 && $lane[$i] == 'Mid') {
            echo getMatchRow($conn, $match, $i, $redclass, $tkred, $tdred, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 200 && $lane[$i] == 'ADC') {
            echo getMatchRow($conn, $match, $i, $redclass, $tkred, $tdred, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 200 && $lane[$i] == 'Support') {
            echo getMatchRow($conn, $match, $i, $redclass, $tkred, $tdred, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    for ($i = 0; $i < 10; $i++) {
        if ($team[$i] == 200 && $lane[$i] == '') {
            echo getMatchRow($conn, $match, $i, $redclass, $tkred, $tdred, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl);
        }
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="match.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="number" class="form-control" name="name" placeholder="Enter a Match ID.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';
}


//echo '</div>';

function getMatchRow($conn, $match, $i, $class, $tk, $td, $ka, $da, $aa, $dmga, $golda, $csa, $tka, $tda, $kh, $kl, $dh, $dl, $ah, $al, $dmgh, $dmgl, $goldh, $goldl, $csh, $csl, $tkh, $tkl, $tdh, $tdl) {
    $id = 0;
    if($_GET['player']) {
        $id = $_GET['player'];
    }

    $ek = '';
    $ed = '';
    $ea = '';
    $edmg = '';
    $egold = '';
    $ecs = '';
    $ekp = '';
    $edp = '';
    if($match['p'.$i.'kills'] == $kh) {
        $ek = ' class="highest"';
    } else if($match['p'.$i.'kills'] == $kl) {
        $ek = ' class="lowest"';
    } else if($match['p'.$i.'kills'] >= $ka) {
        $ek = ' id="aboveavg"';
    } else {
        $ek = ' id="belowavg"';
    }
    if($match['p'.$i.'deaths'] == $dl) {
        $ed = ' class="highest"';
    } else if($match['p'.$i.'deaths'] == $dh) {
        $ed = ' class="lowest"';
    } else if($match['p'.$i.'deaths'] <= $da) {
        $ed = ' id="aboveavg"';
    } else {
        $ed = ' id="belowavg"';
    }
    if($match['p'.$i.'assists'] == $ah) {
        $ea = ' class="highest"';
    } else if($match['p'.$i.'assists'] == $al) {
        $ea = ' class="lowest"';
    } else if($match['p'.$i.'assists'] >= $aa) {
        $ea = ' id="aboveavg"';
    } else {
        $ea = ' id="belowavg"';
    }
    if($match['p'.$i.'damage'] == $dmgh) {
        $edmg = ' class="highest"';
    } else if($match['p'.$i.'damage'] == $dmgl) {
        $edmg = ' class="lowest"';
    } else if($match['p'.$i.'damage'] >= $dmga) {
        $edmg = ' id="aboveavg"';
    } else {
        $edmg = ' id="belowavg"';
    }
    if($match['p'.$i.'gold'] == $goldh) {
        $egold = ' class="highest"';
    } else if($match['p'.$i.'gold'] == $goldl) {
        $egold = ' class="lowest"';
    } else if($match['p'.$i.'gold'] >= $golda) {
        $egold = ' id="aboveavg"';
    } else {
        $egold = ' id="belowavg"';
    }
    if($match['p'.$i.'cs'] == $csh) {
        $ecs = ' class="highest"';
    } else if($match['p'.$i.'cs'] == $csl) {
        $ecs = ' class="lowest"';
    } else if($match['p'.$i.'cs'] >= $csa) {
        $ecs = ' id="aboveavg"';
    } else {
        $ecs = ' id="belowavg"';
    }
    if((($match['p'.$i.'kills']+$match['p'.$i.'assists'])/$tk)*100 == $tkh) {
        $ekp = ' class="highest"';
    } else if((($match['p'.$i.'kills']+$match['p'.$i.'assists'])/$tk)*100 == $tkl) {
        $ekp = ' class="lowest"';
    } else if((($match['p'.$i.'kills']+$match['p'.$i.'assists'])/$tk)*100 >= $tka) {
        $ekp = ' id="aboveavg"';
    } else {
        $ekp = ' id="belowavg"';
    }
    if((($match['p'.$i.'deaths'])/$td)*100 == $tdl) {
        $edp = ' class="highest"';
    } else if((($match['p'.$i.'deaths'])/$td)*100 == $tdh) {
        $edp = ' class="lowest"';
    } else if((($match['p'.$i.'deaths'])/$td)*100 <= $tda) {
        $edp = ' id="aboveavg"';
    } else {
        $edp = ' id="belowavg"';
    }

    $rchamp = $conn->prepare('SELECT * FROM champions WHERE id='.$match['participants'][$i]['championId']);
    $rchamp->execute();
    $champ = $rchamp->fetchAll()[0]['pic'];

    $string = '';
    $string .= '<tr'.$class.'>';
    $string .= '<td><img src="assets/lane_' . getCorrectLane($match, $i) . '.png" width="20px" height="20px"/></td>';
    $string .= '<td><img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/champion/' . $champ . '.png" width="20px" height="20px"/></td>';
    $string .= '<td'.($match['p'.$i.'id'] == $id ? ' style="font-weight: bold"' : '').'><a href="index.php?r='.$match['region'].'&name='.$match['p'.$i.'name'].'">'.$match['p'.$i.'name'].'</a></td>';
    $string .= '<td><img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/spell/' . $match['p'.$i.'spell1'] . '.png" width="20px" height="20px"/><img src="http://ddragon.leagueoflegends.com/cdn/'.$match['ddver'].'/img/spell/' . $match['p'.$i.'spell2'] . '.png" width="20px" height="20px"/></td>';
    $string .= '<td>';
    $string .= ($match['p'.$i.'item0'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item0'] . '.png" width="20px" height="20px"/>' : '';
    $string .= ($match['p'.$i.'item1'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item1'] . '.png" width="20px" height="20px"/>' : '';
    $string .= ($match['p'.$i.'item2'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item2'] . '.png" width="20px" height="20px"/>' : '';
    $string .= ($match['p'.$i.'item3'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item3'] . '.png" width="20px" height="20px"/>' : '';
    $string .= ($match['p'.$i.'item4'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item4'] . '.png" width="20px" height="20px"/>' : '';
    $string .= ($match['p'.$i.'item5'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item5'] . '.png" width="20px" height="20px"/>' : '';
    $string .= '</td>';
    $string .= '<td>'.(($match['p'.$i.'item6'] != 0) ? '<img src="http://ddragon.leagueoflegends.com/cdn/'.getDDVer($match['matchVersion']).'/img/item/' . $match['participants'][$i]['stats']['item6'] . '.png" width="20px" height="20px"/>' : '').'</td>';
    $string .= '<td'.$ek.'>'.$match['participants'][$i]['stats']['kills'].'</td>';
    $string .= '<td'.$ed.'>'.$match['participants'][$i]['stats']['deaths'].'</td>';
    $string .= '<td'.$ea.'>'.$match['participants'][$i]['stats']['assists'].'</td>';
    $string .= '<td'.$edmg.'>'.$match['participants'][$i]['stats']['totalDamageDealtToChampions'].'</td>';
    $string .= '<td'.$egold.'>'.$match['participants'][$i]['stats']['goldEarned'].'</td>';
    $string .= '<td'.$ecs.'>'.($match['participants'][$i]['stats']['minionsKilled']+$match['participants'][$i]['stats']['neutralMinionsKilled']).'</td>';
    $string .= '<td'.$edmg.'>'.round($match['participants'][$i]['stats']['totalDamageDealtToChampions']/($match['matchDuration']/60), 2).'</td>';
    $string .= '<td'.$egold.'>'.round($match['participants'][$i]['stats']['goldEarned']/($match['matchDuration']/60), 2).'</td>';
    $string .= '<td'.$ecs.'>'.round(($match['participants'][$i]['stats']['minionsKilled']+$match['participants'][$i]['stats']['neutralMinionsKilled'])/($match['matchDuration']/60), 2).'</td>';
    $string .= '<td'.$ekp.'>'.round((($match['participants'][$i]['stats']['kills']+$match['assists'])/$tk)*100, 2).'</td>';
    $string .= '<td'.$edp.'>'.round((($match['participants'][$i]['stats']['deaths'])/$td)*100, 2).'</td>';
    $string .= '</tr>';

    return $string;
}

function getMatchHeader() {
    $string = '';
    $string .= '<th>Lane</th>';
    $string .= '<th>Champion</th>';
    $string .= '<th>Player</th>';
    $string .= '<th>Spells</th>';
    $string .= '<th>Items</th>';
    $string .= '<th>Trinket</th>';
    $string .= '<th>K</th>';
    $string .= '<th>D</th>';
    $string .= '<th>A</th>';
    $string .= '<th>Damage</th>';
    $string .= '<th>Gold</th>';
    $string .= '<th>CS</th>';
    $string .= '<th>Dmg/min</th>';
    $string .= '<th>Gold/min</th>';
    $string .= '<th>CS/min</th>';
    $string .= '<th>KP%</th>';
    $string .= '<th>DP%</th>';
    return $string;
}

?>



<?php require_once 'footer.php'; ?>