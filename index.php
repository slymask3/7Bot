<?php
$page = 'index';
$pagename = 'Ranked Games';
require_once 'header.php';

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

$queueCode = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
if($queue == 'dynamic') {
    $queueCode = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
} else if($queue == 'solo') {
    $queueCode = 'RANKED_SOLO_5x5';
} else if($queue == 'team5') {
    $queueCode = 'RANKED_TEAM_5x5';
} else if($queue == 'team3') {
    $queueCode = 'RANKED_TEAM_3x3';
}

$seasonCode = 'SEASON2016';
$preseasonCode = 'PRESEASON2017';
$seasonTable = '2016';
if($season == '6') {
    $seasonCode = 'SEASON2016';
    $preseasonCode = 'PRESEASON2017';
    $seasonTable = '2016';
} else if($season == '5') {
    $seasonCode = 'SEASON2015';
    $preseasonCode = 'PRESEASON2016';
    $seasonTable = '2015';
} else if($season == '4') {
    $seasonCode = 'SEASON2014';
    $preseasonCode = 'PRESEASON2015';
    $seasonTable = '2014';
} else if($season == '3') {
    $seasonCode = 'SEASON3';
    $preseasonCode = 'PRESEASON2014';
    $seasonTable = '2013';
}

//This page is responsible for getting the games information from the riot api and putting them into the database.
//todo: limit the fucking shit clicked per ip address
require_once 'updategames.php';

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

$accountid = $account['id'];

//echo '<pre>';
//var_dump($s6g, $s5g, $s4g, $s3g, $s6dynamic, $s6solo, $s6team5, $s6team3, $s5dynamic, $s5solo, $s5team5, $s5team3, $s4dynamic, $s4solo, $s4team5, $s4team3, $s3dynamic, $s3solo, $s3team5, $s3team3);

//echo '</pre>';
///////////////////////////////////////////////////////////////////////////////////////////////////

//echo '<div class="container">';

//include_once 'createmerged.php';

?>

<!--    <div class="container">-->

<?php

if(!empty($region) && !empty($username)) {

    if($accres->rowCount() == 0) {
        echo '<div class="topinfo">';
        echo "No data found for the account '".$username."'. Please click the update button to add this account to the database.";
        echo '</div>';
    }

    $updatetext = 'Update Games';
    $updatevalue = 'confirm';
    $updatecolor = 'warning';
    if($updatephase == 'confirm') {
        $updatetext = 'Confirm';
        $updatevalue = 'yes';
        $updatecolor = 'danger';
    }

    /*echo '<div class="update">';

    echo '<ul class="nav nav-pills" id="navbarmain"><li><img src="assets/logo.png" /></li>
        <li class="active"><a href="index.php">Games</a></li>
        <li><a href="stats.php">Stats</a></li>
        <li><a href="match.php">Match</a></li>
        <li><a href="toplist.php">Top List</a></li>
        <li><a href="namechecker.php">Name Checker</a></li>
        <li><a href="about.php">About</a></li>
    </ul>';

    echo '</div>';*/

    echo '<div class="updatebutton">';
    echo '<form action="index.php?r='.$region.'&name='.$username.'&s='.$season.'&q='.$queue.'" method="post">';
    echo '<input type="hidden" name="update" value="'.$updatevalue.'" />';
    //echo '<input type="submit" value="'.$updatetext.'" class="btn btn-'.$updatecolor.'" />';
    echo '<button type="submit" class="btn btn-'.$updatecolor.'"><i class="fa fa-arrow-circle-o-up"></i> '.$updatetext.'</button>';
    echo '</form></div>';

    /*echo '<div class="div text-center" id="header" style="margin: 0 80px 0 0px;">';
    echo '<h1 style="margin: 0px" data-text="'.$websitename.'">'.$websitename.'</h1>';*/
    if($accres->rowCount() > 0) {
        include 'summonerinfo.php';
    }
    //echo '</div>';
} else {
    /*echo '<div class="update">';
    echo '<ul class="nav nav-pills" id="navbarmain"><li><img src="assets/logo.png" /></li>
        <li class="active"><a href="index.php">Games</a></li>
        <li><a href="stats.php">Stats</a></li>
        <li><a href="match.php">Match</a></li>
        <li><a href="toplist.php">Top List</a></li>
        <li><a href="namechecker.php">Name Checker</a></li>
        <li><a href="about.php">About</a></li>
    </ul>';
    echo '</div>';

    echo '<div class="div text-center" id="header">';
    echo '<h1 style="margin: 0px" data-text="'.$websitename.'">'.$websitename.'</h1>';
    echo '<h2>Games</h2>';
    echo '</div>';*/
}

