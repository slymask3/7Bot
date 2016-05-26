<?php

$query = "SELECT
          summonerid,
          CAST(champ as CHAR) as 'champ',
          CAST(lane as CHAR) as 'lane',
          CAST(top as CHAR) as 'top',
          CAST(jungle as CHAR) as 'jungle',
          CAST(mid as CHAR) as 'mid',
          CAST(adc as CHAR) as 'adc',
          CAST(support as CHAR) as 'support',
          CAST(team as CHAR) as 'team',
          CAST(premade as CHAR) as 'premade'
          FROM sideinfo_".$region."_".$seasonCode."
          WHERE summonerid=".$accountid;
$result = $conn->prepare($query);
$result->execute();
$table = $result->fetchAll();
$champ = json_decode($table[0]['champ'], true);
$lane = json_decode($table[0]['lane'], true);
$top = json_decode($table[0]['top'], true);
$jungle = json_decode($table[0]['jungle'], true);
$mid = json_decode($table[0]['mid'], true);
$adc = json_decode($table[0]['adc'], true);
$support = json_decode($table[0]['support'], true);
$team = json_decode($table[0]['team'], true);
$premade = json_decode($table[0]['premade'], true);

//var_dump($champ);

//$query = "SELECT count(*), pid, cid, c.pic, c.name, ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].championId') as 'cid', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].championId'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].championId'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].championId'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].championId'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].championId'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].championId'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].championId'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].championId'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].championId'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//LEFT JOIN champions c ON cid=c.id
//WHERE pid=".$accountid."
//GROUP BY pid, cid, 4, 5
//ORDER BY 1 DESC LIMIT 10";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();

echo '<div class="sideinfo-box">';
echo '<form action="onlyupdatesideinfo.php" method="get">';
echo '<input type="hidden" name="page" value="'.$page.'" />';
echo '<input type="hidden" name="r" value="'.$region.'" />';
echo '<input type="hidden" name="name" value="'.$account['username'].'" />';
echo '<input type="hidden" name="q" value="'.$queue.'" />';
echo '<input type="hidden" name="s" value="'.$season.'" />';
echo '<input type="hidden" name="accountid" value="'.$accountid.'" />';
echo '<button type="submit" class="btn btn-warning"><i class="fa fa-arrow-circle-o-up"></i> Update Stats</button>';
echo '</form>';
echo '<span class="warning">WARNING: Could take up to 2 minutes to complete.</span>';
echo '</div>';

echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Champions: ('.count($champ).'/'.$totalchampions.')';
echo '</div>';

