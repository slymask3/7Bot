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

if($accres->rowCount() > 0) {
    echo '<div class="div text-center" id="header"">';
    echo '<h2><img src="http://ddragon.leagueoflegends.com/cdn/6.5.1/img/profileicon/' . $icon . '.png" height="40px" width="40px" class="profileicon"/></h2>&nbsp;&nbsp;';
    echo '<h2 style="margin: 0px" data-text="'.$displayname.' - ">'.$displayname.'</h2>&nbsp;&nbsp;&nbsp;';
    echo '<h2><img src="assets/' . $tier . '.png" /></h2>';
    echo '<h2 style="margin: 0px" data-text="'.$rank.'">'.$rank.'</h2>';
    echo '</div>';

    $query39 = 'SELECT creation, c.pic FROM '.$dbtable.' LEFT JOIN champions c ON championid=c.id ORDER BY creation DESC LIMIT 1;';
        $result39 = $conn->prepare($query39);
        $result39->execute();
        $recentchamppic = $result39->fetchAll()[0][1];

        $query40 = 'SELECT count(*), c.pic FROM '.$dbtable.' LEFT JOIN champions c ON championid=c.id ORDER BY 1 DESC LIMIT 1;';
        $result40 = $conn->prepare($query40);
        $result40->execute();
        $favchamppic = $result40->fetchAll()[0][1];

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
    echo '<form action="stats.php" method="get" class="form text-right">';
    echo '<label for="r">Region:</label> ';
    echo '<select name="r" id="r" style="height:26px;"> ';

    $query = "SELECT * FROM regions ORDER BY 1 ASC";
    $result = $conn->prepare($query);
    $result->execute();
    $table = $result->fetchAll();

    foreach($table as $row) {
        if($row['region'] == $region) {
            echo '<option value="'.$row['region'].'" selected>'.$row['name'].'</option>';
        } else {
            echo '<option value="'.$row['region'].'">'.$row['name'].'</option>';
        }
    }

    echo '</select> ';
    echo '<label for="name">Username:</label> ';
    echo '<input type="text" id="name" name="name" value="' . $username . '" class="inputbox" /> ';
    //echo '<input type="submit" value="Search" class="btn btn-success" />';
    echo '<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
} else {
    echo '<div class="text-center" id="search">';
    echo '<table align="center">';
    echo '<tr>';
    echo '<td class="text-right">';
    echo '<form action="stats.php" method="get">';
    echo '<label for="r">Region:</label> ';
    echo '</td><td>';
    echo '<select name="r" id="r" class="inputbox"> ';

    $query = "SELECT * FROM regions ORDER BY 1 ASC";
    $result = $conn->prepare($query);
    $result->execute();
    $table = $result->fetchAll();

    foreach($table as $row) {
        if($row['region'] == $region) {
            echo '<option value="'.$row['region'].'" selected>'.$row['name'].'</option>';
        } else {
            echo '<option value="'.$row['region'].'">'.$row['name'].'</option>';
        }
    }

    echo '</select>';
    echo '</td>';
    echo '<tr>';
    echo '<td class="text-right">';
    echo '<label for="name">Username:</label>';
    echo '</td><td>';
    echo '<input type="text" id="name" name="name" class="inputbox" />';
    echo '</td></tr><tr><td></td><td class="text-right">';
    //echo '<input type="submit" value="Search" class="btn btn-success" />';
    echo '<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</td></tr></table></div>';
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
//    echo '<div class="stats">';
//    if ($season == 'merged') {
//        echo '<p><b>Stats for ' . $displayname . ' in all Seasons:</b></p>';
//    } else {
//        echo '<p><b>Stats for ' . $displayname . ' in Season ' . $season . ' and queue type ' . $queue . ':</b></p>';
//    }
//    echo '<div style="display: inline-block"><table>';

    $rfav = $conn->prepare("SELECT count(*), c.pic as 'championpic', c.name as 'champion' FROM " . $dbtable . " LEFT JOIN champions c ON championid=c.id GROUP BY championpic ORDER BY 1 DESC");
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

    $rfav = $conn->prepare("SELECT count(item6), item6, ddver FROM " . $dbtable . " GROUP BY item6 ORDER BY 1 DESC LIMIT 5");
    $rfav->execute();
    $favtrinket = $rfav->fetchAll();

//    $rfav = $conn->prepare("SELECT item0, item1, item2, item3, item4, item5 FROM " . $dbtable);
//    $rfav->execute();
//    $items2 = $rfav->fetchAll();
//    $items = array();
//    foreach ($items2 as $row) {
//        if ($row[0] != 0) {
//            array_push($items, $row[0]);
//        };
//        if ($row[1] != 0) {
//            array_push($items, $row[1]);
//        };
//        if ($row[2] != 0) {
//            array_push($items, $row[2]);
//        };
//        if ($row[3] != 0) {
//            array_push($items, $row[3]);
//        };
//        if ($row[4] != 0) {
//            array_push($items, $row[4]);
//        };
//        if ($row[5] != 0) {
//            array_push($items, $row[5]);
//        };
//    }
//    $c = array_count_values($items);
//    $favitem = array_search(max($c), $c);
    $rfav = $conn->prepare("SELECT count(g.item0), g.item0, g.ddver FROM (
SELECT item0, i.name, ddver FROM ".$dbtable." UNION ALL
SELECT item1, i.name, ddver FROM ".$dbtable." UNION ALL
SELECT item2, i.name, ddver FROM ".$dbtable." UNION ALL
SELECT item3, i.name, ddver FROM ".$dbtable." UNION ALL
SELECT item4, i.name, ddver FROM ".$dbtable." UNION ALL
SELECT item5, i.name, ddver FROM ".$dbtable."
) g WHERE g.item0>0 GROUP BY g.item0 ORDER BY 1 DESC;");
    $rfav->execute();
    $favitems = $rfav->fetchAll();

//    $ddver = explode('.', $favitems[]);
//
//    $rfav = $conn->prepare("SELECT count(g.item0), g.item0, g.ddver FROM (
//SELECT item0, i.name, ddver FROM ".$dbtable." UNION ALL
//SELECT item1, i.name, ddver FROM ".$dbtable." UNION ALL
//SELECT item2, i.name, ddver FROM ".$dbtable." UNION ALL
//SELECT item3, i.name, ddver FROM ".$dbtable." UNION ALL
//SELECT item4, i.name, ddver FROM ".$dbtable." UNION ALL
//SELECT item5, i.name, ddver FROM ".$dbtable."
//) g LEFT JOIN items_6_5_1 i ON g.item0=i.id WHERE g.item0>0 GROUP BY g.item0 ORDER BY 1 DESC;");


//    $rfav = $conn->prepare("SELECT item0, item1, item2, item3, item4, item5, ddver FROM " . $dbtable . " WHERE item0=" . $favitem . " OR item1=" . $favitem . " OR item2=" . $favitem . " OR item3=" . $favitem . " OR item4=" . $favitem . " OR item5=" . $favitem . " LIMIT 1");
//    $rfav->execute();
//    $favitemddver = $rfav->fetchAll()[0][6];

    $favitemsname = array(count($favitems));
    foreach($favitems as $item) {
        $ddver = explode('.',$item['ddver']);
        $rfavq = "SELECT id, name FROM items_".$ddver[0]."_".$ddver[1]."_".$ddver[2]." WHERE id=".$item['item0'];
        $rfav = $conn->prepare($rfavq);
        $rfav->execute();
        array_push($favitemsname, $rfav->fetchAll()[0]['name']);
    }

    $rfav = $conn->prepare("SELECT team, ROUND(SUM(CASE WHEN outcome = 'Win' then 1 else 0 end)/count(*) * 100, 0) as 'Winrate' FROM " . $dbtable . " GROUP BY team ORDER BY 1");
    $rfav->execute();
    $winrate = $rfav->fetchAll();//[0][1];
    $winrateblue = $winrate[0][1];
    $winratered = $winrate[1][1];

    $rfav = $conn->prepare("SELECT COUNT(*), HOUR(from_unixtime(creation/1000)) as 'Hour' FROM " . $dbtable . " GROUP BY 2 ORDER BY 1 DESC LIMIT 1");
    $rfav->execute();
    $hourmostplayed = $rfav->fetchAll()[0];
    $hourmostplayedtime = $hourmostplayed[1] . ':00';
    if ($hourmostplayed[1] < 10) {
        $hourmostplayedtime = '0' . $hourmostplayed[1] . ':00';
    }

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


    //echo '<tr><td>Favorite Champion:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $favchamp['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td>' . (int)$favchamp[0] . '/' . $numberofgames . '</td><td style="text-align: left">|' . round(($favchamp[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';
    //echo '<tr><td>Favorite Lane:</td><td><img src="assets/lane_' . $favlane['lane'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)$favlane[0] . '/' . (int)$numberofgames . '</td><td style="text-align: left">|' . round(($favlane[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';
    //echo '<tr><td>Favorite Top:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $favtop['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td>' . (int)$favtop[0] . '/' . (int)$favtopt[0] . '</td><td style="text-align: left">|' . round(($favtop[0] / $favtopt[0]) * 100, 0) . '% of all top games</td></tr>';
    //echo '<tr><td>Favorite Jungler:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $favjungle['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td>' . (int)$favjungle[0] . '/' . (int)$favjunglet[0] . '</td><td style="text-align: left">|' . round(($favjungle[0] / $favjunglet[0]) * 100, 0) . '% of all jungle games</td></tr>';
    //echo '<tr><td>Favorite Mid:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $favmid['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td>' . (int)$favmid[0] . '/' . (int)$favmidt[0] . '</td><td style="text-align: left">|' . round(($favmid[0] / $favmidt[0]) * 100, 0) . '% of all mid games</td></tr>';
    //echo '<tr><td>Favorite ADC:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $favadc['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td>' . (int)$favadc[0] . '/' . (int)$favadct[0] . '</td><td style="text-align: left">|' . round(($favadc[0] / $favadct[0]) * 100, 0) . '% of all adc games</td></tr>';
    //echo '<tr><td>Favorite Support:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $favsupport['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td>' . (int)$favsupport[0] . '/' . (int)$favsupportt[0] . '</td><td style="text-align: left">|' . round(($favsupport[0] / $favsupportt[0]) * 100, 0) . '% of all support games</td></tr>';

    //echo '</table></div><div style="display: inline-block"><table>';

    //echo '<tr><td>Highest Winrate Champion:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/champion/' . $winratechamp['championpic'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)$winratechamp[3] . '/' . (int)$winratechamp[0] . '</td><td style="text-align: left">|' . $winratechamp[2] . '% winrate</td></tr>';
    //echo '<tr><td>Highest Winrate Lane:</td><td><img src="assets/lane_' . $winratelane['lane'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)$winratelane[3] . '/' . (int)$winratelane[0] . '</td><td style="text-align: left">|' . $winratelane[2] . '% winrate</td></tr>';
    //echo '<tr><td>Favorite Spell on D:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/spell/' . $favspell1['spell1'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)$favspell1[0] . '/' . (int)$numberofgames . '</td><td style="text-align: left">|' . round(($favspell1[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';
    //echo '<tr><td>Favorite Spell on F:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/spell/' . $favspell2['spell2'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)$favspell2[0] . '/' . (int)$numberofgames . '</td><td style="text-align: left">|' . round(($favspell2[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';
    //echo '<tr><td>Favorite Item:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/' . $favitemddver . '/img/item/' . $favitem . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)max($c) . '/' . (int)$numberofgames . ' </td><td style="text-align: left">|Bought in ' . round((max($c) / $numberofgames) * 100, 0) . '% of all games</td></tr>';
    //echo '<tr><td>Favorite Trinket:</td><td><img src="http://ddragon.leagueoflegends.com/cdn/6.4.1/img/item/' . $favtrinket['item6'] . '.png" width="20px" height="20px" onerror="' . $imgerr . '"/></td><td> ' . (int)$favtrinket[0] . '/' . (int)$numberofgames . '</td><td style="text-align: left">|Bought in ' . round(($favtrinket[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';

    //echo '</table></div><div style="display: inline-block"><table>';

    //echo '<table>';
    ///echo '<tr><td>Highest Win Streak:</td><td>' . $winstreak[0] . '</td></tr>';
    //echo '<tr><td>Highest Loss Streak:</td><td>' . $losestreak[0] . '</td></tr>';
//    echo '<div style="display: inline-block"><table>';
//    echo '<tr><td>Winrate on Blue Team:</td><td>' . $winrateblue . '%</td></tr>';
//    echo '<tr><td>Winrate on Red Team:</td><td>' . $winratered . '%</td></tr>';
//    echo '<tr><td>Most played games at:</td><td>' . $hourmostplayedtime . '</td><td style="text-align: left">|' . round(($hourmostplayed[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';
//    echo '<tr><td>Most won games at:</td><td>' . $hourwinratetime . '</td><td style="text-align: left">|' . $hourwinrate[2] . '% winrate with ' . $hourwinrate[0] . ' games</td></tr>';
//    echo '<tr><td>Total time spent</td><td>playing:</td><td>' . secondsToTime($timespent[0]) . '</td></tr>';
//    echo '</table></div>';



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
    echo '</div>';

    $ddver = explode('.', $favitemddver);

    $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$favitem;
    $result = $conn->prepare($query);
    $result->execute();
    $favitemname = $result->fetchAll()[0]['name'];

    $ddver = explode('.', $favtrinket[0]['ddver']);
    $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$favtrinket[0]['item6'];
    $result = $conn->prepare($query);
    $result->execute();
    $favtrinket1 = $result->fetchAll()[0]['name'];

    $ddver = explode('.', $favtrinket[1]['ddver']);
    $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$favtrinket[1]['item6'];
    $result = $conn->prepare($query);
    $result->execute();
    $favtrinket2 = $result->fetchAll()[0]['name'];

    $ddver = explode('.', $favtrinket[2]['ddver']);
    $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$favtrinket[2]['item6'];
    $result = $conn->prepare($query);
    $result->execute();
    $favtrinket3 = $result->fetchAll()[0]['name'];

    $ddver = explode('.', $favtrinket[3]['ddver']);
    $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$favtrinket[3]['item6'];
    $result = $conn->prepare($query);
    $result->execute();
    $favtrinket4 = $result->fetchAll()[0]['name'];

    $ddver = explode('.', $favtrinket[4]['ddver']);
    $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$favtrinket[4]['item6'];
    $result = $conn->prepare($query);
    $result->execute();
    $favtrinket5 = $result->fetchAll()[0]['name'];

//    echo '<table class="table table-striped" id="tableid">';
//    echo '<thead>';
//    echo '<th></th>';
//    echo '<th>1</th>';
//    echo '<th>2</th>';
//    echo '<th>3</th>';
//    echo '<th>4</th>';
//    echo '<th>5</th>';
//    echo '</thead>';
//    echo '<tbody>';
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2">Favorite Champion</td>';
//    echo '<td>'.getChampionIMG($favchamp[0]['championpic'], $favchamp[0]['champion']).' '.(int)$favchamp[0][0] . '/' . (int)$numberofgames.' ('.round(($favchamp[0][0] / $numberofgames) * 100, 0) . '%)';
//    echo '<td>'.getChampionIMG($favchamp[1]['championpic'], $favchamp[1]['champion']).' '.(int)$favchamp[1][0] . '/' . (int)$numberofgames.' ('.round(($favchamp[1][0] / $numberofgames) * 100, 0) . '%)';
//    echo '<td>'.getChampionIMG($favchamp[2]['championpic'], $favchamp[2]['champion']).' '.(int)$favchamp[2][0] . '/' . (int)$numberofgames.' ('.round(($favchamp[2][0] / $numberofgames) * 100, 0) . '%)';
//    echo '<td>'.getChampionIMG($favchamp[3]['championpic'], $favchamp[3]['champion']).' '.(int)$favchamp[3][0] . '/' . (int)$numberofgames.' ('.round(($favchamp[3][0] / $numberofgames) * 100, 0) . '%)';
//    echo '<td>'.getChampionIMG($favchamp[4]['championpic'], $favchamp[4]['champion']).' '.(int)$favchamp[4][0] . '/' . (int)$numberofgames.' ('.round(($favchamp[4][0] / $numberofgames) * 100, 0) . '%)';
//    echo '</tr>';
//    echo getProgressBarTR('champion', $favchamp, $numberofgames);
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2">Favorite Lane</td>';
//    echo '<td>'.getLaneIMG($favlane[0]['lane']).' '.(int)$favlane[0][0] . '/' . (int)$numberofgames.' ('.round(($favlane[0][0] / $numberofgames) * 100, 0) . '%)</td>';
//    echo '<td>'.getLaneIMG($favlane[1]['lane']).' '.(int)$favlane[1][0] . '/' . (int)$numberofgames.' ('.round(($favlane[1][0] / $numberofgames) * 100, 0) . '%)</td>';
//    echo '<td>'.getLaneIMG($favlane[2]['lane']).' '.(int)$favlane[2][0] . '/' . (int)$numberofgames.' ('.round(($favlane[2][0] / $numberofgames) * 100, 0) . '%)</td>';
//    echo '<td>'.getLaneIMG($favlane[3]['lane']).' '.(int)$favlane[3][0] . '/' . (int)$numberofgames.' ('.round(($favlane[3][0] / $numberofgames) * 100, 0) . '%)</td>';
//    echo '<td>'.getLaneIMG($favlane[4]['lane']).' '.(int)$favlane[4][0] . '/' . (int)$numberofgames.' ('.round(($favlane[4][0] / $numberofgames) * 100, 0) . '%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('lane', $favlane, $numberofgames);
//    echo '<tr class="rownew">';
//    echo '<td class="rowthead" rowspan="2">Favorite Top</td>';
//    echo '<td>'.getChampionIMG($favtop[0]['championpic'], $favtop[0]['champion']).' '.(int)$favtop[0][0] . '/' . (int)$favtopt.' ('.round(($favtop[0][0] / $favtopt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favtop[1]['championpic'], $favtop[1]['champion']).' '.(int)$favtop[1][0] . '/' . (int)$favtopt.' ('.round(($favtop[1][0] / $favtopt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favtop[2]['championpic'], $favtop[2]['champion']).' '.(int)$favtop[2][0] . '/' . (int)$favtopt.' ('.round(($favtop[2][0] / $favtopt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favtop[3]['championpic'], $favtop[3]['champion']).' '.(int)$favtop[3][0] . '/' . (int)$favtopt.' ('.round(($favtop[3][0] / $favtopt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favtop[4]['championpic'], $favtop[4]['champion']).' '.(int)$favtop[4][0] . '/' . (int)$favtopt.' ('.round(($favtop[4][0] / $favtopt) * 100, 0) . '%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('champion', $favtop, $favtopt);
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2">Favorite Jungler</td>';
//    echo '<td>'.getChampionIMG($favjungle[0]['championpic'], $favjungle[0]['champion']).' '.(int)$favjungle[0][0] . '/' . (int)$favjunglet.' ('.round(($favjungle[0][0] / $favjunglet) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favjungle[1]['championpic'], $favjungle[1]['champion']).' '.(int)$favjungle[1][0] . '/' . (int)$favjunglet.' ('.round(($favjungle[1][0] / $favjunglet) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favjungle[2]['championpic'], $favjungle[2]['champion']).' '.(int)$favjungle[2][0] . '/' . (int)$favjunglet.' ('.round(($favjungle[2][0] / $favjunglet) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favjungle[3]['championpic'], $favjungle[3]['champion']).' '.(int)$favjungle[3][0] . '/' . (int)$favjunglet.' ('.round(($favjungle[3][0] / $favjunglet) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favjungle[4]['championpic'], $favjungle[4]['champion']).' '.(int)$favjungle[4][0] . '/' . (int)$favjunglet.' ('.round(($favjungle[4][0] / $favjunglet) * 100, 0) . '%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('champion', $favjungle, $favjunglet);
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2"><b>Favorite Mid</b></td>';
//    echo '<td>'.getChampionIMG($favmid[0]['championpic'], $favmid[0]['champion']).' '.(int)$favmid[0][0] . '/' . (int)$favmidt.' ('.round(($favmid[0][0] / $favmidt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favmid[1]['championpic'], $favmid[1]['champion']).' '.(int)$favmid[1][0] . '/' . (int)$favmidt.' ('.round(($favmid[1][0] / $favmidt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favmid[2]['championpic'], $favmid[2]['champion']).' '.(int)$favmid[2][0] . '/' . (int)$favmidt.' ('.round(($favmid[2][0] / $favmidt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favmid[3]['championpic'], $favmid[3]['champion']).' '.(int)$favmid[3][0] . '/' . (int)$favmidt.' ('.round(($favmid[3][0] / $favmidt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favmid[4]['championpic'], $favmid[4]['champion']).' '.(int)$favmid[4][0] . '/' . (int)$favmidt.' ('.round(($favmid[4][0] / $favmidt) * 100, 0) . '%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('champion', $favmid, $favmidt);
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2"><b>Favorite ADC</b></td>';
//    echo '<td>'.getChampionIMG($favadc[0]['championpic'], $favadc[0]['champion']).' '.(int)$favadc[0][0] . '/' . (int)$favadct.' ('.round(($favadc[0][0] / $favadct) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favadc[1]['championpic'], $favadc[1]['champion']).' '.(int)$favadc[1][0] . '/' . (int)$favadct.' ('.round(($favadc[1][0] / $favadct) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favadc[2]['championpic'], $favadc[2]['champion']).' '.(int)$favadc[2][0] . '/' . (int)$favadct.' ('.round(($favadc[2][0] / $favadct) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favadc[3]['championpic'], $favadc[3]['champion']).' '.(int)$favadc[3][0] . '/' . (int)$favadct.' ('.round(($favadc[3][0] / $favadct) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favadc[4]['championpic'], $favadc[4]['champion']).' '.(int)$favadc[4][0] . '/' . (int)$favadct.' ('.round(($favadc[4][0] / $favadct) * 100, 0) . '%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('champion', $favadc, $favadct);
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2"><b>Favorite Support</b></td>';
//    echo '<td>'.getChampionIMG($favsupport[0]['championpic'], $favsupport[0]['champion']).' '.(int)$favsupport[0][0] . '/' . (int)$favsupportt.' ('.round(($favsupport[0][0] / $favsupportt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favsupport[1]['championpic'], $favsupport[1]['champion']).' '.(int)$favsupport[1][0] . '/' . (int)$favsupportt.' ('.round(($favsupport[1][0] / $favsupportt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favsupport[2]['championpic'], $favsupport[2]['champion']).' '.(int)$favsupport[2][0] . '/' . (int)$favsupportt.' ('.round(($favsupport[2][0] / $favsupportt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favsupport[3]['championpic'], $favsupport[3]['champion']).' '.(int)$favsupport[3][0] . '/' . (int)$favsupportt.' ('.round(($favsupport[3][0] / $favsupportt) * 100, 0) . '%)</td>';
//    echo '<td>'.getChampionIMG($favsupport[4]['championpic'], $favsupport[4]['champion']).' '.(int)$favsupport[4][0] . '/' . (int)$favsupportt.' ('.round(($favsupport[4][0] / $favsupportt) * 100, 0) . '%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('champion', $favsupport, $favsupportt);
//    echo '<tr class="rownew">';
//    echo '<td class="rowthead"><b>Highest Winrate Champion</b></td>';
//    echo '<td>'.getChampionIMG($winratechamp[0]['championpic'], $winratechamp[0]['champion']).' '.(int)$winratechamp[0][3] . '/' . (int)$winratechamp[0][0].' ('.(int)$winratechamp[0][2]. '%)</td>';
//    echo '<td>'.getChampionIMG($winratechamp[1]['championpic'], $winratechamp[1]['champion']).' '.(int)$winratechamp[1][3] . '/' . (int)$winratechamp[1][0].' ('.(int)$winratechamp[1][2]. '%)</td>';
//    echo '<td>'.getChampionIMG($winratechamp[2]['championpic'], $winratechamp[2]['champion']).' '.(int)$winratechamp[2][3] . '/' . (int)$winratechamp[2][0].' ('.(int)$winratechamp[2][2]. '%)</td>';
//    echo '<td>'.getChampionIMG($winratechamp[3]['championpic'], $winratechamp[3]['champion']).' '.(int)$winratechamp[3][3] . '/' . (int)$winratechamp[3][0].' ('.(int)$winratechamp[3][2]. '%)</td>';
//    echo '<td>'.getChampionIMG($winratechamp[4]['championpic'], $winratechamp[4]['champion']).' '.(int)$winratechamp[4][3] . '/' . (int)$winratechamp[4][0].' ('.(int)$winratechamp[4][2]. '%)</td>';
//    echo '</tr>';
//    echo '<tr>';
//    echo '<td class="rowthead"><b>Highest Winrate Lane</b></td>';
//    echo '<td>'.getLaneIMG($winratelane[0]['lane']).' '.(int)$winratelane[0][3] . '/' . (int)$winratelane[0][0].' ('.(int)$winratelane[0][2]. '%)</td>';
//    echo '<td>'.getLaneIMG($winratelane[1]['lane']).' '.(int)$winratelane[1][3] . '/' . (int)$winratelane[1][0].' ('.(int)$winratelane[1][2]. '%)</td>';
//    echo '<td>'.getLaneIMG($winratelane[2]['lane']).' '.(int)$winratelane[2][3] . '/' . (int)$winratelane[2][0].' ('.(int)$winratelane[2][2]. '%)</td>';
//    echo '<td>'.getLaneIMG($winratelane[3]['lane']).' '.(int)$winratelane[3][3] . '/' . (int)$winratelane[3][0].' ('.(int)$winratelane[3][2]. '%)</td>';
//    echo '<td>'.getLaneIMG($winratelane[4]['lane']).' '.(int)$winratelane[4][3] . '/' . (int)$winratelane[4][0].' ('.(int)$winratelane[4][2]. '%)</td>';
//    echo '</tr>';
//    echo '<tr class="rownew">';
//    echo '<td class="rowthead" rowspan="2">Favorite Spell on D</td>';
//    echo '<td>'.getSpellIMG($favspell1[0]['pic'], $favspell1[0]['name']).' '.(int)$favspell1[0][0] . '/' . (int)$numberofgames.' ('.round(($favspell1[0][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell1[1]['pic'], $favspell1[1]['name']).' '.(int)$favspell1[1][0] . '/' . (int)$numberofgames.' ('.round(($favspell1[1][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell1[2]['pic'], $favspell1[2]['name']).' '.(int)$favspell1[2][0] . '/' . (int)$numberofgames.' ('.round(($favspell1[2][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell1[3]['pic'], $favspell1[3]['name']).' '.(int)$favspell1[3][0] . '/' . (int)$numberofgames.' ('.round(($favspell1[3][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell1[4]['pic'], $favspell1[4]['name']).' '.(int)$favspell1[4][0] . '/' . (int)$numberofgames.' ('.round(($favspell1[4][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('spell1', $favspell1, $numberofgames);
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2">Favorite Spell on F</td>';
//    echo '<td>'.getSpellIMG($favspell2[0]['pic'], $favspell2[0]['name']).' '.(int)$favspell2[0][0] . '/' . (int)$numberofgames.' ('.round(($favspell2[0][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell2[1]['pic'], $favspell2[1]['name']).' '.(int)$favspell2[1][0] . '/' . (int)$numberofgames.' ('.round(($favspell2[1][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell2[2]['pic'], $favspell2[2]['name']).' '.(int)$favspell2[2][0] . '/' . (int)$numberofgames.' ('.round(($favspell2[2][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell2[3]['pic'], $favspell2[3]['name']).' '.(int)$favspell2[3][0] . '/' . (int)$numberofgames.' ('.round(($favspell2[3][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getSpellIMG($favspell2[4]['pic'], $favspell2[4]['name']).' '.(int)$favspell2[4][0] . '/' . (int)$numberofgames.' ('.round(($favspell2[4][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('spell2', $favspell2, $numberofgames);
//    echo '<tr>';
//    echo '<td class="rowthead">Favorite Item</td>';
//    echo '<td colspan="5">'.getItemIMG($favitem, $favitemname, $favitemddver).' '.(int)max($c) . '/' . (int)$numberofgames.' ('.round((max($c) / $numberofgames) * 100, 0).'%)</td>';
//    echo '</tr>';
//    echo '<tr>';
//    echo '<td class="rowthead" rowspan="2">Favorite Trinket</td>';
//    echo '<td>'.getItemIMG($favtrinket[0]['item6'], $favtrinket1, $favtrinket[0]['ddver']).' '.(int)$favtrinket[0][0] . '/' . (int)$numberofgames.' ('.round(($favtrinket[0][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getItemIMG($favtrinket[1]['item6'], $favtrinket2, $favtrinket[1]['ddver']).' '.(int)$favtrinket[1][0] . '/' . (int)$numberofgames.' ('.round(($favtrinket[1][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getItemIMG($favtrinket[2]['item6'], $favtrinket3, $favtrinket[2]['ddver']).' '.(int)$favtrinket[2][0] . '/' . (int)$numberofgames.' ('.round(($favtrinket[2][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getItemIMG($favtrinket[3]['item6'], $favtrinket4, $favtrinket[3]['ddver']).' '.(int)$favtrinket[3][0] . '/' . (int)$numberofgames.' ('.round(($favtrinket[3][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '<td>'.getItemIMG($favtrinket[4]['item6'], $favtrinket5, $favtrinket[4]['ddver']).' '.(int)$favtrinket[4][0] . '/' . (int)$numberofgames.' ('.round(($favtrinket[4][0] / $numberofgames) * 100, 0).'%)</td>';
//    echo '</tr>';
//    echo getProgressBarTR('trinket', $favtrinket, $numberofgames);
//    echo '</tbody>';
//    echo '</table>';

//    echo '<span class="metadata" id="metadata-favchamp0c" title="'.$favchamp[0]['champion'].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp1c" title="'.$favchamp[1]['champion'].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp2c" title="'.$favchamp[2]['champion'].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp3c" title="'.$favchamp[3]['champion'].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp4c" title="'.$favchamp[4]['champion'].'"></span>';
//
//    echo '<span class="metadata" id="metadata-favchamp0a" title="'.$favchamp[0][0].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp1a" title="'.$favchamp[1][0].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp2a" title="'.$favchamp[2][0].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp3a" title="'.$favchamp[3][0].'"></span>';
//    echo '<span class="metadata" id="metadata-favchamp4a" title="'.$favchamp[4][0].'"></span>';


    echo '<span class="metadata" id="metadata-favchamp" title="'.count($favchamp).'"></span>';
    for($i=0; $i<count($favchamp); $i++) {
        echo '<span class="metadata" id="metadata-favchamp'.$i.'c" title="'.$favchamp[$i]['champion'].'"></span>';
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
        echo '<span class="metadata" id="metadata-favitems'.$i.'c" title="'.$favitemsname[$i]['name'].'"></span>';
        echo '<span class="metadata" id="metadata-favitems'.$i.'a" title="'.$favitems[$i][0].'"></span>';
    }


//echo '<div class="chart">';
//echo '<label for="favchamp">Favorite Champion:<br>';
//echo '<canvas id="favchamp" height="300" width="1200"></canvas>';
//echo '</label>';
//echo '</div>';
//
//echo '<div class="chart">';
//echo '<label for="favlane">Favorite Lane:<br>';
//echo '<canvas id="favlane" height="300" width="1200"></canvas>';
//echo '</label>';
//echo '</div>';
//
//echo '<div class="chart">';
//echo '<label for="favtop">Favorite Top Laner:<br>';
//echo '<canvas id="favtop" height="300" width="1200"></canvas>';
//echo '</label>';
//echo '</div>';
//
//echo '<div class="chart">';
//echo '<label for="favjungler">Favorite Jungler:<br>';
//echo '<canvas id="favjungler" height="300" width="1200"></canvas>';
//echo '</label>';
//echo '</div>';
//
//echo '<div class="chart">';
//echo '<label for="favmid">Favorite Mid Laner:<br>';
//echo '<canvas id="favmid" height="300" width="1200"></canvas>';
//echo '</label>';
//echo '</div>';
//
//echo '<div class="chart">';
//echo '<label for="favadc">Favorite ADC:<br>';
//echo '<canvas id="favadc" height="300" width="1200"></canvas>';
//echo '</label>';
//echo '</div>';

//echo '<div style="display: inline-block"><table>';
//echo '<tr><td>Winrate on Blue Team:</td><td>' . $winrateblue . '%</td></tr>';
//echo '<tr><td>Winrate on Red Team:</td><td>' . $winratered . '%</td></tr>';
//echo '<tr><td>Most played games at:</td><td>' . $hourmostplayedtime . '</td><td style="text-align: left">|' . round(($hourmostplayed[0] / $numberofgames) * 100, 0) . '% of all games</td></tr>';
//echo '<tr><td>Most won games at:</td><td>' . $hourwinratetime . '</td><td style="text-align: left">|' . $hourwinrate[2] . '% winrate with ' . $hourwinrate[0] . ' games</td></tr>';
//echo '<tr><td>Total time spent</td><td>playing:</td><td>' . secondsToTime($timespent[0]) . '</td></tr>';
//echo '</table></div>';



}