?>
<!--    <div class="div text-right" id="options">-->
        <?php

        if(!empty($username)) {
//            echo '<form action="index.php" method="get" class="form text-right">';
//            foreach ($_GET as $key => $value) {
//                if ($key == "r") {
//                    echo "<input type='hidden' name='$key' value='$value'/>";
//                }
//            }
////            echo '<label for="r">Region:</label> ';
////            echo '<select name="r" id="r" style="height:26px;"> ';
////
////            $query = "SELECT * FROM regions ORDER BY 1 ASC";
////            $result = $conn->prepare($query);
////            $result->execute();
////            $table = $result->fetchAll();
////
////            foreach($table as $row) {
////                if($row['region'] == $region) {
////                    echo '<option value="'.$row['region'].'" selected>'.$row['name'].'</option>';
////                } else {
////                    echo '<option value="'.$row['region'].'">'.$row['name'].'</option>';
////                }
////            }
////
////            echo '</select> ';
//            echo '<label for="name">Username:</label> ';
//            echo '<input type="text" id="name" name="name" value="' . $username . '" class="inputbox" /> ';
//            //echo '<input type="submit" value="Search" class="btn btn-success" />';
//            echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
//            echo '</form>';
            echo '<div class="search-summoner">';
            echo '<form action="index.php" method="get">';
            foreach ($_GET as $key => $value) {
                if ($key == "r") {
                    echo "<input type='hidden' name='$key' value='$value'/>";
                }
            }
            echo '<input type="text" class="form-control" name="name" value="'.$username.'" placeholder="Enter a Summoner\'s Name.." required />';
            echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<div class="search-summoner no-summoner">';
            echo '<form action="index.php" method="get">';
            foreach ($_GET as $key => $value) {
                if ($key == "r") {
                    echo "<input type='hidden' name='$key' value='$value'/>";
                }
            }
            echo '<input type="text" class="form-control" name="name" placeholder="Enter a Summoner\'s Name.." required />';
            echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
            echo '</form>';
            echo '</div>';

//            echo '<div class="text-center" id="search">';
//            echo '<table align="center">';
////            echo '<tr>';
////            echo '<td class="text-right">';
//            echo '<form action="index.php" method="get">';
//            foreach ($_GET as $key => $value) {
//                if ($key == "r") {
//                    echo "<input type='hidden' name='$key' value='$value'/>";
//                }
//            }
////            echo '<label for="r">Region:</label> ';
////            echo '</td><td>';
////            echo '<select name="r" id="r" class="inputbox"> ';
////
////            $query = "SELECT * FROM regions ORDER BY 1 ASC";
////            $result = $conn->prepare($query);
////            $result->execute();
////            $table = $result->fetchAll();
////
////            foreach($table as $row) {
////                if($row['region'] == $region) {
////                    echo '<option value="'.$row['region'].'" selected>'.$row['name'].'</option>';
////                } else {
////                    echo '<option value="'.$row['region'].'">'.$row['name'].'</option>';
////                }
////            }
////
////            echo '</select>';
////            echo '</td>';
//            echo '<tr>';
//            echo '<td class="text-right">';
//            echo '<label for="name">Username:</label>';
//            echo '</td><td>';
//            echo '<input type="text" id="name" name="name" class="inputbox" />';
//            echo '</td></tr><tr><td></td><td class="text-right">';
//            //echo '<input type="submit" value="Search" class="btn btn-success" />';
//            echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
//            echo '</form>';
//            echo '</td></tr></table></div>';
        }

//        echo '</div>';

        //echo '<div class="container">';
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

//            var_dump($season, $queue);

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
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $order = 2;
        $dir = "desc";
        $diro = "asc";

