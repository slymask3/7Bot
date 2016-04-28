<?php

/*
 * This php page updates a summoner in the accounts table.
 * It makes a total of 2 api calls.
 * It makes a call to the summoner, and to the summoner's league.
 */

//Create api instances if they're not yet set.
if(!isset($api)) {
    $api = new riotapi($region);
}
if(!isset($apiCache)) {
    $apiCache = new riotapi($region, new FileSystemCache('cache/'));
}

//Create the accounts table if it does not exist for thsi region yet.
$query = createAccountsTableIfNotExists($region);
$result = $conn->prepare($query);
$result->execute();
//var_dump($query);

//Check the accounts table for an entry for the player.
$query = 'SELECT * FROM accounts_'.$region.' WHERE username="'.strtolower(str_replace(' ', '', $username)).'"';
$result = $conn->prepare($query);
$result->execute();
$accountrow = $result->fetchAll()[0];
//var_dump($query);

//There is no entry for the player.
if($result->rowCount() == 0) {
    $summoner = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))];
} else {
    $summoner = $api->getSummoner($accountrow['id'])[$accountrow['id']];
}

//Grab all info from the summoner call
$id = $summoner['id'];
$displayname = $summoner['name'];
$profileicon = $summoner['profileIconId'];
$level = $summoner['summonerLevel'];
$revision = $summoner['revisionDate'];

//Attempt to grab info from the league call, will fail when player is unranked.
try {
    $league = $api->getLeague($id, 'entry')[$id][0];
    $tier = ucwords(strtolower($league['tier']));
    $leaguename = $league['name'];
    $lp = $league['entries'][0]['leaguePoints'];
    $division = $league['entries'][0]['division'];
    $wins = $league['entries'][0]['wins'];
    $losses = $league['entries'][0]['losses'];
    //var_dump($league);
} catch(Exception $e) {
    $tier = 'Unranked';
    $leaguename = '';
    $lp = 0;
    $division = '';
    $wins = 0;
    $losses = 0;
}

try {
    $games = $apiCache->getMatchHistory($summoner['id']);
    $queues = '';
    $queuesBool = array();

    for($i=0; $i<20; $i++) {
        $queuesBool[$i] = false;
    }

    for ($i = 0; $i < $games['totalGames']; $i++) {
        if($games['matches'][$i]['season'] == 'SEASON2016' || $games['matches'][$i]['season'] == 'PRESEASON2017') {
            $queuesBool[0] = true;
            if($games['matches'][$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
                $queuesBool[1] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_SOLO_5x5') {
                $queuesBool[2] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_5x5') {
                $queuesBool[3] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_3x3') {
                $queuesBool[4] = true;
            }
        }
        if($games['matches'][$i]['season'] == 'SEASON2015' || $games['matches'][$i]['season'] == 'PRESEASON2016') {
            $queuesBool[5] = true;
            if($games['matches'][$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
                $queuesBool[6] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_SOLO_5x5') {
                $queuesBool[7] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_5x5') {
                $queuesBool[8] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_3x3') {
                $queuesBool[9] = true;
            }
        }
        if($games['matches'][$i]['season'] == 'SEASON2014' || $games['matches'][$i]['season'] == 'PRESEASON2015') {
            $queuesBool[10] = true;
            if($games['matches'][$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
                $queuesBool[11] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_SOLO_5x5') {
                $queuesBool[12] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_5x5') {
                $queuesBool[13] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_3x3') {
                $queuesBool[14] = true;
            }
        }
        if($games['matches'][$i]['season'] == 'SEASON3' || $games['matches'][$i]['season'] == 'PRESEASON2014') {
            $queuesBool[15] = true;
            if($games['matches'][$i]['queue'] == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
                $queuesBool[16] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_SOLO_5x5') {
                $queuesBool[17] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_5x5') {
                $queuesBool[18] = true;
            } else if($games['matches'][$i]['queue'] == 'RANKED_TEAM_3x3') {
                $queuesBool[19] = true;
            }
        }
    }

    for($i=0; $i<20; $i++) {
        if($queuesBool[$i]) {
            $queues .= '1';
        } else {
            $queues .= '0';
        }
    }
} catch(Exception $e) {
    $queues = '';
    for($i=0; $i<20; $i++) {
        $queues  .= '0';
    }
}

//Set the last updated variable.
$lastupdated = (new DateTime())->getTimestamp();
$trimmedusername = strtolower(str_replace(' ', '', $username));
//There is no entry for the player, so insert one.
if($result->rowCount() == 0) {
    $query = 'INSERT INTO accounts_'.$region.' VALUES(:id, :un, :dn, :icon, :lvl, :rev, :tier, :div, :lp, :ln, :wins, :losses, :lu, :q, -1)';
} else { //There is already an entry for this player, so update it.
    $query = 'UPDATE accounts_'.$region.' SET username=:un, displayname=:dn, profileicon=:icon, level=:lvl, revision=:rev, tier=:tier, division=:div, lp=:lp, leaguename=:ln, wins=:wins, losses=:losses, lastupdated=:lu, queues=:q WHERE id=:id';
}
$result = $conn->prepare($query);
$result->bindParam(':id', $id, PDO::PARAM_INT);
$result->bindParam(':un', $trimmedusername, PDO::PARAM_STR, 16);
$result->bindParam(':dn', $displayname, PDO::PARAM_STR, 16);
$result->bindParam(':icon', $profileicon, PDO::PARAM_INT);
$result->bindParam(':lvl', $level, PDO::PARAM_INT);
$result->bindParam(':rev', $revision, PDO::PARAM_INT);
$result->bindParam(':tier', $tier, PDO::PARAM_STR, 10);
$result->bindParam(':div', $division, PDO::PARAM_STR, 3);
$result->bindParam(':lp', $lp, PDO::PARAM_INT);
$result->bindParam(':ln', $leaguename, PDO::PARAM_STR, 36);
$result->bindParam(':wins', $wins, PDO::PARAM_INT);
$result->bindParam(':losses', $losses, PDO::PARAM_INT);
$result->bindParam(':lu', $lastupdated, PDO::PARAM_INT);
$result->bindParam(':q', $queues, PDO::PARAM_STR, 20);
$result->execute();
//var_dump($result->errorCode(), $result->errorInfo());
//
//$now = new DateTime();
//$then = new DateTime();
//$then->setTimestamp($lastupdated);
//$ago = $now->diff($then);
//$days = $ago->days;
//$hours = $ago->h;
//$min = $ago->i;
//
//echo '<div class="summoner2-lastupdated">';
//echo 'Updated '.$days.' day'.addS($days).', '.$hours.' hour'.addS($hours).' and '.$min.' min'.addS($min).' ago';
//echo '</div>';
//
//$query = 'SELECT * FROM accounts_'.$region.' WHERE username="'.strtolower(str_replace(' ', '', $username)).'"';
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
//$now = new DateTime();
//$then = new DateTime();
//$then->setTimestamp($table['lastupdated']);
//$ago = $now->diff($then);
//$days = $ago->days;
//$hours = $ago->h;
//$min = $ago->i;
//
//echo '<div class="summoner2-lastupdated">';
//echo 'Updated '.$days.' day'.addS($days).', '.$hours.' hour'.addS($hours).' and '.$min.' min'.addS($min).' ago';
//echo '</div>';

include 'updateranks.php';

?>