?>

<script>
//var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

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

//var favchamp0c = document.getElementById("metadata-favchamp0c").title;
//var favchamp1c = document.getElementById("metadata-favchamp1c").title;
//var favchamp2c = document.getElementById("metadata-favchamp2c").title;
//var favchamp3c = document.getElementById("metadata-favchamp3c").title;
//var favchamp4c = document.getElementById("metadata-favchamp4c").title;
//
//var favchamp0a = document.getElementById("metadata-favchamp0a").title;
//var favchamp1a = document.getElementById("metadata-favchamp1a").title;
//var favchamp2a = document.getElementById("metadata-favchamp2a").title;
//var favchamp3a = document.getElementById("metadata-favchamp3a").title;
//var favchamp4a = document.getElementById("metadata-favchamp4a").title;

//var barChartDataFavChamp = {
//    labels : favchampc,
//    datasets : [
//        {
//            fillColor : "rgba(0,50,220,0.8)",
//            strokeColor : "rgba(0,50,220,0.8)",
//            highlightFill: "rgba(0,50,220,0.8)",
//            highlightStroke: "rgba(0,50,220,0.8)",
//            data : favchampa
//        }
//    ]
//};
//
//var barChartDataFavLane = {
//    labels : favlanel,
//    datasets : [
//        {
//            fillColor : "rgba(0,50,220,0.8)",
//            strokeColor : "rgba(0,50,220,0.8)",
//            highlightFill: "rgba(0,50,220,0.8)",
//            highlightStroke: "rgba(0,50,220,0.8)",
//            data : favlanea
//        }
//    ]
//};
//
//var barChartDataFavTop = {
//    labels : favtopc,
//    datasets : [
//        {
//            fillColor : "rgba(0,50,220,0.8)",
//            strokeColor : "rgba(0,50,220,0.8)",
//            highlightFill: "rgba(0,50,220,0.8)",
//            highlightStroke: "rgba(0,50,220,0.8)",
//            data : favtopa
//        }
//    ]
//};
//
//var barChartDataFavJungler = {
//    labels : favjunglerc,
//    datasets : [
//        {
//            fillColor : "rgba(0,50,220,0.8)",
//            strokeColor : "rgba(0,50,220,0.8)",
//            highlightFill: "rgba(0,50,220,0.8)",
//            highlightStroke: "rgba(0,50,220,0.8)",
//            data : favjunglera
//        }
//    ]
//};
//
//var barChartDataFavMid = {
//    labels : favmidc,
//    datasets : [
//        {
//            fillColor : "rgba(0,50,220,0.8)",
//            strokeColor : "rgba(0,50,220,0.8)",
//            highlightFill: "rgba(0,50,220,0.8)",
//            highlightStroke: "rgba(0,50,220,0.8)",
//            data : favmida
//        }
//    ]
//};