//        $qry = "SELECT lane as 'Lane', c.pic as 'Ch', c.name as 'champion', e.pic as 'VS', e.name as 'enemy', s1.pic as 'Spells', s2.pic as 'S2', item0 as 'Items', item1 as 'I2', item2 as 'I3', item3 as 'I4', item4 as 'I5', item5 as 'I6', item6 as 'T', kills as 'K', deaths as 'D', assists as 'A', damage as 'Damage',
//gold as 'Gold', cs as 'CS', wards as 'W', length as 'Length', team as 'Team', outcome as 'W/L', teamKills as 'TK', teamDeaths as 'TD',
//round(damage/(length/60), 2) as 'Dmg/min', round(gold/(length/60), 2) as 'Gold/min', round(cs/(length/60), 2) as 'CS/min', kills/(length/60) as 'K/min', deaths/(length/60) as 'D/min',
//ROUND(((kills+assists)/teamKills)*100, 2) as 'KP%', ROUND((deaths/teamDeaths)*100, 2) as 'DP%', creation as 'Date', matchid as 'matchid', ddver as 'ddver', keystone as 'keystone', s1.name as 'S1N', s2.name as 'S2N'
//FROM ".$dbtable." LEFT JOIN champions c ON championid=c.id LEFT JOIN champions e ON enemyid=e.id LEFT JOIN spells s1 ON spell1id=s1.id LEFT JOIN spells s2 ON spell2id=s2.id";

//        $qry = "SELECT
//matchid,
//CAST(json_extract(data, '$.matchCreation') as CHAR) as 'Date',
//CAST(json_extract(data, '$.matchDuration') as CHAR) as 'Length',
//getPiString($accountid, data, '.player.summonerName') as 'displayame',
//getPString($accountid, data, '.timeline.lane') as 'lane',
//getPString($accountid, data, '.timeline.role') as 'role',
//getPInt($accountid, data, '.championId') as 'championid',
//c.pic as 'Ch', c.name as 'champion',
//s1.pic as 'Spells', s2.pic as 'S2', s1.name as 'S1N', s2.name as 'S2N',
//getPInt($accountid, data, '.stats.kills') as 'K',
//getPInt($accountid, data, '.stats.deaths') as 'D',
//getPInt($accountid, data, '.stats.assists') as 'A',
//getPInt($accountid, data, '.stats.totalDamageDealtToChampions') as 'Damage',
//getPInt($accountid, data, '.stats.goldEarned') as 'Gold',
//getPInt($accountid, data, '.stats.minionsKilled')+getPInt($accountid, data, '.stats.neutralMinionsKilled') as 'CS',
//round(getPInt($accountid, data, '.stats.totalDamageDealtToChampions')/(CAST(json_extract(data, '$.matchDuration') as CHAR)/60), 2) as 'Dmg/min',
//round(getPInt($accountid, data, '.stats.goldEarned')/(CAST(json_extract(data, '$.matchDuration') as CHAR)/60), 2) as 'Gold/min',
//round((getPInt($accountid, data, '.stats.minionsKilled')+getPInt($accountid, data, '.stats.neutralMinionsKilled'))/(CAST(json_extract(data, '$.matchDuration') as CHAR)/60), 2) as 'CS/min',
//getPInt($accountid, data, '.stats.kills')/(CAST(json_extract(data, '$.matchDuration') as CHAR)/60) as 'K/min',
//getPInt($accountid, data, '.stats.deaths')/(CAST(json_extract(data, '$.matchDuration') as CHAR)/60) as 'D/min',
//getPInt($accountid, data, '.teamId') as 'teamid',
//(CASE WHEN getPString($accountid, data, '.stats.winner')='true' then 'Win' else 'Loss' end) as 'W/L',
//CAST(data as CHAR) as 'match',
//getPiInt($accountid, data, '.participantId') as 'pid',
//ROUND(((getPInt($accountid, data, '.stats.kills')+getPInt($accountid, data, '.stats.assists'))/getTeamTotal(getPInt($accountid, data, '.teamId'), data, '.kills'))*100, 2) as 'KP%',
//ROUND((getPInt($accountid, data, '.stats.deaths')/getTeamTotal(getPInt($accountid, data, '.teamId'), data, '.deaths'))*100, 2) as 'DP%'
//FROM matches_".$region."_".$seasonCode."
//LEFT JOIN champions c ON getPInt($accountid, data, '.championId')=c.id
//LEFT JOIN spells s1 ON getPInt($accountid, data, '.spell1Id')=s1.id
//LEFT JOIN spells s2 ON getPInt($accountid, data, '.spell2Id')=s2.id
//WHERE (".accountidEquals($accountid).") AND
//(CAST(replace(json_extract(data, '$.season'), '\"', '') as CHAR)='$seasonCode' OR CAST(replace(json_extract(data, '$.season'), '\"', '') as CHAR)='$preseasonCode') AND
//CAST(replace(json_extract(data, '$.queueType'), '\"', '') as CHAR)='$queueCode'";

