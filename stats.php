<?php
$page = 'stats';
$pagename = 'Statistics';
require_once 'header.php';
?>
<!--<div class="container">-->
<div class="div text-right" id="options">
<?php

$region = 'na';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}
$username = '';
if(!empty($_GET['name'])) {
    $username = $_GET['name'];
}
$season = '6';
if(!empty($_GET['s'])) {
    $season = $_GET['s'];
}
$queue = 'dynamic';
if(!empty($_GET['q'])) {
    $queue = $_GET['q'];
}

$query = 'SELECT * FROM accounts WHERE username LIKE "' . strtolower(str_replace(' ', '', $username)).'"';
$accres = $conn->prepare($query);
$accres->execute();
$account = $accres->fetchAll()[0];
//var_dump($account);
$displayname = $account['displayname'];
$icon = $account['icon'];
$tier = $account['tier'];
$rank = $account['tier'].' '.$account['division'].' '.$account['lp'].'LP';
$userid = $account['id'];
//var_dump($account, $icon, $tier, $rank);

$s6g = $account['s6'];
$s5g = $account['s5'];
$s4g = $account['s4'];
$s3g = $account['s3'];

$s6dynamic = $account['s6dynamic'];
$s6solo = $account['s6solo'];
$s6team5 = $account['s6team5'];
$s6team3 = $account['s6team3'];

$s5dynamic = $account['s5dynamic'];
$s5solo = $account['s5solo'];
$s5team5 = $account['s5team5'];
$s5team3 = $account['s5team3'];

$s4dynamic = $account['s4dynamic'];
$s4solo = $account['s4solo'];
$s4team5 = $account['s4team5'];
$s4team3 = $account['s4team3'];

$s3dynamic = $account['s3dynamic'];
$s3solo = $account['s3solo'];
$s3team5 = $account['s3team5'];
$s3team3 = $account['s3team3'];

if($season == 'merged') {
    $dbtable = strtoupper($region) . '_' . $account['id'] . '_MERGED';
} else {
    $dbtable = strtoupper($region) . '_' . $account['id'] . '_SEASON201' . $season . '_' . strtoupper($queue);
}

include_once 'createmerged.php';

if($accres->rowCount() > 0) {
    echo '<div class="div text-center" id="header"">';
    echo '<h2><img src="http://ddragon.leagueoflegends.com/cdn/6.5.1/img/profileicon/' . $icon . '.png" height="40px" width="40px" class="profileicon"/></h2>&nbsp;&nbsp;';
    echo '<h2 style="margin: 0px" data-text="'.$displayname.' - ">'.$displayname.'</h2>&nbsp;&nbsp;&nbsp;';
    echo '<h2><img src="assets/' . $tier . '.png" height="40px" width="40px" /></h2>';
    echo '<h2 style="margin: 0px" data-text="'.$rank.'">'.$rank.'</h2>';
    echo '</div>';

    $query39 = "SELECT matchid, c.pic FROM matches_$region LEFT JOIN champions c ON getPInt($accountid, data, '.championId')=c.id
        WHERE ".accountidEquals($accoutid)." ORDER BY 1 DESC LIMIT 1;";        $result39 = $conn->prepare($query39);
    $result39->execute();
    $recentchamppic = $result39->fetchAll()[0][1];

//        $query40 = 'SELECT count(*), c.pic FROM '.$dbtable.' LEFT JOIN champions c ON championid=c.id ORDER BY 1 DESC LIMIT 1;';
//        $result40 = $conn->prepare($query40);
//        $result40->execute();
//        $favchamppic = $result40->fetchAll()[0][1];

    if($result39->rowCount() > 0) {
        echo '
        <style>
        #maincontainer {
            background-image: url(http://ddragon.leagueoflegends.com/cdn/img/champion/splash/'.$recentchamppic.'_0.jpg);
        }
        </style>';
    }
}

if(!empty($username)) {
    echo '<div class="search-summoner">';
    echo '<form action="stats.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" value="'.$username.'" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '<button type="button" class="btn btn-danger" disabled data-toggle="tooltip" data-placement="top" title="Coming Soon"><i class="fa fa-arrow-circle-o-up"></i> Update</button>';
    echo '</form>';
    echo '</div>';
} else {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="stats.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '<button type="button" class="btn btn-danger" disabled data-toggle="tooltip" data-placement="top" title="Coming Soon"><i class="fa fa-arrow-circle-o-up"></i> Update</button>';
    echo '</form>';
    echo '</div>';
}

echo '</div>';

