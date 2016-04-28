<?php
$page = 'champions';
$pagename = 'Champions';
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

$displayname = $account['displayname'];
$icon = $account['icon'];
$tier = $account['tier'];
$rank = $account['tier'].' '.$account['division'].' '.$account['lp'].'LP';
$userid = $account['id'];

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

$id = $account['id'];

if(empty($username)) {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="champions.php" method="get">';
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
} else {
    echo '<div class="updatebutton">';
    echo '<form action="champions.php?r='.$region.'&name='.$username.'" method="post">';
    echo '<input type="hidden" name="update" value="yes" />';
    echo '<button type="submit" class="btn btn-warning"><i class="fa fa-arrow-circle-o-up"></i> Update Champions</button>';
    echo '</form></div>';

    if($accres->rowCount() > 0) {
        include 'summonerinfo.php';
    }

    echo '<div class="search-summoner">';
    echo '<form action="champions.php" method="get">';
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

    echo '<div class="about" style="text-align: center;">';

    try {
        if(!empty($_POST['update'])) {
            $api = new riotapi($region);
            $apiCache = new riotapi($region, new FileSystemCache('cache/'));
            if ($_POST['update'] == 'yes') {

                include_once 'updatesummoner.php';
//                $api = new riotapi($region, new FileSystemCache('cache/'));
                $id = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))]['id'];
                $r = $api->getChampionMastery($id, strtoupper($region) . '1');

                //var_dump_pre($r);

                $query = createChampionsTableIfNotExists($region, $id);
                $result = $conn->prepare($query);
                $result->execute();
                //var_dump($query);

                foreach ($r as $champion) {
                    $c = (array)$champion;

                    $query = 'SELECT * FROM ' . $region . '_' . $id . '_champions WHERE championid=' . $c['championId'];
                    $result = $conn->prepare($query);
                    $result->execute();
                    //var_dump($query);
                    if ($result->rowCount() == 0) {
                        $query = insertIntoChampions($region, $id, $c['championId'], $c['championLevel'], $c['championPoints'], $c['lastPlayTime'], $c['championPointsSinceLastLevel'], $c['championPointsUntilNextLevel'], $c['chestGranted']);
                        $result = $conn->prepare($query);
                        $result->execute();
                        //var_dump($query);
                    } else {
                        $query = updateChampions($region, $id, $c['championId'], $c['championLevel'], $c['championPoints'], $c['lastPlayTime'], $c['championPointsSinceLastLevel'], $c['championPointsUntilNextLevel'], $c['chestGranted']);
                        $result = $conn->prepare($query);
                        $result->execute();
                        //var_dump($query);
                    }
                }
            }
        }
    } catch(Exception $e) {
        //echo $username.' is not currently not in a game.';
    }

    $championname = '%';
    if(!empty($_GET['champion'])) {
        $championname = '%'.$_GET['champion'].'%';
    }
    $order = 6;
    if(!empty($_GET['order'])) {
        $order = $_GET['order'];
    }
    $dir = 'desc';
    if(!empty($_GET['dir'])) {
        $dir = $_GET['dir'];
    }

    $champtable = $region.'_'.$id.'_champions';

    $query = 'SELECT id, name, pic, title, championlevel, championpoints, lastplay, championpointssincelastlevel, championpointsuntilnextlevel, chestgranted
              FROM '.$champtable.' RIGHT JOIN champions ON championid=id WHERE name LIKE :champion ORDER BY '.$order.' '.$dir.';';
    $result = $conn->prepare($query);
    $result->bindParam(':champion', $championname, PDO::PARAM_STR, 14);
    //$result->bindParam(':ord', $order, PDO::PARAM_INT);
    $result->execute();
    $table = $result->fetchAll();

    //echo '<h3>TODO - Under Construction</h3>';

