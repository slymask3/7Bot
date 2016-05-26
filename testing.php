<?php
$page = 'index';
$pagename = 'Testing';
require_once 'header.php';

echo '<div class="about">';

$api = new riotapi('na');

$username = 'chilaquiles';

//$id = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))];
//$r = $api->getMatchHistory($id['id']);
//$game = $api->getMatch($r['matches'][0]['matchId']);
//fucked matches: 2092408242 2101450716 2116476535 1786216420 2084844730 1514926339 1514926339 2127458014
$game = $api->getMatch(2198315900);//2121871884 2127458014 2122883264 2137699338 2137582323 2137582323
//2116672873 2156137733 2116672873 2126712478 2177377590 2098733881 2194353793 2198315900

echo '<table border="1px black solid">';
for($i=0; $i<count($game['participants']); $i++) {
    if($i == 5) {
        echo '<tr><td>-</td></tr>';
    }
    $player = $game['participants'][$i];
    $playeri = $game['participantIdentities'][$i];
    $query = 'SELECT id, pic, name FROM champions WHERE id='.$player['championId'];
    $result = $conn->prepare($query);
    $result->execute();
    $table = $result->fetchAll()[0];
    //var_dump($i, $game['participants'][$i]);
    echo '<tr>';
    echo '<td>'.$playeri['player']['summonerName'].'</td>';
    echo '<td>'.getChampionIMG($table['pic'], $table['name']).'</td><td>'.$table['name'].'</td><td>'.$player['championId'].'</td><td> Lane: '.$player['timeline']['lane'].'</td><td>Role: '.$player['timeline']['role'].'</td><td>Correct Lane: '.getCorrectLane($game, $i).'</td>';
    echo '<td>Minions: '.$player['stats']['minionsKilled'].'</td><td>Neutrals: '.$player['stats']['neutralMinionsKilled'].'</td><td>Team: '.$player['teamId'].'</td>';
    echo '</tr>';
}
echo '</table>';

//$game = $api->getMatch(2122883264);//2121871884 2127458014 2122883264
//
//echo '<table border="1px black solid">';
//for($i=0; $i<count($game['participants']); $i++) {
//    $player = $game['participants'][$i];
//    $playeri = $game['participantIdentities'][$i];
//    $query = 'SELECT id, pic, name FROM champions WHERE id='.$player['championId'];
//    $result = $conn->prepare($query);
//    $result->execute();
//    $table = $result->fetchAll()[0];
//    //var_dump($i, $game['participants'][$i]);
//    echo '<tr>';
//    echo '<td>'.$playeri['player']['summonerName'].'</td>';
//    echo '<td>'.getChampionIMG($table['pic'], $table['name']).'</td><td>'.$table['name'].'</td><td> Lane: '.$player['timeline']['lane'].'</td><td>Role: '.$player['timeline']['role'].'</td><td>Correct Lane: '.getCorrectLane($game, $i).'</td>';
//    echo '<td>Minions: '.$player['stats']['minionsKilled'].'</td><td>Neutrals: '.$player['stats']['neutralMinionsKilled'].'</td><td>Team: '.$player['teamId'].'</td>';
//    echo '</tr>';
//}
//echo '</table>';
//
//$game = $api->getMatch(2127458014);//2121871884 2127458014 2122883264
//
//echo '<table border="1px black solid">';
//for($i=0; $i<count($game['participants']); $i++) {
//    $player = $game['participants'][$i];
//    $playeri = $game['participantIdentities'][$i];
//    $query = 'SELECT id, pic, name FROM champions WHERE id='.$player['championId'];
//    $result = $conn->prepare($query);
//    $result->execute();
//    $table = $result->fetchAll()[0];
//    //var_dump($i, $game['participants'][$i]);
//    echo '<tr>';
//    echo '<td>'.$playeri['player']['summonerName'].'</td>';
//    echo '<td>'.getChampionIMG($table['pic'], $table['name']).'</td><td>'.$table['name'].'</td><td> Lane: '.$player['timeline']['lane'].'</td><td>Role: '.$player['timeline']['role'].'</td><td>Correct Lane: '.getCorrectLane($game, $i).'</td>';
//    echo '<td>Minions: '.$player['stats']['minionsKilled'].'</td><td>Neutrals: '.$player['stats']['neutralMinionsKilled'].'</td><td>Team: '.$player['teamId'].'</td>';
//    echo '</tr>';
//}
//echo '</table>';

//var_dump($game);

//echo getCorrectLane($game, 5);

echo '</div>';

require_once 'footer.php';
?>