if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {
    $s6 = '';
    $s5 = '';
    $s4 = '';
    $s3 = '';
    $s6d = '';
    $s6s = '';
    $s6t5 = '';
    $s6t3 = '';
    $s5d = '';
    $s5s = '';
    $s5t5 = '';
    $s5t3 = '';
    $s4d = '';
    $s4s = '';
    $s4t5 = '';
    $s4t3 = '';
    $s3d = '';
    $s3s = '';
    $s3t5 = '';
    $s3t3 = '';
    $m = '';

    if ($season == '6') {
        $s6 = ' class="active"';
        if ($queue == 'dynamic') {
            $s6d = ' class="active"';
        } else if ($queue == 'solo') {
            $s6s = ' class="active"';
        } else if ($queue == 'team5') {
            $s6t5 = ' class="active"';
        } else if ($queue == 'team3') {
            $s6t3 = ' class="active"';
        }
    } else if ($season == '5') {
        $s5 = ' class="active"';
        if ($queue == 'dynamic') {
            $s5d = ' class="active"';
        } else if ($queue == 'solo') {
            $s5s = ' class="active"';
        } else if ($queue == 'team5') {
            $s5t5 = ' class="active"';
        } else if ($queue == 'team3') {
            $s5t3 = ' class="active"';
        }
    } else if ($season == '4') {
        $s4 = ' class="active"';
        if ($queue == 'dynamic') {
            $s4d = ' class="active"';
        } else if ($queue == 'solo') {
            $s4s = ' class="active"';
        } else if ($queue == 'team5') {
            $s4t5 = ' class="active"';
        } else if ($queue == 'team3') {
            $s4t3 = ' class="active"';
        }
    } else if ($season == '3') {
        $s3 = ' class="active"';
        if ($queue == 'dynamic') {
            $s3d = ' class="active"';
        } else if ($queue == 'solo') {
            $s3s = ' class="active"';
        } else if ($queue == 'team5') {
            $s3t5 = ' class="active"';
        } else if ($queue == 'team3') {
            $s3t3 = ' class="active"';
        }
    } else if ($season == 'merged') {
        $m = ' class="active"';
    }

    echo '<ul class="nav nav-tabs" id="navbartop">';
    if ($s6g) {
        echo '<li' . $s6 . '><a href="?r='.$region.'&name=' . $username . '&s=6&q=dynamic">Season 6</a></li>';
    }
    if ($s5g) {
        echo '<li' . $s5 . '><a href="?r='.$region.'&name=' . $username . '&s=5&q=solo">Season 5</a></li>';
    }
    if ($s4g) {
        echo '<li' . $s4 . '><a href="?r='.$region.'&name=' . $username . '&s=4&q=solo">Season 4</a></li>';
    }
    if ($s3g) {
        echo '<li' . $s3. '><a href="?r='.$region.'&name=' . $username . '&s=3&q=solo">Season 3</a></li>';
    }
    echo '<li' . $m. '><a href="?r='.$region.'&name=' . $username . '&s=merged">All Seasons</a></li>';
    echo '</ul>';

    if($season != 'merged') {
        echo '<ul class="nav nav-tabs" id="navbarbot">';
        if ($season == '6') {
            if ($s6dynamic) {
                echo '<li' . $s6d . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=dynamic">Dynamic</a></li>';
            }
            if ($s6solo) {
                echo '<li' . $s6s . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=solo">Solo/Duo</a></li>';
            }
            if ($s6team5) {
                echo '<li' . $s6t5 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team5">Team 5v5</a></li>';
            }
            if ($s6team3) {
                echo '<li' . $s6t3 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team3">Team 3v3</a></li>';
            }
        } else if ($season == '5') {
            if ($s5dynamic) {
                echo '<li' . $s5d . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=dynamic">Dynamic</a></li>';
            }
            if ($s5solo) {
                echo '<li' . $s5s . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=solo">Solo/Duo</a></li>';
            }
            if ($s5team5) {
                echo '<li' . $s5t5 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team5">Team 5v5</a></li>';
            }
            if ($s5team3) {
                echo '<li' . $s5t3 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team3">Team 3v3</a></li>';
            }
        } else if ($season == '4') {
            if ($s4dynamic) {
                echo '<li' . $s4d . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=dynamic">Dynamic</a></li>';
            }
            if ($s4solo) {
                echo '<li' . $s4s . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=solo">Solo/Duo</a></li>';
            }
            if ($s4team5) {
                echo '<li' . $s4t5 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team5">Team 5v5</a></li>';
            }
            if ($s4team3) {
                echo '<li' . $s4t3 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team3">Team 3v3</a></li>';
            }
        } else if ($season == '3') {
            if ($s3dynamic) {
                echo '<li' . $s3d . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=dynamic">Dynamic</a></li>';
            }
            if ($s3solo) {
                echo '<li' . $s3s . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=solo">Solo/Duo</a></li>';
            }
            if ($s3team5) {
                echo '<li' . $s3t5 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team5">Team 5v5</a></li>';
            }
            if ($s3team3) {
                echo '<li' . $s3t3 . '><a href="?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=team3">Team 3v3</a></li>';
            }
        }
        echo '</ul>';
    }

}

