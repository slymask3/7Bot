<?php
//$updatephase will control the updates below like prints and changes.
//no      == all good, no update needed or in progress
//confirm == should show confirm button now, and only update the summoner (rank, icon, name)
//yes     == updating currently.
$updatephase = 'no';

try {
    if(!empty($_POST['update'])) {

        $api = new riotapi($region);
        $apiCache = new riotapi($region, new FileSystemCache('cache/'));

//        var_dump($updatephase);

        if ($_POST['update'] == 'confirm') {

//            include_once 'updatesummoner.php';
            include_once 'updateaccount.php';

            if (!empty($region) && !empty($username)) {
//                $query = 'UPDATE accounts SET id=' . $summoner['id'] . ', displayname="' . $summoner['name'] . '", icon=' . $summoner['profileIconId'] . ', tier="' . $tier . '", division="' . $division . '", lp=' . $lp . ', s6=' . ($s6g ? 1 : 0) . ', s5=' . ($s5g ? 1 : 0) . ', s4=' . ($s4g ? 1 : 0) . ', s3=' . ($s3g ? 1 : 0) . ',
//                  s6dynamic=' . ($s6dynamic ? 1 : 0) . ', s6solo=' . ($s6solo ? 1 : 0) . ', s6team5=' . ($s6team5 ? 1 : 0) . ', s6team3=' . ($s6team3 ? 1 : 0) . ',
//                  s5dynamic=' . ($s5dynamic ? 1 : 0) . ', s5solo=' . ($s5solo ? 1 : 0) . ', s5team5=' . ($s5team5 ? 1 : 0) . ', s5team3=' . ($s5team3 ? 1 : 0) . ',
//                  s4dynamic=' . ($s4dynamic ? 1 : 0) . ', s4solo=' . ($s4solo ? 1 : 0) . ', s4team5=' . ($s4team5 ? 1 : 0) . ', s4team3=' . ($s4team3 ? 1 : 0) . ',
//                  s3dynamic=' . ($s3dynamic ? 1 : 0) . ', s3solo=' . ($s3solo ? 1 : 0) . ', s3team5=' . ($s3team5 ? 1 : 0) . ', s3team3=' . ($s3team3 ? 1 : 0) . ' WHERE username="' . strtolower(str_replace(' ', '', $username)) . '"';
//                $result = $conn->prepare($query);
//                $result->execute();

                $amountofgames = 0;
                for($i=0; $i<$games['totalGames']; $i++) {
                    if(($games['matches'][$i]['season'] == $seasonCode || $games['matches'][$i]['season'] == $preseasonCode) && $games['matches'][$i]['queue'] == $queueCode) {
                        $query = 'SELECT matchid FROM matches_'.$region.'_'.$seasonCode.' WHERE matchid='.$games['matches'][$i]['matchId'];
                        $result = $conn->prepare($query);
                        $result->execute();

                        if($result->rowCount() == 0) {
                            $amountofgames++;
                        }
                    }
                }

//                $accountid = $summoner['id'];
//                include 'updatesideinfo.php';

                if($amountofgames > 0) {
                    $timepergame = 3;
                    echo '<div class="topinfo">';
                    echo 'We found '.$amountofgames.' '.$queue.' game'.addS($amountofgames).' in season '.$season.' for '.$summoner['name'].' that aren\'t currently in our system. Updating these games could take approximately '.(round((($amountofgames)*$timepergame)/60, 0)).' minutes and '.(($amountofgames*$timepergame)%60).' seconds to complete. Click confirm if you are sure you want to proceed.';
                    echo '</div>';
                    $updatephase = 'confirm';
//        var_dump($updatephase);
                } else {
                    echo '<div class="topinfo">';
                    echo 'The system seems to be up to date with '.$summoner['name'].'\'s '.$queue.' games in season '.$season.'.';
                    echo '</div>';
                    $updatephase = 'no';
//        var_dump($updatephase);
                }
            }
        } else if ($_POST['update'] == 'yes') {
            $updatephase = 'yes';

            $query = 'SELECT * FROM accounts_'.$region.' WHERE username LIKE "' . strtolower(str_replace(' ', '', $username)) . '"';
            $result = $conn->prepare($query);
            $result->execute();
            $account = $result->fetchAll()[0];

//            var_dump($result->rowCount());

            //There should be an entry now, but check just incase.
            if ($result->rowCount() > 0) {
                try {
                    if (!empty($region) && !empty($username) && ($season != 'merged')) {
                        //$id = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))];
                        $r = $api->getMatchHistory($account['id']);

                        //$dbtable = strtoupper($region) . '_' . $id['id'] . '_SEASON201' . $season . '_' . strtoupper($queue);

                        $query = createMatchesTableIfNotExists4($region, $seasonCode);
                        $result = $conn->prepare($query);
                        $result->execute();

                        $started = new DateTime();
                        echo '<div class="topinfo"><div class="topinfo-text">Started: ' . date('Y/m/d H:i:s', $started->getTimestamp()) . '<br>';

                        $amountofgames = 0;
                        $retryafter = 0;

                        for($i=0; $i<$r['totalGames']; $i++) {
                            if(($r['matches'][$i]['season'] == $seasonCode || $r['matches'][$i]['season'] == $preseasonCode) && $r['matches'][$i]['queue'] == $queueCode) {
                                $query = 'SELECT matchid FROM matches_'.$region.'_'.$seasonCode.' WHERE matchid='.$r['matches'][$i]['matchId'];
                                $result = $conn->prepare($query);
                                $result->execute();

                                sleep($retryafter);

                                if($result->rowCount() == 0) {
                                    try {
                                        $match = $apiCache->getMatch($r['matches'][$i]['matchId']);

                                        $query = 'INSERT INTO matches_'.$region.'_'.$seasonCode.' VALUES(:id, from_unixtime(:date/1000), :game);';
                                        $result = $conn->prepare($query);
                                        $result->bindParam(':id', $r['matches'][$i]['matchId'], PDO::PARAM_INT);
                                        $result->bindParam(':game', json_encode($match), PDO::PARAM_STR);
                                        $result->bindParam(':date',  $match['matchCreation'], PDO::PARAM_INT);
                                        $result->execute();
//                                        var_dump($query, $result->errorInfo());

                                        echo 'Added game with match id of ' . $r['matches'][$i]['matchId'] . '.<br>';
                                        //echo $query.'<br>';
                                        $amountofgames++;
                                        usleep(1500000); //1.5sec
                                    } catch(Exception $e) {
//                                        echo '<span class="error">';
//                                        echo 'Failed to add game with match id of '.$r['matches'][$i]['matchId'].' (' .$e->getCode().' - '.$e->getMessage().')<br>';
//                                        echo '</span>';
                                        include 'matcherrorhandler.php';
                                    } finally {
                                        if($api->getLastResponseCode() == 429) {
                                            $retryafter = 10;
                                        }
                                    }
                                }
                            }
                        }
                        $accountid = $account['id'];
                        include 'updatesideinfo.php';

                        $ended = new DateTime();
                        $seconds = ($ended->diff($started)->h*3600)+($ended->diff($started)->m*60)+$ended->diff($started)->s;
                        echo 'Ended: ' . date('Y/m/d H:i:s', $ended->getTimestamp()) . ' (Took '.$seconds.' second'.addS($seconds).' to add '.$amountofgames.' game'.addS($amountofgames).'. At an average of '.(($seconds)/($amountofgames)).'sec/game)';
                    }
                } catch (PDOException $e) {
                    echo '<div class="topinfo error">';
                    echo 'Error Code: ' .$e->getCode().'<br>';
                    echo 'Error: ' .$e->getMessage().'<br>';
                    echo 'Info: ' .$e->errorInfo.'<br>';
                    echo 'Line: ' .$e->getLine();
                    echo '</div>';
                } catch (Exception $e) {
                    echo '<div class="topinfo error">';
                    echo 'Error Code: ' .$e->getCode().'<br>';
                    echo 'Error: ' .$e->getMessage().'<br>';
                    echo 'Line: ' .$e->getLine();
                    echo '</div>';
                } finally{
                    echo '</div>';
                    echo '</div>';
                };
            }
        }
    }
} catch(Exception $e) {
    echo '<div class="topinfo error">';
    echo 'An error occurred, make sure you have entered the correct information.';
    echo '</div>';
}
?>