$qry = "SELECT
matchid, cast(json_extract(data, '$.matchCreation') as char),
CAST(data as CHAR) as 'match',
getPiInt($accountid, data, '.participantId') as 'pid'
FROM matches_".$region."_".$seasonCode."
WHERE (".accountidEquals($accountid).") AND
CAST(replace(json_extract(data, '$.queueType'), '\"', '') as CHAR)='$queueCode'";

        if(!empty($_GET['order'])) {
            $order = $_GET['order'];
        }
        if(!empty($_GET['dir'])) {
            $dir = $_GET['dir'];

            if($dir == "asc") {
                $diro = "desc";
            } else {
                $diro = "asc";
            }
        }

        $lane = '%';
        if(!empty($_GET['lane'])) {
            $lane = $_GET['lane'];
        }
        $champion = '%';
        if(!empty($_GET['champion'])) {
            $champion = $_GET['champion'];
        }
        $enemy = '%';
        if(!empty($_GET['enemy'])) {
            $enemy = $_GET['enemy'];
        }

//        $start = new DateTime();
//        $startf = udate('s.u');

//        $query = $qry . " HAVING getPString($accountid, data, '.timeline.lane') LIKE '".$lane."' AND c.pic LIKE '".$champion."' AND e.pic LIKE '".$enemy."' ORDER BY " . $order . " " . $dir;
        $query = $qry;// . " AND getPString($accountid, data, '.timeline.lane') LIKE '".$lane."' AND c.pic LIKE '".$champion."' ORDER BY " . $order . " " . $dir;
//        $query = $qry . " ORDER BY " . $order . " " . $dir;
        $query = $qry . " ORDER BY 2 DESC";
        $result = $conn->prepare($query);
        $result->execute();
        $table = $result->fetchAll();
        $numberofgameswithselection = $result->rowCount();
//        $queryng = "SELECT count(matchid) FROM matches_na
//        $numberofgameswithselection = $resultng->fetchAll()[0][0];
//                    WHERE (".accountidEquals($accountid).") AND
//                    (CAST(replace(json_extract(data, '$.season'), '\"', '') as CHAR)='$seasonCode' OR CAST(replace(json_extract(data, '$.season'), '\"', '') as CHAR)='$preseasonCode') AND
//                    CAST(replace(json_extract(data, '$.queueType'), '\"', '') as CHAR)='$queueCode'";
//        $resultng = $conn->prepare($queryng);
//        $resultng->execute();
//        $numberofgameswithselection = $resultng->fetchAll()[0][0];

//        $end = new DateTime();
//        $endf = udate('s.u');

//        $startenddiff = $end->diff($start);
        //$secondstograb = ($startenddiff->h*3600)+($startenddiff->m*60)+($startenddiff->s*1);
        //$secondstograb = (new DateTime($startenddiff->format('Y-m-d H:i:s.u')))->format('Y-m-d H:i:s.u');
        //$secondstograb = millisecsBetween($end, $start);
//        $secondstograb = $endf-$startf;

if($secondstograb < 0) {
    $secondstograb += 60;
}

//        var_dump($secondstograb);
//        var_dump($startf);
//        var_dump($endf);
//        var_dump($endf-$startf);

//        echo '<pre>';
//        print_r($query);
//        echo '</pre>';

