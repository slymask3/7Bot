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

//Set the last updated variable.
$lastupdated = (new DateTime())->getTimestamp();

//There is no entry for the player, so insert one.
if($result->rowCount() == 0) {
    $query = 'INSERT INTO accounts_'.$region.' VALUES(:id, :un, :dn, :icon, :lvl, :rev, :tier, :div, :lp, :ln, :wins, :losses, :lu)';
} else { //There is already an entry for this player, so update it.
    $query = 'UPDATE accounts_'.$region.' SET username=:un, displayname=:dn, profileicon=:icon, level=:lvl, revision=:rev, tier=:tier, division=:div, lp=:lp, leaguename=:ln, wins=:wins, losses=:losses, lastupdated=:lu WHERE id=:id';
}
$result = $conn->prepare($query);
$result->bindParam(':id', $id, PDO::PARAM_INT);
$result->bindParam(':un', $username, PDO::PARAM_STR, 16);
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
$result->execute();
//var_dump($result->errorInfo());

?>