//var barChartDataFavADC = {
//    labels : favadcc,
//    datasets : [
//        {
//            fillColor : "rgba(0,50,220,0.8)",
//            strokeColor : "rgba(0,50,220,0.8)",
//            highlightFill: "rgba(0,50,220,0.8)",
//            highlightStroke: "rgba(0,50,220,0.8)",
//            data : favadca
//        }
//    ]
//};

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
//        backgroundColor: ["#FF0000", "#00FF00", "#0000FF", "#F0000F", "#0FFFF0"],
        backgroundColor: [
                    "#400080",
                    "#197407",
                    "#B11414",
                    "#1DBC99",
                    "#D9C623",
                    "#C4C4C4"
                ],
//        backgroundGolod: "#F7464A",
        data: favlanea
    }]
//    }, {
//        label: 'Games',
//        backgroundColor: "#46BFBD",
//        data: [favlanea[1]]
//    }, {
//        label: 'Games',
//        backgroundColor: "#FDB45C",
//        data: [favlanea[2]]
//    }, {
//        label: 'Games',
//        backgroundColor: "#949FB1",
//        data: [favlanea[3]]
//    }, {
//        label: 'Games',
//        backgroundColor: "#4D5360",
//        data: [favlanea[4]]
//    }]
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
//
//var barChartData2 = {
//    labels: labels,
//    datasets: [{
//        label: 'Dataset 1',
//        backgroundColor: "rgba(220,220,220,0.5)",
//        data: datas
//    }]
//};

