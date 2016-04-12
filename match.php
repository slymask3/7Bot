<?php
$page = 'match';
$pagename = 'Match';
require_once 'header.php';

$matchid = '';
if(!empty($_GET['match'])) {
    $matchid = $_GET['match'];
}
$region = 'na';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}

$query ='SELECT matchid, CAST(data as CHAR) FROM matches_'.$region.' WHERE matchid='.$matchid;
$result = $conn->prepare($query);
$result->execute();
$match = json_decode(utf8_decode($result->fetchAll()[0][1]), true);

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

    $tkblue = 0;
    $tkred = 0;
    $tdblue = 0;
    $tdred = 0;
    for ($i = 0; $i < 10; $i++) {
        if ($match['participants'][$i]['team'] == 100) {
            $tkblue += $kills[$i];
            $tdblue += $deaths[$i];
        } else if ($match['participants'][$i]['team'] == 200) {
            $tkred += $kills[$i];
            $tdred += $deaths[$i];
        }
    }

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

    echo '<div class="about">';

    $queueString = getQueueString($queue);
    $seasonString = getSeasonString($season);

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

    $blueclass = '';
    $redclass = '';
    if ($winner == 100) {
        $blueclass = ' class="success"';
        $redclass = ' class="danger"';
    } else if ($winner == 200) {
        $blueclass = ' class="danger"';
        $redclass = ' class="success"';
    }

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