$k = 0;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($champ).'</div>';
foreach($champ as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getChampionIMG($row['pic'], $row['name'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';
//
//$query = "SELECT count(*), pid, getCorrectLane(lane, role) as 'correctlane', ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].timeline.lane') as 'lane', json_extract(data, '$.participants[0].timeline.role') as 'role', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].timeline.lane'), json_extract(data, '$.participants[1].timeline.role'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].timeline.lane'), json_extract(data, '$.participants[2].timeline.role'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].timeline.lane'), json_extract(data, '$.participants[3].timeline.role'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].timeline.lane'), json_extract(data, '$.participants[4].timeline.role'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].timeline.lane'), json_extract(data, '$.participants[5].timeline.role'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].timeline.lane'), json_extract(data, '$.participants[6].timeline.role'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].timeline.lane'), json_extract(data, '$.participants[7].timeline.role'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].timeline.lane'), json_extract(data, '$.participants[8].timeline.role'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].timeline.lane'), json_extract(data, '$.participants[9].timeline.role'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//WHERE pid=".$accountid."
//GROUP BY pid, correctlane
//ORDER BY 1 DESC LIMIT 5";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Lanes:';
echo '</div>';

$k = 1;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($lane).'</div>';
foreach($lane as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getLaneIMG($row['correctlane'], 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';
//
//$query = "SELECT count(*), pid, cid, c.pic, c.name, getCorrectLane(lane, role) as 'correctlane', ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].championId') as 'cid', json_extract(data, '$.participants[0].timeline.lane') as 'lane', json_extract(data, '$.participants[0].timeline.role') as 'role', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].championId'), json_extract(data, '$.participants[1].timeline.lane'), json_extract(data, '$.participants[1].timeline.role'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].championId'), json_extract(data, '$.participants[2].timeline.lane'), json_extract(data, '$.participants[2].timeline.role'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].championId'), json_extract(data, '$.participants[3].timeline.lane'), json_extract(data, '$.participants[3].timeline.role'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].championId'), json_extract(data, '$.participants[4].timeline.lane'), json_extract(data, '$.participants[4].timeline.role'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].championId'), json_extract(data, '$.participants[5].timeline.lane'), json_extract(data, '$.participants[5].timeline.role'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].championId'), json_extract(data, '$.participants[6].timeline.lane'), json_extract(data, '$.participants[6].timeline.role'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].championId'), json_extract(data, '$.participants[7].timeline.lane'), json_extract(data, '$.participants[7].timeline.role'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].championId'), json_extract(data, '$.participants[8].timeline.lane'), json_extract(data, '$.participants[8].timeline.role'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].championId'), json_extract(data, '$.participants[9].timeline.lane'), json_extract(data, '$.participants[9].timeline.role'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//LEFT JOIN champions c ON cid=c.id
//WHERE pid=".$accountid."
//GROUP BY pid, cid, 4, 5, 6
//HAVING correctlane='Top'
//ORDER BY 1 DESC";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Top-Laner:';
echo '</div>';

$k = 2;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($top).'</div>';
foreach($top as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getChampionIMG($row['pic'], $row['name'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';
//
//$query = "SELECT count(*), pid, cid, c.pic, c.name, getCorrectLane(lane, role) as 'correctlane', ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].championId') as 'cid', json_extract(data, '$.participants[0].timeline.lane') as 'lane', json_extract(data, '$.participants[0].timeline.role') as 'role', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].championId'), json_extract(data, '$.participants[1].timeline.lane'), json_extract(data, '$.participants[1].timeline.role'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].championId'), json_extract(data, '$.participants[2].timeline.lane'), json_extract(data, '$.participants[2].timeline.role'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].championId'), json_extract(data, '$.participants[3].timeline.lane'), json_extract(data, '$.participants[3].timeline.role'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].championId'), json_extract(data, '$.participants[4].timeline.lane'), json_extract(data, '$.participants[4].timeline.role'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].championId'), json_extract(data, '$.participants[5].timeline.lane'), json_extract(data, '$.participants[5].timeline.role'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].championId'), json_extract(data, '$.participants[6].timeline.lane'), json_extract(data, '$.participants[6].timeline.role'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].championId'), json_extract(data, '$.participants[7].timeline.lane'), json_extract(data, '$.participants[7].timeline.role'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].championId'), json_extract(data, '$.participants[8].timeline.lane'), json_extract(data, '$.participants[8].timeline.role'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].championId'), json_extract(data, '$.participants[9].timeline.lane'), json_extract(data, '$.participants[9].timeline.role'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//LEFT JOIN champions c ON cid=c.id
//WHERE pid=".$accountid."
//GROUP BY pid, cid, 4, 5, 6
//HAVING correctlane='Jungle'
//ORDER BY 1 DESC LIMIT 5";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Jungler:';
echo '</div>';

$k = 3;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($jungle).'</div>';
foreach($jungle as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getChampionIMG($row['pic'], $row['name'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';
//
//$query = "SELECT count(*), pid, cid, c.pic, c.name, getCorrectLane(lane, role) as 'correctlane', ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].championId') as 'cid', json_extract(data, '$.participants[0].timeline.lane') as 'lane', json_extract(data, '$.participants[0].timeline.role') as 'role', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].championId'), json_extract(data, '$.participants[1].timeline.lane'), json_extract(data, '$.participants[1].timeline.role'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].championId'), json_extract(data, '$.participants[2].timeline.lane'), json_extract(data, '$.participants[2].timeline.role'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].championId'), json_extract(data, '$.participants[3].timeline.lane'), json_extract(data, '$.participants[3].timeline.role'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].championId'), json_extract(data, '$.participants[4].timeline.lane'), json_extract(data, '$.participants[4].timeline.role'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].championId'), json_extract(data, '$.participants[5].timeline.lane'), json_extract(data, '$.participants[5].timeline.role'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].championId'), json_extract(data, '$.participants[6].timeline.lane'), json_extract(data, '$.participants[6].timeline.role'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].championId'), json_extract(data, '$.participants[7].timeline.lane'), json_extract(data, '$.participants[7].timeline.role'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].championId'), json_extract(data, '$.participants[8].timeline.lane'), json_extract(data, '$.participants[8].timeline.role'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].championId'), json_extract(data, '$.participants[9].timeline.lane'), json_extract(data, '$.participants[9].timeline.role'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//LEFT JOIN champions c ON cid=c.id
//WHERE pid=".$accountid."
//GROUP BY pid, cid, 4, 5, 6
//HAVING correctlane='Mid'
//ORDER BY 1 DESC LIMIT 5";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Mid-Laner:';
echo '</div>';

$k = 4;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($mid).'</div>';
foreach($mid as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getChampionIMG($row['pic'], $row['name'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';
//
//$query = "SELECT count(*), pid, cid, c.pic, c.name, getCorrectLane(lane, role) as 'correctlane', ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].championId') as 'cid', json_extract(data, '$.participants[0].timeline.lane') as 'lane', json_extract(data, '$.participants[0].timeline.role') as 'role', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].championId'), json_extract(data, '$.participants[1].timeline.lane'), json_extract(data, '$.participants[1].timeline.role'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].championId'), json_extract(data, '$.participants[2].timeline.lane'), json_extract(data, '$.participants[2].timeline.role'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].championId'), json_extract(data, '$.participants[3].timeline.lane'), json_extract(data, '$.participants[3].timeline.role'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].championId'), json_extract(data, '$.participants[4].timeline.lane'), json_extract(data, '$.participants[4].timeline.role'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].championId'), json_extract(data, '$.participants[5].timeline.lane'), json_extract(data, '$.participants[5].timeline.role'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].championId'), json_extract(data, '$.participants[6].timeline.lane'), json_extract(data, '$.participants[6].timeline.role'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].championId'), json_extract(data, '$.participants[7].timeline.lane'), json_extract(data, '$.participants[7].timeline.role'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].championId'), json_extract(data, '$.participants[8].timeline.lane'), json_extract(data, '$.participants[8].timeline.role'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].championId'), json_extract(data, '$.participants[9].timeline.lane'), json_extract(data, '$.participants[9].timeline.role'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//LEFT JOIN champions c ON cid=c.id
//WHERE pid=".$accountid."
//GROUP BY pid, cid, 4, 5, 6
//HAVING correctlane='ADC'
//ORDER BY 1 DESC LIMIT 5";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played ADC:';
echo '</div>';

$k = 5;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($adc).'</div>';
foreach($adc as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getChampionIMG($row['pic'], $row['name'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';
//
//$query = "SELECT count(*), pid, cid, c.pic, c.name, getCorrectLane(lane, role) as 'correctlane', ROUND((SUM(outcome)/count(*))*100, 0) as 'winrate', ROUND(AVG(kills), 1) as 'kills', ROUND(AVG(deaths), 1) as 'deaths', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(cs), 1) as 'cs', ROUND(AVG(assists), 1) as 'assists', ROUND(AVG(damage), 1) as 'damage', ROUND(AVG(gold), 1) as 'gold', ROUND(AVG(cs/(length/60)), 2) as 'csm', ROUND(AVG(damage/(length/60)), 2) as 'dmgm', ROUND(AVG(gold/(length/60)), 2) as 'goldm'
//FROM
//((SELECT json_extract(data, '$.participantIdentities[0].player.summonerId') as 'pid', json_extract(data, '$.participants[0].championId') as 'cid', json_extract(data, '$.participants[0].timeline.lane') as 'lane', json_extract(data, '$.participants[0].timeline.role') as 'role', (CASE WHEN json_extract(data, '$.participants[0].stats.winner')=true then 1 else 0 end) as 'outcome', json_extract(data, '$.participants[0].stats.kills') as 'kills', json_extract(data, '$.participants[0].stats.deaths') as 'deaths', json_extract(data, '$.participants[0].stats.assists') as 'assists', (json_extract(data, '$.participants[0].stats.minionsKilled')+json_extract(data, '$.participants[0].stats.neutralMinionsKilled')) as 'cs', json_extract(data, '$.participants[0].stats.totalDamageDealtToChampions') as 'damage', json_extract(data, '$.matchDuration') as 'length', json_extract(data, '$.participants[0].stats.goldEarned') as 'gold' FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[1].player.summonerId'), json_extract(data, '$.participants[1].championId'), json_extract(data, '$.participants[1].timeline.lane'), json_extract(data, '$.participants[1].timeline.role'), (CASE WHEN json_extract(data, '$.participants[1].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[1].stats.kills'), json_extract(data, '$.participants[1].stats.deaths'), json_extract(data, '$.participants[1].stats.assists'), (json_extract(data, '$.participants[1].stats.minionsKilled')+json_extract(data, '$.participants[1].stats.neutralMinionsKilled')), json_extract(data, '$.participants[1].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[1].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[2].player.summonerId'), json_extract(data, '$.participants[2].championId'), json_extract(data, '$.participants[2].timeline.lane'), json_extract(data, '$.participants[2].timeline.role'), (CASE WHEN json_extract(data, '$.participants[2].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[2].stats.kills'), json_extract(data, '$.participants[2].stats.deaths'), json_extract(data, '$.participants[2].stats.assists'), (json_extract(data, '$.participants[2].stats.minionsKilled')+json_extract(data, '$.participants[2].stats.neutralMinionsKilled')), json_extract(data, '$.participants[2].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[2].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[3].player.summonerId'), json_extract(data, '$.participants[3].championId'), json_extract(data, '$.participants[3].timeline.lane'), json_extract(data, '$.participants[3].timeline.role'), (CASE WHEN json_extract(data, '$.participants[3].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[3].stats.kills'), json_extract(data, '$.participants[3].stats.deaths'), json_extract(data, '$.participants[3].stats.assists'), (json_extract(data, '$.participants[3].stats.minionsKilled')+json_extract(data, '$.participants[3].stats.neutralMinionsKilled')), json_extract(data, '$.participants[3].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[3].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[4].player.summonerId'), json_extract(data, '$.participants[4].championId'), json_extract(data, '$.participants[4].timeline.lane'), json_extract(data, '$.participants[4].timeline.role'), (CASE WHEN json_extract(data, '$.participants[4].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[4].stats.kills'), json_extract(data, '$.participants[4].stats.deaths'), json_extract(data, '$.participants[4].stats.assists'), (json_extract(data, '$.participants[4].stats.minionsKilled')+json_extract(data, '$.participants[4].stats.neutralMinionsKilled')), json_extract(data, '$.participants[4].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[4].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[5].player.summonerId'), json_extract(data, '$.participants[5].championId'), json_extract(data, '$.participants[5].timeline.lane'), json_extract(data, '$.participants[5].timeline.role'), (CASE WHEN json_extract(data, '$.participants[5].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[5].stats.kills'), json_extract(data, '$.participants[5].stats.deaths'), json_extract(data, '$.participants[5].stats.assists'), (json_extract(data, '$.participants[5].stats.minionsKilled')+json_extract(data, '$.participants[5].stats.neutralMinionsKilled')), json_extract(data, '$.participants[5].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[5].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[6].player.summonerId'), json_extract(data, '$.participants[6].championId'), json_extract(data, '$.participants[6].timeline.lane'), json_extract(data, '$.participants[6].timeline.role'), (CASE WHEN json_extract(data, '$.participants[6].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[6].stats.kills'), json_extract(data, '$.participants[6].stats.deaths'), json_extract(data, '$.participants[6].stats.assists'), (json_extract(data, '$.participants[6].stats.minionsKilled')+json_extract(data, '$.participants[6].stats.neutralMinionsKilled')), json_extract(data, '$.participants[6].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[6].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[7].player.summonerId'), json_extract(data, '$.participants[7].championId'), json_extract(data, '$.participants[7].timeline.lane'), json_extract(data, '$.participants[7].timeline.role'), (CASE WHEN json_extract(data, '$.participants[7].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[7].stats.kills'), json_extract(data, '$.participants[7].stats.deaths'), json_extract(data, '$.participants[7].stats.assists'), (json_extract(data, '$.participants[7].stats.minionsKilled')+json_extract(data, '$.participants[7].stats.neutralMinionsKilled')), json_extract(data, '$.participants[7].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[7].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[8].player.summonerId'), json_extract(data, '$.participants[8].championId'), json_extract(data, '$.participants[8].timeline.lane'), json_extract(data, '$.participants[8].timeline.role'), (CASE WHEN json_extract(data, '$.participants[8].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[8].stats.kills'), json_extract(data, '$.participants[8].stats.deaths'), json_extract(data, '$.participants[8].stats.assists'), (json_extract(data, '$.participants[8].stats.minionsKilled')+json_extract(data, '$.participants[8].stats.neutralMinionsKilled')), json_extract(data, '$.participants[8].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[8].stats.goldEarned') FROM matches_".$region."_season2016)
//UNION ALL (SELECT json_extract(data, '$.participantIdentities[9].player.summonerId'), json_extract(data, '$.participants[9].championId'), json_extract(data, '$.participants[9].timeline.lane'), json_extract(data, '$.participants[9].timeline.role'), (CASE WHEN json_extract(data, '$.participants[9].stats.winner')=true then 1 else 0 end), json_extract(data, '$.participants[9].stats.kills'), json_extract(data, '$.participants[9].stats.deaths'), json_extract(data, '$.participants[9].stats.assists'), (json_extract(data, '$.participants[9].stats.minionsKilled')+json_extract(data, '$.participants[9].stats.neutralMinionsKilled')), json_extract(data, '$.participants[9].stats.totalDamageDealtToChampions'), json_extract(data, '$.matchDuration'), json_extract(data, '$.participants[9].stats.goldEarned') FROM matches_".$region."_season2016)) t
//LEFT JOIN champions c ON cid=c.id
//WHERE pid=".$accountid."
//GROUP BY pid, cid, 4, 5, 6
//HAVING correctlane='Support'
//ORDER BY 1 DESC LIMIT 5";
//$result = $conn->prepare($query);
//$result->execute();
//$table = $result->fetchAll();
//
echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Support:';
echo '</div>';

$k = 6;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($support).'</div>';
foreach($support as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getChampionIMG($row['pic'], $row['name'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';

echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Most Played Team:';
echo '</div>';

$k = 7;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($team).'</div>';
foreach($team as $row) {
    echo '<div class="sideinfo-row">';
    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic">'.getTeamIMG($row['team'], 40, 40).'</div>';
    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span> / ';
    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span> / ';
    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
    echo '</div>';
    echo '<div class="sideinfo-row-stats">';
    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';

echo '<div class="sideinfo-box">';
echo '<div class="sideinfo-title">';
echo 'Premades:';
echo '</div>';

$k = 8;
$i = 0;
echo '<div style="display: none" id="si-'.$k.'-total">'.count($premade).'</div>';
foreach($premade as $row) {
    echo '<div class="sideinfo-rowpremade">';
//    echo '<div class="sideinfo-row-played">'.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
    echo '<div class="sideinfo-row-pic"><a href="?r='.$region.'&name='.strtolower(str_replace(' ', '', $row['duo'])).'">'.$row['duo'].'</a> '.$row[0].' Played - '.$row['winrate'].'% Winrate</div>';
//    echo '<div class="sideinfo-row-kda">'.'<span id="si-'.$k.'-kills-'.$i.'">'.$row['kills'].'</span>/';
//    echo '<span id="si-'.$k.'-deaths-'.$i.'">'.$row['deaths'].'</span>/';
//    echo '<span id="si-'.$k.'-assists-'.$i.'">'.$row['assists']. '</span>';
//    echo '<div>'.round(($row['kills']+$row['assists'])/$row['deaths'],1).':1 KDA'.'</div>';
//    echo '</div>';
//    echo '<div class="sideinfo-row-stats">';
//    echo '<div class="sideinfo-row-damage">'.'Damage: <span id="si-'.$k.'-dmg-'.$i.'">'.$row['damage'].'</span> (<span id="si-'.$k.'-dmgm-'.$i.'">'.$row['dmgm'].'</span>/min)'.'</div>';
//    echo '<div class="sideinfo-row-gold">'.'Gold: <span id="si-'.$k.'-gold-'.$i.'">'.$row['gold'].'</span> (<span id="si-'.$k.'-goldm-'.$i.'">'.$row['goldm'].'</span>/min)'.'</div>';
//    echo '<div class="sideinfo-row-cs">'.'CS: <span id="si-'.$k.'-cs-'.$i.'">'.$row['cs'].'</span> (<span id="si-'.$k.'-csm-'.$i.'">'.$row['csm'].'</span>/min)'.'</div>';
//    echo '</div>';
    echo '</div>';
    $i++;
}
echo '</div>';

?>