//    echo '<table class="table table-striped" id="tablenames">';
//    echo '<tbody>';
//    echo '<tr>
//            <td><b>Champ</b></td>
//            <td><b>Level</b></td>
//            <td><b>Points</b></td>
//            <td><b>Last Played</b></td>
//            <td><b>Points Since Last Level</b></td>
//            <td><b>Points Until Next Level</b></td>
//            <td><b>Chest Granted</b></td></tr>';

    echo '<div class="champions-options">';
    echo '<div class="champions-limit">';
    echo '<form action="champions.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key != "champion") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<label for="champion">Champion Name:</label> ';
    echo '<input type="text" name="champion" value="'.(!empty($_GET['champion']) ? str_replace('%', '', $championname) : '').'"/> ';
    echo '<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Go</button>';
    echo '</form>';
    echo '</div>';
    echo '<div class="champions-order">';
    echo '<form action="champions.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key != "order" && $key != "dir") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<label for="order">Order By:</label> ';
    echo '<select name="order">';
    echo '<option value="2" '.($order==2 ? 'selected' : '').'>Champion</option>';
    echo '<option value="5" '.($order==5 ? 'selected' : '').'>Level</option>';
    echo '<option value="6" '.($order==6 ? 'selected' : '').'>Points</option>';
    echo '<option value="7" '.($order==7 ? 'selected' : '').'>Last Played</option>';
    echo '<option value="10" '.($order==10 ? 'selected' : '').'>Chest Granted</option>';
    echo '</select> ';
    echo '<label for="dir">Direction:</label> ';
    echo '<select name="dir">';
    echo '<option value="asc" '.($dir=='asc' ? 'selected' : '').'>Ascending</option>';
    echo '<option value="desc" '.($dir=='desc' ? 'selected' : '').'>Descending</option>';
    echo '</select> ';
    echo '<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Go</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo '<div class="champions">';

    foreach($table as $row) {
//        $query = 'SELECT * FROM '.$region.'_'.$id.'_champions WHERE championid='.$row['id'];
//        $result = $conn->prepare($query);
//        $result->execute();
//        $mastery = $result->fetchAll()[0];

//        echo '<tr>';
//        echo '<td style="width: 50px;">'.getChampionIMG($row['pic'], $row['name'], '6.5.1', 50, 50).'</td>';
//        echo '<td>'.$mastery['championlevel'].'</td>';
//        echo '<td>'.$mastery['championpoints'].'</td>';
//        echo '<td>'.$mastery['lastplay'].'</td>';
//        echo '<td>'.$mastery['championpointssincelastlevel'].'</td>';
//        echo '<td>'.$mastery['championpointsuntilnextlevel'].'</td>';
//        echo '<td>'.$mastery['chestgranted'].'</td>';
//        echo '</tr>';

        if($row['championlevel'] == null) {
            echo '<div class="champion-not-owned">';
            echo getChampionIMG($row['pic'], $row['name'].'&#010;'.$row['title'], $ddver_latest, 120, 120, 1);
            echo '<div class="mastery-level lvl0">0</div>';
            echo '<div class="mastery-stat">Points: 0</div>';
            echo '<div class="mastery-stat">Last Played: Never</div>';
            echo '<div class="progress" style="margin: 0; height: 20px;" data-toggle="tooltip" data-placement="top" title="0%">';
            echo '<div class="progress-bar progress-bar-success" role="progressbar" style="height: 20px; width:0"></div>';
            echo '<span>0/1800</span>';
            echo '</div>';
            echo '<div class="mastery-stat">Chest: No</div>';
            echo '</div>';
        } else {
            echo '<div class="champion">';
            echo getChampionIMG($row['pic'], $row['name'].'&#010;'.$row['title'], $ddver_latest, 120, 120, 1);
            echo '<div class="mastery-level lvl'.$row['championlevel'].'">'.$row['championlevel'].'</div>';
            echo '<div class="mastery-stat">Points: '.$row['championpoints'].'</div>';
            echo '<div class="mastery-stat">Last Played: '.date('Y/m/d', $row['lastplay']/1000).'</div>';
            echo '<div class="progress" style="margin: 0; height: 20px;" data-toggle="tooltip" data-placement="top" title="'.round(($row['championpointssincelastlevel'] / ($row['championpointssincelastlevel']+$row['championpointsuntilnextlevel'])) * 100, 0).'%">';
            if($row['championlevel'] == 5) {
                echo '<div class="progress-bar progress-bar-danger" role="progressbar" style="height: 20px; width:'.round(($row['championpointssincelastlevel'] / ($row['championpointssincelastlevel']+$row['championpointsuntilnextlevel'])) * 100, 0).'%"></div>';
                echo '<span>'.$row['championpoints'].'</span>';
            } else {
                echo '<div class="progress-bar progress-bar-success" role="progressbar" style="height: 20px; width:'.round(($row['championpointssincelastlevel'] / ($row['championpointssincelastlevel']+$row['championpointsuntilnextlevel'])) * 100, 0).'%"></div>';
                echo '<span>'.$row['championpointssincelastlevel'].'/'.($row['championpointssincelastlevel']+$row['championpointsuntilnextlevel']).'</span>';
            }
            echo '</div>';
            echo '<div class="mastery-stat">Chest: '. ($row['chestgranted'] ? 'Yes' : 'No').'</div>';
            echo '</div>';
        }
    }
//    echo '</tbody>';
//    echo '</table>';
    echo '</div>';
    echo '</div>';
}


?>
<?php require_once 'footer.php'; ?>