<?php
//$updatephase will control the updates below like prints and changes.
//no      == all good, no update needed or in progress
//confirm == should show confirm button now, and only update the summoner (rank, icon, name)
//yes     == updating currently.
$updatephase = 'no';

try {
    if(!empty($_POST['update'])) {
        //$api = new riotapi(strtolower($region));
        //var_dump($_POST['update']);
        //$api = new riotapi(strtolower($region), new FileSystemCache('cache/'));
        $api = new riotapi(strtolower($region));
        if ($_POST['update'] == 'confirm') {

            include_once 'updatesummoner.php';

            if (!empty($region) && !empty($username) && ($season != 'merged')) {
                $query = 'UPDATE accounts SET id=' . $summoner['id'] . ', displayname="' . $summoner['name'] . '", icon=' . $summoner['profileIconId'] . ', tier="' . $tier . '", division="' . $division . '", lp=' . $lp . ', s6=' . ($s6g ? 1 : 0) . ', s5=' . ($s5g ? 1 : 0) . ', s4=' . ($s4g ? 1 : 0) . ', s3=' . ($s3g ? 1 : 0) . ',
                  s6dynamic=' . ($s6dynamic ? 1 : 0) . ', s6solo=' . ($s6solo ? 1 : 0) . ', s6team5=' . ($s6team5 ? 1 : 0) . ', s6team3=' . ($s6team3 ? 1 : 0) . ',
                  s5dynamic=' . ($s5dynamic ? 1 : 0) . ', s5solo=' . ($s5solo ? 1 : 0) . ', s5team5=' . ($s5team5 ? 1 : 0) . ', s5team3=' . ($s5team3 ? 1 : 0) . ',
                  s4dynamic=' . ($s4dynamic ? 1 : 0) . ', s4solo=' . ($s4solo ? 1 : 0) . ', s4team5=' . ($s4team5 ? 1 : 0) . ', s4team3=' . ($s4team3 ? 1 : 0) . ',
                  s3dynamic=' . ($s3dynamic ? 1 : 0) . ', s3solo=' . ($s3solo ? 1 : 0) . ', s3team5=' . ($s3team5 ? 1 : 0) . ', s3team3=' . ($s3team3 ? 1 : 0) . ' WHERE username="' . strtolower(str_replace(' ', '', $username)) . '"';
                $result = $conn->prepare($query);
                $result->execute();

                $last10 = $api->getGame($summoner['id']);
//                echo '<pre>';
//                print_r($last10['games'][0]);
//                echo '</pre>';

                $query = createLast10TableIfNotExists($region, $summoner['id']);
                $result = $conn->prepare($query);
                $result->execute();

                $query = 'SELECT * FROM '.$region.'_'.$summoner['id'].'_last10 ORDER BY creation DESC';
                $result = $conn->prepare($query);
                $result->execute();
                $latestgame = $result->fetchAll()[0]['matchid'];

                if($latestgame != $last10['games'][0]['gameId']) {
                    echo '<div class="topinfo">';
                    echo $summoner['name'].' has played more games since the last time his last 10 games were updated. Please click the confirm button to update the last 10 games.';
                    echo '</div>';
                    $updatephase = 'confirm';
                } else {
                    echo '<div class="topinfo">';
                    echo 'The system seems to be up to date with '.$summoner['name'].'\'s last 10 games.';
                    echo '</div>';
                    $updatephase = 'no';
                }
            }
        } else if ($_POST['update'] == 'yes') {
            $updatephase = 'yes';
            //echo 'Update is not empty: update == '.$_POST['update'];

            $query = 'SELECT * FROM accounts WHERE username LIKE "' . strtolower(str_replace(' ', '', $username)) . '"';
            $result = $conn->prepare($query);
            $result->execute();
            $account = $result->fetchAll()[0];

            //var_dump($account['id']);

            //There should be an entry now, but check just incase.
            if ($result->rowCount() > 0) {
                $dbtable = '';
                try {
                    if (!empty($region) && !empty($username)) {
                        $r = $api->getGame($account['id']);

            //var_dump($r);

                        $dbtable = strtoupper($region) . '_' . $account['id'] . '_last10';

                        $query = 'DROP TABLE IF EXISTS '.$dbtable;
                        $result = $conn->prepare($query);
                        $result->execute();

                        $query = createLast10TableIfNotExists($region, $account['id']);
                        $result = $conn->prepare($query);
                        $result->execute();
                            //var_dump($query);

                        foreach($r['games'] as $game) {
                            $g = (array)$game;

                            $id = 0;
                            $matchid = 0;
                            $gamemode = '';
                            $gametype = '';
                            $subtype = '';
                            $mapid = 0;
                            $championid = 0;
                            $spell1 = 0;
                            $spell2 = 0;
                            $ip = 0;
                            $creation = 0;
                            $lane = '';
                            $level = 0;
                            $kills = 0;
                            $deaths = 0;
                            $assists = 0;
                            $cs = 0;
                            $gold = 0;
                            $damage = 0;
                            $team = '';
                            $item0 = 0;
                            $item1 = 0;
                            $item2 = 0;
                            $item3 = 0;
                            $item4 = 0;
                            $item5 = 0;
                            $item6 = 0;
                            $length = 0;
                            $outcome = '';

                            $id = $account['id'];
                            $matchid = $g['gameId'];
                            $gamemode = $g['gameMode'];
                            $gametype = $g['gameType'];
                            $subtype = $g['subType'];
                            $mapid = $g['mapId'];
                            $championid = $g['championId'];
                            $spell1 = $g['spell1'];
                            $spell2 = $g['spell2'];
                            $ip = $g['ipEarned'];
                            $creation = $g['createDate'];
                            if($gamemode != 'ARAM') {
                                $lane = getLaneForLast10($g['stats']['playerPosition'], $g['stats']['playerRole']);
                            } else {
                                $lane = 'Mid';
                            }
                            $level = $g['stats']['level'];
                            $kills = $g['stats']['championsKilled'];
                            $deaths = $g['stats']['numDeaths'];
                            $assists = $g['stats']['assists'];
                            $cs = $g['stats']['minionsKilled'] + $g['stats']['neutralMinionsKilled'];
                            $gold = $g['stats']['goldEarned'];
                            $damage = $g['stats']['totalDamageDealtToChampions'];
                            $team = getTeam($g['stats']['team']);
                            $item0 = $g['stats']['item0'];
                            $item1 = $g['stats']['item1'];
                            $item2 = $g['stats']['item2'];
                            $item3 = $g['stats']['item3'];
                            $item4 = $g['stats']['item4'];
                            $item5 = $g['stats']['item5'];
                            $item6 = $g['stats']['item6'];
                            $length = $g['stats']['timePlayed'];
                            $outcome = getOutcome($g['stats']['win']);

                            $query = insertIntoLast10($region, $id, $matchid, $gamemode, $gametype, $subtype, $mapid,
                                $championid, $spell1, $spell2, $ip, $creation, $lane, $level, $kills, $deaths, $assists, $cs,
                                $gold, $damage, $team, $item0, $item1, $item2, $item3, $item4, $item5, $item6, $length, $outcome);
                            $result = $conn->prepare($query);
                            $result->execute();
                            //var_dump($query);
//                            echo '<pre>';
//                            print_r($query);
//                            echo '</pre>';
                        }
                        echo '<div class="topinfo">';
                        echo 'We\'ve updated '.$account['displayname'].'\'s last 10 games.';
                        echo '</div>';
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                };
            }
        }
    }
} catch(Exception $e) {
    echo '<div class="topinfo" style="color: red;">';
    echo 'An error occured, make sure you have entered the correct information.';
    echo '</div>';
}
?>