//var randomScalingFactor = function() {
//            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
//        };
//        var randomColorFactor = function() {
//            return Math.round(Math.random() * 255);
//        };
//        var randomColor = function() {
//            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
//        };
//
//var barChartData = {
//            labels: ["January", "February", "March", "April", "May", "June", "July"],
//            datasets: [{
//                label: 'Dataset 1',
//                backgroundColor: "rgba(220,220,220,0.5)",
//                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
//            }, {
//                hidden: true,
//                label: 'Dataset 2',
//                backgroundColor: "rgba(151,187,205,0.5)",
//                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
//            }, {
//                label: 'Dataset 3',
//                backgroundColor: "rgba(151,187,205,0.5)",
//                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
//            }]
//
//        };

//window.onload = function(){
////    var ctx = document.getElementById("favchamp").getContext("2d");
////    window.myBar = new Chart(ctx).Bar(barChartDataFavChamp, { responsive : true });
////    var ctx2 = document.getElementById("favlane").getContext("2d");
////    window.myBar = new Chart(ctx2).Bar(barChartDataFavLane, { responsive : true });
////    var ctx3 = document.getElementById("favtop").getContext("2d");
////    window.myBar = new Chart(ctx3).Bar(barChartDataFavTop, { responsive : true });
////    var ctx4 = document.getElementById("favjungler").getContext("2d");
////    window.myBar = new Chart(ctx4).Bar(barChartDataFavJungler, { responsive : true });
////    var ctx5 = document.getElementById("favmid").getContext("2d");
////    window.myBar = new Chart(ctx5).Bar(barChartDataFavMid, { responsive : true });
////    var ctx6 = document.getElementById("favadc").getContext("2d");
////    window.myBar = new Chart(ctx6).Bar(barChartDataFavADC, { responsive : true });
////    var ctx7 = document.getElementById("favsupport").getContext("2d");
//////    window.myBar = new Chart(ctx7).Bar(barChartDataFavSupport, { responsive : true });
////    var ctx = document.getElementById("favsupport").getContext("2d");
////        window.myBar = new Chart(ctx, {
////            type: 'bar',
////            data: barChartData,
////            options: {
////                // Elements options apply to all of the options unless overridden in a dataset
////                // In this case, we are setting the border of each bar to be 2px wide and green
////                elements: {
////                    rectangle: {
////                        borderWidth: 2,
////                        borderColor: 'rgb(0, 255, 0)',
////                        borderSkipped: 'bottom'
////                    }
////                },
////                responsive: true,
////                legend: {
////                    position: 'top'
////                },
////                title: {
////                    display: true,
////                    text: 'Favorite Supports'
////                }
////            }
////        });
//    var ctx = document.getElementById("favsupport").getContext("2d");
//            window.myBar = new Chart(ctx, {
//                type: 'bar',
//                data: barChartData,
//                options: {
//                    // Elements options apply to all of the options unless overridden in a dataset
//                    // In this case, we are setting the border of each bar to be 2px wide and green
//                    elements: {
//                        rectangle: {
//                            borderWidth: 2,
//                            borderColor: 'rgb(0, 255, 0)',
//                            borderSkipped: 'bottom'
//                        }
//                    },
//                    responsive: true,
//                    legend: {
//                        position: 'top',
//                    },
//                    title: {
//                        display: true,
//                        text: 'Chart.js Bar Chart'
//                    }
//                }
//            });
//}

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
    };