$rfav = $conn->prepare("SELECT count(*) FROM " . $dbtable);
$rfav->execute();
$numberofgames = $rfav->fetchAll()[0][0];

$totalpages = 1;

if(!empty($username) && $numberofgames > 0) {

    $rfav = $conn->prepare("SELECT
count(*),
getPInt(71460649, data, '.championId') as 'id',
c.pic as 'pic',
c.name as 'name'
FROM matches_na
LEFT JOIN champions c ON getPInt($userid, data, '.championId')=c.id
WHERE
CAST(json_extract(data, '$.participantIdentities[0].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[1].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[2].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[3].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[4].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[5].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[6].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[7].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[8].player.summonerId') as CHAR)=$userid OR
CAST(json_extract(data, '$.participantIdentities[9].player.summonerId') as CHAR)=$userid
GROUP BY 2,3,4
ORDER BY 1 DESC;");
    $rfav->execute();
    $favchamp = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " WHERE lane LIKE 'top' GROUP BY lane");
    $rfav->execute();
    $favtopt = $rfav->fetchAll()[0][0];

    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " WHERE lane LIKE 'jungle'  GROUP BY lane");
    $rfav->execute();
    $favjunglet = $rfav->fetchAll()[0][0];

    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " WHERE lane LIKE 'mid'  GROUP BY lane");
    $rfav->execute();
    $favmidt = $rfav->fetchAll()[0][0];

    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " WHERE lane LIKE 'adc'  GROUP BY lane");
    $rfav->execute();
    $favadct = $rfav->fetchAll()[0][0];

    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " WHERE lane LIKE 'support'  GROUP BY lane");
    $rfav->execute();
    $favsupportt = $rfav->fetchAll()[0][0];

    $rfav = $conn->prepare("SELECT count(*), lane, c.pic as 'championpic', c.name as 'champion' FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id WHERE lane LIKE 'top'  GROUP BY championpic ORDER BY 1 DESC");
    $rfav->execute();
    $favtop = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane, c.pic as 'championpic', c.name as 'champion' FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id WHERE lane LIKE 'jungle'  GROUP BY championpic ORDER BY 1 DESC");
    $rfav->execute();
    $favjungle = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane, c.pic as 'championpic', c.name as 'champion' FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id WHERE lane LIKE 'mid'  GROUP BY championpic ORDER BY 1 DESC");
    $rfav->execute();
    $favmid = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane, c.pic as 'championpic', c.name as 'champion' FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id WHERE lane LIKE 'adc'  GROUP BY championpic ORDER BY 1 DESC");
    $rfav->execute();
    $favadc = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane, c.pic as 'championpic', c.name as 'champion' FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id WHERE lane LIKE 'support'  GROUP BY championpic ORDER BY 1 DESC");
    $rfav->execute();
    $favsupport = $rfav->fetchAll();

//    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " GROUP BY lane ORDER BY 1 DESC");
//    $rfav->execute();
//    $favlane = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane, l.id FROM " . $dbtable . " LEFT JOIN laneorder l ON lane=l.name GROUP BY lane ORDER BY 3 ASC");
    $rfav->execute();
    $favlane = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), lane FROM " . $dbtable . " GROUP BY lane ORDER BY 1 DESC LIMIT 1");
    $rfav->execute();
    $mostplayedlane = $rfav->fetchAll()[0]['lane'];

    $rfav = $conn->prepare("SELECT count(*), spell1id, s.pic as 'pic', s.name as 'name' FROM " . $dbtable . " LEFT JOIN spells s ON spell1id=id GROUP BY spell1id ORDER BY 1 DESC");
    $rfav->execute();
    $favspell1 = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(*), spell2id, s.pic as 'pic', s.name as 'name' FROM " . $dbtable . " LEFT JOIN spells s ON spell2id=id GROUP BY spell2id ORDER BY 1 DESC");
    $rfav->execute();
    $favspell2 = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT MIN( c.game ) - a.game + 1 as 'Highest Winning Streak' FROM " . $dbtable . " AS a
