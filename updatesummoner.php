<?php
/*
 * This php page is responsible for updating the summoner in the accounts table.
 */

$query = 'SELECT * FROM accounts WHERE username LIKE "' . strtolower(str_replace(' ', '', $username)) . '"';
$result = $conn->prepare($query);
$result->execute();
$account = $result->fetchAll();

$summoner = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))];

//No rows returned, meaning theres no entry for this summoner yet. Create it:
if ($result->rowCount() == 0) {
    //echo 'No information found on: "' . $username . '"';

    $tier = 'Unranked';
    $division = '';
    $lp = 0;
    //$rank = 'Unranked';
    try {
        $league = $api->getLeague($summoner['id'])[$summoner['id']][0];

        $tier = ucwords(strtolower($league['tier']));
        $division = 'V';
        $lp = 0;
        for ($i = 0; $i < count($league['entries']); $i++) {
            //echo $r3['entries'][$i]['playerOrTeamId'].' - '.$id['id'].'<br>';
            if ($league['entries'][$i]['playerOrTeamId'] == $summoner['id']) {
                $division = $league['entries'][$i]['division'];
                $lp = $league['entries'][$i]['leaguePoints'];
            }
        }

        //$rank = $tier . ' ' . $division . ' ' . $lp . 'LP';
    } catch (Exception $e) {
        $tier = 'Unranked';
        $rank = 'Unranked';
    }

    $query = 'INSERT INTO accounts VALUES(' . $summoner['id'] . ', "' . $region . '", "' . strtolower(str_replace(' ', '', $username)) . '", "' . $summoner['name'] . '", ' . $summoner['profileIconId'] . ', "' . $tier . '", "' . $division . '", ' . $lp . ', false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false)';
    $result = $conn->prepare($query);
    $result->execute();
    //var_dump($query);
}

if (!empty($region) && !empty($username) && ($season != 'merged')) {
    //$id = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))];
    $r = $apiCache->getMatchHistory($summoner['id']);

//    $dbtable = strtoupper($region) . '_' . $summoner['id'] . '_SEASON201' . $season . '_' . strtoupper($queue);
//
//    $query = createGamesTableIfNotExists($dbtable);
//    $result = $conn->prepare($query);
//    $result->execute();
//
//    $query = 'SELECT COUNT(*) FROM ' . $dbtable;
//    $result = $conn->prepare($query);
//    $result->execute();
//    $totalgamestable = $result->fetchAll()[0][0];
//
//    $totalgames = 0;
//    //$games = array();
//    for ($i = 0; $i < $r['totalGames']; $i++) {
//        if ($r['matches'][$i]['queue'] == $queueCode && ($r['matches'][$i]['season'] == 'SEASON201' . $season || $r['matches'][$i]['season'] == 'PRESEASON201' . (((int)$season) + 1))) {
//            $totalgames++;
//            //array_push($games, $r['matches'][$i]);
//        }
//    }

    ///////////

    $tier = 'Unranked';
    $division = '';
    $lp = 0;
    //$rank = 'Unranked';
    try {
        $league = $api->getLeague($summoner['id'])[$summoner['id']][0];

        $tier = ucwords(strtolower($league['tier']));
        $division = 'V';
        $lp = 0;
        for ($i = 0; $i < count($league['entries']); $i++) {
            //echo $r3['entries'][$i]['playerOrTeamId'].' - '.$id['id'].'<br>';
            if ($league['entries'][$i]['playerOrTeamId'] == $summoner['id']) {
                $division = $league['entries'][$i]['division'];
                $lp = $league['entries'][$i]['leaguePoints'];
            }
        }

        //$rank = $tier . ' ' . $division . ' ' . $lp . 'LP';
    } catch (Exception $e) {
        $tier = 'Unranked';
        $rank = 'Unranked';
    }

    $s6games = array();
    $s5games = array();
    $s4games = array();
    $s3games = array();

    for ($i = 0; $i < $r['totalGames']; $i++) {
        if ($r['matches'][$i]['season'] == 'SEASON2016' || $r['matches'][$i]['season'] == 'PRESEASON2017') {
            array_push($s6games, $r['matches'][$i]);
        }
        if ($r['matches'][$i]['season'] == 'SEASON2015' || $r['matches'][$i]['season'] == 'PRESEASON2016') {
            array_push($s5games, $r['matches'][$i]);
        }
        if ($r['matches'][$i]['season'] == 'SEASON2014' || $r['matches'][$i]['season'] == 'PRESEASON2015') {
            array_push($s4games, $r['matches'][$i]);
        }
        if ($r['matches'][$i]['season'] == 'PRESEASON3' || $r['matches'][$i]['season'] == 'SEASON3' || $r['matches'][$i]['season'] == 'PRESEASON2014') {
            array_push($s3games, $r['matches'][$i]);
        }
    }

    $s6g = false;
    $s5g = false;
    $s4g = false;
    $s3g = false;

    $s6dynamic = false;
    $s6solo = false;
    $s6team5 = false;
    $s6team3 = false;

    $s5dynamic = false;
    $s5solo = false;
    $s5team5 = false;
    $s5team3 = false;

    $s4dynamic = false;
    $s4solo = false;
    $s4team5 = false;
    $s4team3 = false;

    $s3dynamic = false;
    $s3solo = false;
    $s3team5 = false;
    $s3team3 = false;

    for ($i = 0; $i < count($s6games); $i++) {
        $s6g = true;
        if ($s6games[$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
            $s6dynamic = true;
        }
        if ($s6games[$i]['queue'] == 'RANKED_SOLO_5x5') {
            $s6solo = true;
        }
        if ($s6games[$i]['queue'] == 'RANKED_TEAM_5x5') {
            $s6team5 = true;
        }
        if ($s6games[$i]['queue'] == 'RANKED_TEAM_3x3') {
            $s6team3 = true;
        }
    }

    for ($i = 0; $i < count($s5games); $i++) {
        $s5g = true;
        if ($s5games[$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
            $s5dynamic = true;
        }
        if ($s5games[$i]['queue'] == 'RANKED_SOLO_5x5') {
            $s5solo = true;
        }
        if ($s5games[$i]['queue'] == 'RANKED_TEAM_5x5') {
            $s5team5 = true;
        }
        if ($s5games[$i]['queue'] == 'RANKED_TEAM_3x3') {
            $s5team3 = true;
        }
    }

    for ($i = 0; $i < count($s4games); $i++) {
        $s4g = true;
        if ($s4games[$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
            $s4dynamic = true;
        }
        if ($s4games[$i]['queue'] == 'RANKED_SOLO_5x5') {
            $s4solo = true;
        }
        if ($s4games[$i]['queue'] == 'RANKED_TEAM_5x5') {
            $s4team5 = true;
        }
        if ($s4games[$i]['queue'] == 'RANKED_TEAM_3x3') {
            $s4team3 = true;
        }
    }

    for ($i = 0; $i < count($s3games); $i++) {
        $s3g = true;
        if ($s3games[$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
            $s3dynamic = true;
        }
        if ($s3games[$i]['queue'] == 'RANKED_SOLO_5x5') {
            $s3solo = true;
        }
        if ($s3games[$i]['queue'] == 'RANKED_TEAM_5x5') {
            $s3team5 = true;
        }
        if ($s3games[$i]['queue'] == 'RANKED_TEAM_3x3') {
            $s3team3 = true;
        }
    }
}
?>