//function millisecsBetween($dateOne, $dateTwo, $abs = true) {
//    $func = $abs ? 'abs' : 'intval';
//    return $func(strtotime($dateOne) - strtotime($dateTwo)) * 1000;
//}

        $limit = 50;
        if(!empty($_GET['limit'])) {
            $limit = $_GET['limit'];
        }
        $page = 1;
        if(!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        $limitoffset = '';
        if($limit != 0) {
            //$limitoffset = ' LIMIT '.$limit.' OFFSET '.($limit*($page-1));
        }

        $startf = udate('s.u');
        $startfi = udate('i');
        $querylimit = $query.$limitoffset;
        $resultlimit = $conn->prepare($querylimit);
        $resultlimit->execute();
        $tablelimit = $resultlimit->fetchAll();
        $endf = udate('s.u');
        $endfi = udate('i');
//var_dump($resultlimit->errorInfo());
        $secondstograb = $endf-$startf+(($endfi-$startfi)*60);

//        print_r($querylimit);
//var_dump($resultlimit->errorInfo());

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//        if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {
//            echo '<div class="limitpage">';
//
//            //////////////////////////////// limit table by lane, champion or opponent ////////////////////////////////
//            echo '<div class="limitoptions">';
//            echo '<form>';
//            echo '<label for="lane">Lane:</label> ';
//            echo '<select id="lane" name="lane" onchange="checkAndSubmit()" style="height:26px; width:50px;">';
//            $lane = "%";
//            if (!empty($_GET['lane'])) {
//                $lane = $_GET['lane'];
//            }
//            if ($lane == 'all') {
//                echo '<option value="%" selected>All</option>';
//            } else {
//                echo '<option value="%">All</option>';
//            }
//            if ($lane == 'top') {
//                echo '<option value="top" selected>Top</option>';
//            } else {
//                echo '<option value="top">Top</option>';
//            }
//            if ($lane == 'jungle') {
//                echo '<option value="jungle" selected>Jungle</option>';
//            } else {
//                echo '<option value="jungle">Jungle</option>';
//            }
//            if ($lane == 'mid') {
//                echo '<option value="mid" selected>Mid</option>';
//            } else {
//                echo '<option value="mid">Mid</option>';
//            }
//            if ($lane == 'adc') {
//                echo '<option value="adc" selected>ADC</option>';
//            } else {
//                echo '<option value="adc">ADC</option>';
//            }
//            if ($lane == 'support') {
//                echo '<option value="support" selected>Support</option>';
//            } else {
//                echo '<option value="support">Support</option>';
//            }
//            echo '</select> ';
//
//            echo '<label for="champion">Champion:</label> ';
//            echo '<select id="champion" name="champion" onchange="checkAndSubmit()" style="height:26px; width:70px;">';
//            $query41 = "SELECT * FROM champions ORDER BY name ASC";
//            $result41 = $conn->prepare($query41);
//            $result41->execute();
//            $table41 = $result41->fetchAll();
//            $champion = "%";
//            if (!empty($_GET['champion'])) {
//                $champion = $_GET['champion'];
//            }
//            if ($champion == '%') {
//                echo '<option value="%" selected>All</option>';
//            } else {
//                echo '<option value="%">All</option>';
//            }
//            foreach ($table41 as $row) {
//                if ($champion == $row['pic']) {
//                    echo '<option value="' . $row['pic'] . '" selected>' . $row['name'] . '</option>';
//                } else {
//                    echo '<option value="' . $row['pic'] . '">' . $row['name'] . '</option>';
//                }
//            }
//            echo '</select> ';
//
//            echo '<label for="enemy">Opponent:</label> ';
//            echo '<select id="enemy" name="enemy" onchange="checkAndSubmit()" style="height:26px; width:70px;">';
//            $query42 = "SELECT * FROM champions ORDER BY name ASC";
//            $result42 = $conn->prepare($query42);
//            $result42->execute();
//            $table42 = $result42->fetchAll();
//            $enemy = "%";
//            if (!empty($_GET['enemy'])) {
//                $enemy = $_GET['enemy'];
//            }
//            if ($enemy == '%') {
//                echo '<option value="%" selected>All</option>';
//            } else {
//                echo '<option value="%">All</option>';
//            }
//            foreach ($table42 as $row) {
//                if ($enemy == $row['pic']) {
//                    echo '<option value="' . $row['pic'] . '" selected>' . $row['name'] . '</option>';
//                } else {
//                    echo '<option value="' . $row['pic'] . '">' . $row['name'] . '</option>';
//                }
//            }
//            echo '</select>';
//            echo '</form><br>';
//            echo '<b>Showing Games: '.$resultlimit->rowCount().'/'.$numberofgameswithselection.'</b> ';
//            echo '<b>(Took '.$secondstograb.' seconds to load the games)</b>';
//            echo '</div>';
//            /////////////////////////////////////////////////////////////////////////////////////////////////////
//
//            ///////////////////////////////////////////////////order by form////////////////////////////////////
//
//            echo '<div class="limitforms">';
//
//            echo '<form action="index.php" method="get"> ';
//            foreach ($_GET as $key => $value) {
//                if ($key != "order" && $key != "dir") {
//                    echo "<input type='hidden' name='$key' value='$value'/>";
//                }
//            }
//            echo '<label for="order">Order By:</label> ';
//            echo '<select name="order" style="height: 26px;" id="orderbyid"> ';
//            echo '<option value="2">Lane</option>';
//            echo '<option value="4">Champion</option>';
//            echo '<option value="5">Opponent</option>';
//            echo '<option value="7">Spell 1</option>';
//            echo '<option value="8">Spell 2</option>';
//            echo '<option value="9">Item 1</option>';
//            echo '<option value="10">Item 2</option>';
//            echo '<option value="11">Item 3</option>';
//            echo '<option value="12">Item 4</option>';
//            echo '<option value="13">Item 5</option>';
//            echo '<option value="14">Item 6</option>';
//            echo '<option value="15">Trinket</option>';
//            echo '<option value="16">Kills</option>';
//            echo '<option value="17">Deaths</option>';
//            echo '<option value="18">Assists</option>';
//            echo '<option value="19">Damage</option>';
//            echo '<option value="20">Gold</option>';
//            echo '<option value="21">CS</option>';
//            echo '<option value="23">Length</option>';
//            //echo '<option value="24">Team</option>';
//            //echo '<option value="25">Outcome</option>';
//            //echo '<option value="26">Team Kills</option>';
//            //echo '<option value="27">Team Deaths</option>';
//            echo '<option value="28">Damage/min</option>';
//            echo '<option value="29">Gold/min</option>';
//            echo '<option value="30">CS/min</option>';
//            //echo '<option value="31">Kills/min</option>';
//            //echo '<option value="32">Deaths/min</option>';
//            echo '<option value="33">Kill Participation</option>';
//            echo '<option value="34">Death Participation</option>';
//            echo '<option value="35" selected>Date</option>';
//            echo '</select> ';
//            echo '<label for="dir">Direction:</label> ';
//            echo '<select name="dir" style="height: 26px;" id="directionid"> ';
//            echo '<option value="asc">Ascending</option>';
//            echo '<option value="desc" selected>Descending</option>';
//            echo '</select> ';
//            echo '<input type="submit" value="Go" class="btn btn-primary" />';
//            echo '</form>';
//
//            ///////////////////////////////////////////////////////////////////////////////////////////////////
//
//            //echo '<form action="index.php?r='.$region.'&name='.$username.'&s='.$season.'&q='.$queue.'&order='.$order.'&dir='.$dir.'&lane='.$lane.'&champion='.$champion.'&enemy='.$enemy.'" method="get">';
//            echo '<form action="index.php" method="get">';
//            foreach ($_GET as $key => $value) {
//                if ($key != "limit" && $key != "page") {
//                    echo "<input type='hidden' name='$key' value='$value'/>";
//                }
//            }
//            echo '<label for="limit">Limit per Page:</label> ';
//            echo '<input type="number" name="limit" value="' . $limit . '" style="height: 26px; width:50px" /> ';
//            echo '<label for="page">Page:</label> ';
//            echo '<select name="page" style="height: 26px; width:50px">';
//            $totalpages = ceil($numberofgameswithselection / $limit);
//            for ($i = 1; $i <= $totalpages; $i++) {
//                if ($page == $i) {
//                    echo '<option value="' . $i . '" selected>' . $i . '</option>';
//                } else {
//                    echo '<option value="' . $i . '">' . $i . '</option>';
//                }
//            }
//            echo '</select> ';
//            //echo '<input type="submit" value="Go" style="height: 26px; width:50px" />';
//            echo '<input type="submit" value="Go" class="btn btn-primary" />';
//            echo '</form>';
//            echo '</div>';
//
//            echo '</div>';
//        }

if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {
    require_once 'gamestable4.php';
}

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //echo '</div>';

?>

<!--    </div>-->

<?php require_once 'footer.php'; ?>