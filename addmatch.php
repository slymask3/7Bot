<?php
$page = 'toplist';
$pagename = 'Top List';
require_once 'header.php';

/*
 * This php page adds a match to the matches table.
 * It makes a total of 1 api call.
 * It makes a call to the match endpoint.
 */

//Create api instances if they're not yet set.
if(!isset($api)) {
    $api = new riotapi($region);
}
if(!isset($apiCache)) {
    $apiCache = new riotapi($region, new FileSystemCache('cache/'));
}

$matchid = '';
if(!empty($_GET['match'])) {
    $matchid = $_GET['match'];
}

//Create the matches table if it does not exist for thsi region yet.
//$query = createMatchesTableIfNotExists($region);
$query = 'CREATE TABLE IF NOT EXISTS matches_'.$region.' (matchid BIGINT PRIMARY KEY, data JSON);';
$result = $conn->prepare($query);
$result->execute();
var_dump($result->errorInfo());

if($matchid != 0) {
    try {
        $match = $api->getMatch($matchid, true);
//        $creation = $match['matchCreation'];
//        $duration = $match['matchDuration'];
//        $type = $match['matchType'];
//        $mode = $match['matchMode'];
//        $queue = $match['queueType'];
//        $season = $match['season'];
//        $mapid = $match['mapId'];
//        $version = $match['matchVersion'];
//        $ddver = getDDVer($version);
//        $platform = $match['platformId'];
//		$winner = '';
//        if ($match['teams'][0]['winner']) {
//            $winner = 100;
//        } else if ($match['teams'][1]['winner']) {
//            $winner = 200;
//        }
//
//        $id = array();
//        $displayname = array();
//        $lane = array();
//        $championid = array();
//        $kills = array();
//        $deaths = array();
//        $assists = array();
//        $damage = array();
//        $gold = array();
//        $cs = array();
//        $spell1id = array();
//        $spell2id = array();
//        $item0 = array();
//        $item1 = array();
//        $item2 = array();
//        $item3 = array();
//        $item4 = array();
//        $item5 = array();
//        $item6 = array();
//        $wards = array();
//        $teamid = array();
//        $keystone = array();
//
//        for($i=0; $i<count($match['participants']); $i++) {
//            array_push($id, $match['participantIdentities'][$i]['player']['summonerId']);
//            array_push($displayname, $match['participantIdentities'][$i]['player']['summonerName']);
//            array_push($lane, getCorrectLane($match, $i));
//            array_push($championid, $match['participants'][$i]['championId']);
//            array_push($kills, $match['participants'][$i]['stats']['kills']);
//            array_push($deaths, $match['participants'][$i]['stats']['deaths']);
//            array_push($assists, $match['participants'][$i]['stats']['assists']);
//            array_push($damage, $match['participants'][$i]['stats']['totalDamageDealtToChampions']);
//            array_push($gold, $match['participants'][$i]['stats']['goldEarned']);
//            array_push($cs, $match['participants'][$i]['stats']['minionsKilled']+$match['participants'][$i]['stats']['neutralMinionsKilled']);
//            array_push($spell1id, $match['participants'][$i]['spell1Id']);
//            array_push($spell2id, $match['participants'][$i]['spell2Id']);
//            array_push($item0, $match['participants'][$i]['stats']['item0']);
//            array_push($item1, $match['participants'][$i]['stats']['item1']);
//            array_push($item2, $match['participants'][$i]['stats']['item2']);
//            array_push($item3, $match['participants'][$i]['stats']['item3']);
//            array_push($item4, $match['participants'][$i]['stats']['item4']);
//            array_push($item5, $match['participants'][$i]['stats']['item5']);
//            array_push($item6, $match['participants'][$i]['stats']['item6']);
//            array_push($wards, $match['participants'][$i]['stats']['wardsPlaced']);
//            array_push($teamid, $match['participants'][$i]['teamId']);
//            for($j=0; $j<count($match['participants'][$i]['masteries']); $j++) {
//                $query = 'SELECT * FROM keystones WHERE id='.$match['participants'][$i]['masteries'][$j]['masteryId'];
//                $result = $conn->prepare($query);
//                $result->execute();
//                if($result->rowCount() > 0) {
//                    array_push($keystone, $match['participants'][$i]['masteries'][$j]['masteryId']);
//                }
//            }
//        }
//
//        $ban11 = $match['teams'][0]['bans'][0]['championId'];
//        $ban12 = $match['teams'][0]['bans'][1]['championId'];
//        $ban13 = $match['teams'][0]['bans'][2]['championId'];
//        $ban21 = $match['teams'][1]['bans'][0]['championId'];
//        $ban22 = $match['teams'][1]['bans'][1]['championId'];
//        $ban23 = $match['teams'][1]['bans'][2]['championId'];

//        $query = insertIntoMatches($region, $matchid, $creation, $duration, $type, $mode, $queue, $season, $mapid, $version, $ddver, $platform, $mapid, $winner,
//                                   $id, $displayname, $lane, $championid, $kills, $deaths, $assists, $damage, $gold, $cs, $spell1id, $spell2id,
//                                   $item0, $item1, $item2, $item3, $item4, $item5, $item6, $wards, $teamid, $keystone,
//                                   $ban11, $ban12, $ban13, $ban21, $ban22, $ban23);
        $query = 'INSERT INTO matches_'.$region.' VALUES(:id, :game);';
        $result = $conn->prepare($query);
        $result->bindParam(':id', $matchid, PDO::PARAM_INT);
        $result->bindParam(':game', json_encode($match), PDO::PARAM_STR);
        $result->execute();
        var_dump($result->errorInfo());
        var_dump($result->fetchAll());
//        echo '<pre>';
//        print_r($query);
//        echo '</pre>';
//        echo '<pre>';
//        var_dump(json_encode($match['timeline']));
//        echo '</pre>';

//        $query = 'INSERT INTO matches_test VALUES(:data)';
//        $result = $conn->prepare($query);
//        $result->bindParam(':data', json_encode($match), PDO::PARAM_STR);
//        $result->execute();

//        $query = 'SELECT * FROM matches_test';
//        $result = $conn->prepare($query);
//        $result->execute();
//        $table = $result->fetchAll();

//        echo '<pre>';
//        print_r($table);
//        echo '</pre>';

    } catch(Exception $e) {

    }
}

require_once 'footer.php';
?>