LEFT JOIN " . $dbtable . " AS b ON a.game = b.game + 1 AND b.outcome= 'Win' LEFT JOIN " . $dbtable . " AS c ON a.game <= c.game AND c.outcome= 'Win' LEFT JOIN " . $dbtable . " AS d ON c.game = d.game - 1 AND d.outcome= 'Win'
WHERE a.outcome= 'Win' AND b.game IS NULL AND c.game IS NOT NULL AND d.game IS NULL
GROUP BY a.game
ORDER BY 1 DESC LIMIT 1");
    $rfav->execute();
    $winstreak = $rfav->fetchAll()[0];

    $rfav = $conn->prepare("SELECT MIN( c.game ) - a.game + 1 as 'Highest Losing Streak' FROM " . $dbtable . " AS a
LEFT JOIN " . $dbtable . " AS b ON a.game = b.game + 1 AND b.outcome= 'Loss' LEFT JOIN " . $dbtable . " AS c ON a.game <= c.game AND c.outcome= 'Loss' LEFT JOIN " . $dbtable . " AS d ON c.game = d.game - 1 AND d.outcome= 'Loss'
WHERE a.outcome= 'Loss' AND b.game IS NULL AND c.game IS NOT NULL AND d.game IS NULL
GROUP BY a.game
ORDER BY 1 DESC LIMIT 1");
    $rfav->execute();
    $losestreak = $rfav->fetchAll()[0];

    $rfav = $conn->prepare("SELECT count(item6), item6, ddver FROM " . $dbtable . " GROUP BY item6 ORDER BY 1 DESC");
    $rfav->execute();
    $favtrinket = $rfav->fetchAll();

    $favtrinketname = array();
    foreach($favtrinket as $trinket) {
        $ddver = explode('.',$trinket['ddver']);
        $rfavq = "SELECT id, name FROM items_".$ddver[0]."_".$ddver[1]."_".$ddver[2]." WHERE id=".$trinket['item6'];
        $rfav = $conn->prepare($rfavq);
        $rfav->execute();
        $trinket = $rfav->fetchAll()[0]['name'];
        array_push($favtrinketname, str_replace(' (Trinket)', '', $trinket));
    }

    //var_dump($favtrinketname);

    $rfav = $conn->prepare("SELECT count(g.item0) as 'a', g.item0, g.ddver FROM (
SELECT item0, ddver FROM ".$dbtable." UNION ALL
SELECT item1, ddver FROM ".$dbtable." UNION ALL
SELECT item2, ddver FROM ".$dbtable." UNION ALL
SELECT item3, ddver FROM ".$dbtable." UNION ALL
SELECT item4, ddver FROM ".$dbtable." UNION ALL
SELECT item5, ddver FROM ".$dbtable."
) g WHERE g.item0>0 GROUP BY g.item0 HAVING a>1 ORDER BY 1 DESC;");
    $rfav->execute();
    $favitems = $rfav->fetchAll();

    $favitemsname = array();
    foreach($favitems as $item) {
        $ddver = explode('.',$item['ddver']);
        $rfavq = "SELECT id, name FROM items_".$ddver[0]."_".$ddver[1]."_".$ddver[2]." WHERE id=".$item['item0'];
        $rfav = $conn->prepare($rfavq);
        $rfav->execute();
        $item = $rfav->fetchAll()[0]['name'];
        array_push($favitemsname, $item);
    }

    //var_dump($favitems, $favitemsname);

    $rfav = $conn->prepare("SELECT team, ROUND(SUM(CASE WHEN outcome = 'Win' then 1 else 0 end)/count(*) * 100, 0) as 'Winrate' FROM " . $dbtable . " GROUP BY team ORDER BY 1");
    $rfav->execute();
    $winrate = $rfav->fetchAll();//[0][1];
    $winrateblue = $winrate[0][1];
    $winratered = $winrate[1][1];

    $rfav = $conn->prepare("SELECT COUNT(*), HOUR(from_unixtime(creation/1000)) as 'Hour' FROM ".$dbtable." GROUP BY 2 ORDER BY 2 ASC");
    $rfav->execute();
    $hourmostplayed = $rfav->fetchAll();
    $hourmostplayedtime = $hourmostplayed[1] . ':00';
    if ($hourmostplayed[1] < 10) {
        $hourmostplayedtime = '0' . $hourmostplayed[1] . ':00';
    }

    $hoursplayed = array();
    for($i=0; $i<24; $i++) {
        $i2 = $i.':00';
        if($i<10) {
            $i2 = '0'.$i.':00';
        }
        $found = false;
        foreach($hourmostplayed as $hour) {
            if($hour[1] == $i) {
                $full = array((int)$hour[0], $i2);
                array_push($hoursplayed, $full);
                $found = true;
            }
        }
        if(!$found) {
            $empty = array(0, $i2);
            array_push($hoursplayed, $empty);
        }
    }

    //var_dump($hoursplayed);

    $rfav = $conn->prepare("SELECT COUNT(*), HOUR(from_unixtime(creation/1000)) as 'Hour', ROUND(SUM(CASE WHEN outcome = 'Win' then 1 else 0 end)/count(*) * 100, 0) as 'Winrate' FROM " . $dbtable . " GROUP BY 2 HAVING COUNT(*)!=1 ORDER BY 3 DESC LIMIT 1");
    $rfav->execute();
    $hourwinrate = $rfav->fetchAll()[0];
    $hourwinratetime = $hourwinrate[1] . ':00';
    if ($hourwinrate[1] < 10) {
        $hourwinratetime = '0' . $hourwinrate[1] . ':00';
    }

    $rfav = $conn->prepare("SELECT count(game), c.pic as 'championpic', ROUND(SUM(CASE WHEN outcome = 'Win' then 1 else 0 end)/count(*) * 100, 0) as 'Winrate', SUM(CASE WHEN outcome = 'Win' then 1 else 0 end) as 'Wins', champion FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id GROUP BY championpic /*HAVING COUNT(*)!=1*/ ORDER BY 3 DESC LIMIT 5");
    $rfav->execute();
    $winratechamp = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT count(game), lane, ROUND(SUM(CASE WHEN outcome = 'Win' then 1 else 0 end)/count(*) * 100, 0) as 'Winrate', SUM(CASE WHEN outcome = 'Win' then 1 else 0 end) as 'Wins' FROM " . $dbtable . " GROUP BY lane /*HAVING COUNT(*)!=1*/ ORDER BY 3 DESC LIMIT 5");
    $rfav->execute();
    $winratelane = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT SUM(length) FROM " . $dbtable);
    $rfav->execute();
    $timespent = $rfav->fetchAll()[0];

    $rfav = $conn->prepare("SELECT COUNT(*),  MINUTE(from_unixtime(length)) as 'Minutes' FROM ".$dbtable." GROUP BY 2 ORDER BY 2 ASC");
    $rfav->execute();
    $gamelength = $rfav->fetchAll();

    $rfav = $conn->prepare("SELECT COUNT(*), keystone, k.name as 'name', ddver FROM ".$dbtable." LEFT JOIN keystones k ON keystone=k.id GROUP BY keystone ORDER BY 1 DESC");
    $rfav->execute();
    $favkeystone = $rfav->fetchAll();

    echo '<div class="quickstats">';
    echo '<table>';
    echo '<tr><td>Number of Games:</td><td>'.$numberofgames.'</td></tr>';
    echo '<tr><td>Favorite Champion:</td><td>'.getChampionIMG($favchamp[0]['championpic'], $favchamp[0]['champion']).'</td></tr>';
    echo '<tr><td>Favorite Lane:</td><td>'.getLaneIMG($mostplayedlane).'</td></tr>';
    echo '<tr><td>Favorite Top:</td><td>'.getChampionIMG($favtop[0]['championpic'], $favtop[0]['champion']).'</td></tr>';
    echo '<tr><td>Favorite Jungler:</td><td>'.getChampionIMG($favjungle[0]['championpic'], $favjungle[0]['champion']).'</td></tr>';
    echo '<tr><td>Favorite Mid:</td><td>'.getChampionIMG($favmid[0]['championpic'], $favmid[0]['champion']).'</td></tr>';
    echo '<tr><td>Favorite ADC:</td><td>'.getChampionIMG($favadc[0]['championpic'], $favadc[0]['champion']).'</td></tr>';
    echo '<tr><td>Favorite Support:</td><td>'.getChampionIMG($favsupport[0]['championpic'], $favsupport[0]['champion']).'</td></tr>';
    echo '<tr><td>Favorite Spell on D:</td><td>'.getSpellIMG($favspell1[0]['pic'], $favspell1[0]['name']).'</td></tr>';
    echo '<tr><td>Favorite Spell on F:</td><td>'.getSpellIMG($favspell2[0]['pic'], $favspell2[0]['name']).'</td></tr>';
    echo '<tr><td>Favorite Keystone:</td><td>'.getMasteryIMG($favkeystone[0]['keystone'], $favkeystone[0]['name'], $favkeystone[0]['ddver']).'</td></tr>';
    echo '<tr><td>Favorite Item:</td><td>'.getItemIMG($favitems[0]['item0'], $favitemsname[0], $favitems[0]['ddver']).'</td></tr>';
    echo '<tr><td>Favorite Trinket:</td><td>'.getItemIMG($favtrinket[0]['item6'], $favtrinket[0], $favtrinket[0]['ddver']).'</td></tr>';
    echo '</table>';
    echo '</div>';

    echo '<div class="chart">';
    echo '<div class="onechart"><canvas id="favchamp"></canvas></div>';
    echo '<div class="middlechart"><canvas id="favlane"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favtop"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favjungler"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favmid"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favadc"></canvas></div>';
    echo '<div class="middlechart"><canvas id="favsupport"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favspell1"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favspell2"></canvas></div>';
    echo '<div class="onechart"><canvas id="favitems"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favtrinket"></canvas></div>';
    echo '<div class="sidechart"><canvas id="favkeystone"></canvas></div>';
    echo '<div class="onechart"><canvas id="hoursplayed"></canvas></div>';
    echo '<div class="onechart"><canvas id="gamelength"></canvas></div>';
    echo '</div>';

    echo '<span class="metadata" id="metadata-favchamp" title="'.count($favchamp).'"></span>';
    for($i=0; $i<count($favchamp); $i++) {
        echo '<span class="metadata" id="metadata-favchamp'.$i.'c" title="'.$favchamp[$i]['name'].'"></span>';
        echo '<span class="metadata" id="metadata-favchamp'.$i.'a" title="'.$favchamp[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favlane" title="'.count($favlane).'"></span>';
    for($i=0; $i<count($favlane); $i++) {
        if($favlane[$i]['lane'] != '') {
            echo '<span class="metadata" id="metadata-favlane'.$i.'l" title="'.$favlane[$i]['lane'].'"></span>';
            echo '<span class="metadata" id="metadata-favlane'.$i.'a" title="'.$favlane[$i][0].'"></span>';
        } else {
            echo '<span class="metadata" id="metadata-favlane'.$i.'l" title="N/A"></span>';
            echo '<span class="metadata" id="metadata-favlane'.$i.'a" title="'.$favlane[$i][0].'"></span>';
        }
    }

    echo '<span class="metadata" id="metadata-favtop" title="'.count($favtop).'"></span>';
    for($i=0; $i<count($favtop); $i++) {
        echo '<span class="metadata" id="metadata-favtop'.$i.'c" title="'.$favtop[$i]['champion'].'"></span>';
        echo '<span class="metadata" id="metadata-favtop'.$i.'a" title="'.$favtop[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favjungler" title="'.count($favjungle).'"></span>';
    for($i=0; $i<count($favjungle); $i++) {
        echo '<span class="metadata" id="metadata-favjungler'.$i.'c" title="'.$favjungle[$i]['champion'].'"></span>';
        echo '<span class="metadata" id="metadata-favjungler'.$i.'a" title="'.$favjungle[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favmid" title="'.count($favmid).'"></span>';
    for($i=0; $i<count($favmid); $i++) {
        echo '<span class="metadata" id="metadata-favmid'.$i.'c" title="'.$favmid[$i]['champion'].'"></span>';
        echo '<span class="metadata" id="metadata-favmid'.$i.'a" title="'.$favmid[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favadc" title="'.count($favadc).'"></span>';
    for($i=0; $i<count($favadc); $i++) {
        echo '<span class="metadata" id="metadata-favadc'.$i.'c" title="'.$favadc[$i]['champion'].'"></span>';
        echo '<span class="metadata" id="metadata-favadc'.$i.'a" title="'.$favadc[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favsupport" title="'.count($favsupport).'"></span>';
    for($i=0; $i<count($favsupport); $i++) {
        echo '<span class="metadata" id="metadata-favsupport'.$i.'c" title="'.$favsupport[$i]['champion'].'"></span>';
        echo '<span class="metadata" id="metadata-favsupport'.$i.'a" title="'.$favsupport[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favspell1" title="'.count($favspell1).'"></span>';
    for($i=0; $i<count($favspell1); $i++) {
        echo '<span class="metadata" id="metadata-favspell1'.$i.'c" title="'.$favspell1[$i]['name'].'"></span>';
        echo '<span class="metadata" id="metadata-favspell1'.$i.'a" title="'.$favspell1[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favspell2" title="'.count($favspell2).'"></span>';
    for($i=0; $i<count($favspell2); $i++) {
        echo '<span class="metadata" id="metadata-favspell2'.$i.'c" title="'.$favspell2[$i]['name'].'"></span>';
        echo '<span class="metadata" id="metadata-favspell2'.$i.'a" title="'.$favspell2[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favitems" title="'.count($favitems).'"></span>';
    for($i=0; $i<count($favitems); $i++) {
        echo '<span class="metadata" id="metadata-favitems'.$i.'c" title="'.$favitemsname[$i].'"></span>';
        echo '<span class="metadata" id="metadata-favitems'.$i.'a" title="'.$favitems[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favtrinket" title="'.count($favtrinket).'"></span>';
    for($i=0; $i<count($favtrinket); $i++) {
        echo '<span class="metadata" id="metadata-favtrinket'.$i.'c" title="'.$favtrinketname[$i].'"></span>';
        echo '<span class="metadata" id="metadata-favtrinket'.$i.'a" title="'.$favtrinket[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-hoursplayed" title="'.count($hoursplayed).'"></span>';
    for($i=0; $i<count($hoursplayed); $i++) {
        echo '<span class="metadata" id="metadata-hoursplayed'.$i.'c" title="'.$hoursplayed[$i][1].'"></span>';
        echo '<span class="metadata" id="metadata-hoursplayed'.$i.'a" title="'.$hoursplayed[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-gamelength" title="'.count($gamelength).'"></span>';
    for($i=0; $i<count($gamelength); $i++) {
        echo '<span class="metadata" id="metadata-gamelength'.$i.'c" title="'.$gamelength[$i][1].'"></span>';
        echo '<span class="metadata" id="metadata-gamelength'.$i.'a" title="'.$gamelength[$i][0].'"></span>';
    }

    echo '<span class="metadata" id="metadata-favkeystone" title="'.count($favkeystone).'"></span>';
    for($i=0; $i<count($favkeystone); $i++) {
        echo '<span class="metadata" id="metadata-favkeystone'.$i.'c" title="'.$favkeystone[$i]['name'].'"></span>';
        echo '<span class="metadata" id="metadata-favkeystone'.$i.'a" title="'.$favkeystone[$i][0].'"></span>';
    }
}

?>

<script>
var favchampc = new Array(document.getElementById("metadata-favchamp").title);
var favchampa = new Array(document.getElementById("metadata-favchamp").title);
for(var i=0; i<document.getElementById("metadata-favchamp").title; i++) {
    favchampc[i] = document.getElementById("metadata-favchamp"+i+"c").title;
    favchampa[i] = document.getElementById("metadata-favchamp"+i+"a").title;
}

var favlanel = new Array(document.getElementById("metadata-favlane").title);
var favlanea = new Array(document.getElementById("metadata-favlane").title);
for(var i=0; i<document.getElementById("metadata-favlane").title; i++) {
    favlanel[i] = document.getElementById("metadata-favlane"+i+"l").title;
    favlanea[i] = document.getElementById("metadata-favlane"+i+"a").title;
}

var favtopc = new Array(document.getElementById("metadata-favtop").title);
var favtopa = new Array(document.getElementById("metadata-favtop").title);
for(var i=0; i<document.getElementById("metadata-favtop").title; i++) {
    favtopc[i] = document.getElementById("metadata-favtop"+i+"c").title;
    favtopa[i] = document.getElementById("metadata-favtop"+i+"a").title;
}

var favjunglerc = new Array(document.getElementById("metadata-favjungler").title);
var favjunglera = new Array(document.getElementById("metadata-favjungler").title);
for(var i=0; i<document.getElementById("metadata-favjungler").title; i++) {
    favjunglerc[i] = document.getElementById("metadata-favjungler"+i+"c").title;
    favjunglera[i] = document.getElementById("metadata-favjungler"+i+"a").title;
}

var favmidc = new Array(document.getElementById("metadata-favmid").title);
var favmida = new Array(document.getElementById("metadata-favmid").title);
for(var i=0; i<document.getElementById("metadata-favmid").title; i++) {
    favmidc[i] = document.getElementById("metadata-favmid"+i+"c").title;
    favmida[i] = document.getElementById("metadata-favmid"+i+"a").title;
}

var favadcc = new Array(document.getElementById("metadata-favadc").title);
var favadca = new Array(document.getElementById("metadata-favadc").title);
for(var i=0; i<document.getElementById("metadata-favadc").title; i++) {
    favadcc[i] = document.getElementById("metadata-favadc"+i+"c").title;
    favadca[i] = document.getElementById("metadata-favadc"+i+"a").title;
}

var favsupportc = new Array(document.getElementById("metadata-favsupport").title);
var favsupporta = new Array(document.getElementById("metadata-favsupport").title);
for(var i=0; i<document.getElementById("metadata-favsupport").title; i++) {
    favsupportc[i] = document.getElementById("metadata-favsupport"+i+"c").title;
    favsupporta[i] = document.getElementById("metadata-favsupport"+i+"a").title;
}

var favspell1c = new Array(document.getElementById("metadata-favspell1").title);
var favspell1a = new Array(document.getElementById("metadata-favspell1").title);
for(var i=0; i<document.getElementById("metadata-favspell1").title; i++) {
    favspell1c[i] = document.getElementById("metadata-favspell1"+i+"c").title;
    favspell1a[i] = document.getElementById("metadata-favspell1"+i+"a").title;
}

var favspell2c = new Array(document.getElementById("metadata-favspell2").title);
var favspell2a = new Array(document.getElementById("metadata-favspell2").title);
for(var i=0; i<document.getElementById("metadata-favspell2").title; i++) {
    favspell2c[i] = document.getElementById("metadata-favspell2"+i+"c").title;
    favspell2a[i] = document.getElementById("metadata-favspell2"+i+"a").title;
}

var favitemsc = new Array(document.getElementById("metadata-favitems").title);
var favitemsa = new Array(document.getElementById("metadata-favitems").title);
for(var i=0; i<document.getElementById("metadata-favitems").title; i++) {
    favitemsc[i] = document.getElementById("metadata-favitems"+i+"c").title;
    favitemsa[i] = document.getElementById("metadata-favitems"+i+"a").title;
}

var favtrinketc = new Array(document.getElementById("metadata-favtrinket").title);
var favtrinketa = new Array(document.getElementById("metadata-favtrinket").title);
for(var i=0; i<document.getElementById("metadata-favtrinket").title; i++) {
    favtrinketc[i] = document.getElementById("metadata-favtrinket"+i+"c").title;
    favtrinketa[i] = document.getElementById("metadata-favtrinket"+i+"a").title;
}

var hoursplayedc = new Array(document.getElementById("metadata-hoursplayed").title);
var hoursplayeda = new Array(document.getElementById("metadata-hoursplayed").title);
for(var i=0; i<document.getElementById("metadata-hoursplayed").title; i++) {
    hoursplayedc[i] = document.getElementById("metadata-hoursplayed"+i+"c").title;
    hoursplayeda[i] = document.getElementById("metadata-hoursplayed"+i+"a").title;
}

var gamelengthc = new Array(document.getElementById("metadata-gamelength").title);
var gamelengtha = new Array(document.getElementById("metadata-gamelength").title);
for(var i=0; i<document.getElementById("metadata-gamelength").title; i++) {
    gamelengthc[i] = document.getElementById("metadata-gamelength"+i+"c").title;
    gamelengtha[i] = document.getElementById("metadata-gamelength"+i+"a").title;
}

var favkeystonec = new Array(document.getElementById("metadata-favkeystone").title);
var favkeystonea = new Array(document.getElementById("metadata-favkeystone").title);
for(var i=0; i<document.getElementById("metadata-favkeystone").title; i++) {
    favkeystonec[i] = document.getElementById("metadata-favkeystone"+i+"c").title;
    favkeystonea[i] = document.getElementById("metadata-favkeystone"+i+"a").title;
}

var barChartDataFavChamp = {
    labels: favchampc,
    datasets: [{
        label: 'Games',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: favchampa
    }]
};

var barChartDataFavLane = {
    labels: favlanel,
    datasets: [{
        label: 'Games',
        backgroundColor: [
                    "#400080",
                    "#197407",
                    "#B11414",
                    "#1DBC99",
                    "#D9C623",
                    "#C4C4C4"
                ],
        data: favlanea
    }]
};

var barChartDataFavTop = {
    labels: favtopc,
    datasets: [{
        label: 'Games',
        backgroundColor: "#400080",
        data: favtopa
    }]
};

var barChartDataFavJungler = {
    labels: favjunglerc,
    datasets: [{
        label: 'Games',
        backgroundColor: "#197407",
        data: favjunglera
    }]
};

var barChartDataFavMid = {
    labels: favmidc,
    datasets: [{
        label: 'Games',
        backgroundColor: "#B11414",
        data: favmida
    }]
};

var barChartDataFavADC = {
    labels: favadcc,
    datasets: [{
        label: 'Games',
        backgroundColor: "#1DBC99",
        data: favadca
    }]
};

var barChartDataFavSupport = {
    labels: favsupportc,
    datasets: [{
        label: 'Games',
        backgroundColor: "#D9C623",
        data: favsupporta
    }]
};

var barChartDataFavSpell1 = {
    labels: favspell1c,
    datasets: [{
        label: 'Games',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: favspell1a
    }]
};

var barChartDataFavSpell2 = {
    labels: favspell2c,
    datasets: [{
        label: 'Games',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: favspell2a
    }]
};

var barChartDataFavItems = {
    labels: favitemsc,
    datasets: [{
        label: 'Times Bought',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: favitemsa
    }]
};

var barChartDataFavTrinket = {
    labels: favtrinketc,
    datasets: [{
        label: 'Times Bought',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: favtrinketa
    }]
};

var barChartDataHoursPlayed = {
    labels: hoursplayedc,
    datasets: [{
        label: 'Games',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: hoursplayeda
    }]
};

var barChartDataGameLength = {
    labels: gamelengthc,
    datasets: [{
        label: 'Games',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: gamelengtha
    }]
};

var barChartDataFavKeystone = {
    labels: favkeystonec,
    datasets: [{
        label: 'Games',
        backgroundColor: "rgba(0,50,220,0.8)",
        data: favkeystonea
    }]
};

var borderRGB = 'rgb(27, 27, 27)';

    window.onload = function() {
        var ctx = document.getElementById("favchamp").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavChamp,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Champion' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favlane").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'pie',
            data: barChartDataFavLane,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Lane' }
            }
        });
        var ctx = document.getElementById("favtop").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavTop,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Top Laner' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favjungler").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavJungler,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Jungler' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favmid").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavMid,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Mid Laner' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favadc").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavADC,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite ADC' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favsupport").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavSupport,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: borderRGB,
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Favorite Support'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true   // minimum value will be 0.
                        }
                    }]
                }
            }
        });
        var ctx = document.getElementById("favspell1").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavSpell1,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Spell on D' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favspell2").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavSpell2,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Spell on F' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favitems").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavItems,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Items' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favtrinket").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavTrinket,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Trinkets' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("hoursplayed").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataHoursPlayed,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Time Played At' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("gamelength").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataGameLength,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Game Length in Minutes' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
        var ctx = document.getElementById("favkeystone").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartDataFavKeystone,
            options: {
                elements: { rectangle: { borderWidth: 2, borderColor: borderRGB, borderSkipped: 'bottom' } },
                responsive: true,
                legend: { position: 'top' },
                title: { display: true, text: 'Favorite Keystones' },
                scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] }
            }
        });
    };

</script>

<?php require_once 'footer.php'; ?>