</script>








<!--    <!--/////////////////^TESTETSTETSTES/////////////////-->
<!--        <canvas id="canvas"></canvas>-->
<!--    <script>-->
<!--        var labels = new Array(document.getElementById("metadata-favsupport").title);-->
<!--        var datas = new Array(document.getElementById("metadata-favsupport").title);-->
<!--        for(var i=0; i<document.getElementById("metadata-favsupport").title; i++) {-->
<!--            labels[i] = document.getElementById("metadata-favsupport"+i+"c").title;-->
<!--            datas[i] = document.getElementById("metadata-favsupport"+i+"a").title;-->
<!--        }-->
<!---->
<!---->
<!--        //var labels = ["January", "February", "March", "April", "May", "June", "July"];-->
<!--        //var datas = [1, 2, 3, 4, 5, 6, 7];-->
<!---->
<!--//        var barChartData = {-->
<!--//            labels: labels,-->
<!--//            datasets: [{-->
<!--//                label: 'Dataset 1',-->
<!--//                backgroundColor: "rgba(220,220,220,0.5)",-->
<!--//                data: datas-->
<!--//            }]-->
<!--//        };-->
<!---->
<!--        var barChartDataFavSupport = {-->
<!--            labels: labels,-->
<!--            datasets: [{-->
<!--                label: 'Supports',-->
<!--                backgroundColor: "rgba(220,220,220,0.5)",-->
<!--                data: datas-->
<!--            }]-->
<!--        };-->
<!---->
<!--        window.onload = function() {-->
<!--            var ctx = document.getElementById("favsupport").getContext("2d");-->
<!--            window.myBar = new Chart(ctx, {-->
<!--                type: 'bar',-->
<!--                data: barChartDataFavSupport,-->
<!--                options: {-->
<!--                    // Elements options apply to all of the options unless overridden in a dataset-->
<!--                    // In this case, we are setting the border of each bar to be 2px wide and green-->
<!--                    elements: {-->
<!--                        rectangle: {-->
<!--                            borderWidth: 2,-->
<!--                            borderColor: 'rgb(0, 255, 0)',-->
<!--                            borderSkipped: 'bottom'-->
<!--                        }-->
<!--                    },-->
<!--                    responsive: true,-->
<!--                    legend: {-->
<!--                        position: 'top'-->
<!--                    },-->
<!--                    title: {-->
<!--                        display: true,-->
<!--                        text: 'Favorite Support'-->
<!--                    }-->
<!--                }-->
<!--            });-->
<!---->
<!--        };-->
<!--    </script>-->
<!--    <!--/////////////////^TESTETSTETSTES/////////////////-->




<!--</div>-->

<?php require_once 'footer.php'; ?>



<?php
function getProgressBarTR($category, $array, $total) {
    $string = '';
    $string .= '<tr>';
    $string .= '<td colspan="5">';
    $string .= '<div class="progress" style="margin: 0; height: 20px;">';
    for($i=0; $i<count($array); $i++) {
        $image = '';
        if($category == 'trinket') {
            $image = getItemIMG($array[$i]['item6']);
        } else if($category == 'champion') {
            $image = getChampionIMG($array[$i]['championpic'], $array[$i]['champion']);
        } else if($category == 'lane') {
            $image = getLaneIMG($array[$i]['lane']);
        } else if($category == 'spell1') {
            $image = getSpellIMG($array[$i]['pic'], $array[$i]['name']);
        } else if($category == 'spell2') {
            $image = getSpellIMG($array[$i]['pic'], $array[$i]['name']);
        }

        if($i == 0) {
            $string .= '<div class="progress-bar progress-bar-success" role="progressbar" style="border: 1px black solid; height: 20px; width:'.round(($array[$i][0] / $total) * 100, 0).'%" data-toggle="tooltip" data-placement="bottom" title="'.round(($array[$i][0] / $total) * 100, 0).'%">'.$image.'</div>';
        } else {
            $string .= '<div class="progress-bar" role="progressbar" style="border: 1px black solid; height: 20px; width:'.floor(($array[$i][0] / $total) * 100).'%" data-toggle="tooltip" data-placement="bottom" title="'.round(($array[$i][0] / $total) * 100, 0).'%">'.$image.'</div>';
        }
    }
    $string .= '</div>';
    $string .= '</td>';
    $string .= '</tr>';

    return $string;
}
?>



