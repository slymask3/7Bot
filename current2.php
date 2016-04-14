<style>
    .match {
        margin-bottom: 20px;
    }
    .match-info {
        background-color: grey;
        border: 1px black solid;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 5px;
    }
    .match-teams {
        display: flex;
    }
    .match-teams-blue {
        background-color: lightblue;
        border: 1px black solid;
        width: 50%;
        padding: 5px;
        text-align: center;
    }
    .match-teams-red {
        background-color: lightcoral;
        border: 1px black solid;
        width: 50%;
        padding: 5px;
        text-align: center;
    }
    .match-players {
        display: flex;
    }
    .match-blue {
        width: 47.5%;
        /*background-color: lightblue;*/
        /*border-top-left-radius: 15px;*/
        /*border-bottom-left-radius: 15px;*/
    }
    .match-red {
        width: 47.5%;
        /*border-top-right-radius: 15px;*/
        /*border-bottom-right-radius: 15px;*/
    }
    .match-middle {
        width: 5%;
        background-color: grey;
    }
    .match-lane{
        border: 1px black solid;
        height: 52px;
    }
    .match-lane-box {
        margin: 5px;
        text-align: center;
        /*margin: auto;*/
    }
    .match-player {
        border: 1px black solid;
        height: 52px;
        padding: 5px;
        position: relative;
    }
    .match-blue .match-player {
        background-color: lightblue;
    }
    .match-red .match-player {
        background-color: lightcoral;
    }

    /*.match-blue .match-player:first-child {*/
        /*border-top-left-radius: 15px;*/
    /*}*/
    /*.match-blue .match-player:last-child {*/
        /*border-bottom-left-radius: 15px;*/
    /*}*/
    /*.match-red .match-player:first-child {*/
        /*border-top-right-radius: 15px;*/
    /*}*/
    /*.match-red .match-player:last-child {*/
        /*border-bottom-right-radius: 15px;*/
    /*}*/
    .match-player-champion {
        position: absolute;
        top: 5px;
        left: 5px;
    }
    .match-player-spells {
        position: absolute;
        top: 5px;
        left: 45px;
    }
    .match-player-keystone {
        position: absolute;
        top: 15px;
        left: 65px;
    }
    .match-player-kda {
        position: absolute;
        left: 90px;
        text-align: center;
    }
    .match-player-stats {
        position: absolute;
        left: 200px;
        text-align: left;
        font-size: x-small;
    }
    .match-blue .match-player-active {
        font-weight: bold;
        background-color: #63c1e6;
    }
    .match-red .match-player-active {
        font-weight: bold;
        background-color: #f0382e;
    }
    .match-bans {
        display: flex;
    }
    .match-bans-blue {
        width: 50%;
        text-align: center;
        border: 1px black solid;
        border-bottom-left-radius: 15px;
        padding: 5px;
        background-color: lightblue;
    }
    .match-bans-red {
        width: 50%;
        text-align: center;
        border: 1px black solid;
        border-bottom-right-radius: 15px;
        padding: 5px;
        background-color: lightcoral;
    }
</style>
<?php
$page = 'match';
$pagename = 'Match';
require_once 'header.php';

$length = rand(1111, 4444);

$active = rand(0, 9);
$winner = rand(0, 1);

$player = array();
$tk[0] = 0;
$td[0] = 0;
$tk[1] = 0;
$td[1] = 0;
for($i=0; $i<10; $i++) {
    $player[$i]['championid'] = $i+20;
    $player[$i]['kills'] = rand(0, 20);
    $player[$i]['deaths'] = rand(0, 20);
    $player[$i]['assists'] = rand(0, 20);
//    $player[$i]['keystone'] = rand(6161, 6162);
    $player[$i]['damage'] = rand(0, 99999);
    $player[$i]['gold'] = rand(300, 66666);
    $player[$i]['cs'] = rand(0, 400);
    $player[$i]['dmg/min'] = round($player[$i]['damage']/($length/60), 2);
    $player[$i]['gold/min'] = round($player[$i]['gold']/($length/60), 2);
    $player[$i]['cs/min'] = round($player[$i]['cs']/($length/60), 2);
    $tk[($i<5?0:1)] += $player[$i]['kills'];
    $td[($i<5?0:1)] += $player[$i]['deaths'];
}

//for($i=0; $i<5; $i++) {
//    $tk[0] +=
//    $td[0] +=
//}
//
//for($i=5; $i<10; $i++) {
//    $tk[0] +=
//    $td[0] +=
//}

$bans[0][0] = 'MasterYi';
$bans[0][1] = 'Zed';
$bans[0][2] = 'Darius';
$bans[1][0] = 'Shyvana';
$bans[1][1] = 'Soraka';
$bans[1][2] = 'Ekko';

$player[0]['champion'] = 'Aatrox';
$player[1]['champion'] = 'Sejuani';
$player[2]['champion'] = 'Annie';
$player[3]['champion'] = 'Lucian';
$player[4]['champion'] = 'Leona';
$player[5]['champion'] = 'Trundle';
$player[6]['champion'] = 'Vi';
$player[7]['champion'] = 'Swain';
$player[8]['champion'] = 'Varus';
$player[9]['champion'] = 'Sona';

$player[0]['spell1'] = 'SummonerDot';
$player[1]['spell1'] = 'SummonerSmite';
$player[2]['spell1'] = 'SummonerDot';
$player[3]['spell1'] = 'SummonerHeal';
$player[4]['spell1'] = 'SummonerExhaust';
$player[5]['spell1'] = 'SummonerTeleport';
$player[6]['spell1'] = 'SummonerSmite';
$player[7]['spell1'] = 'SummonerDot';
$player[8]['spell1'] = 'SummonerHeal';
$player[9]['spell1'] = 'SummonerDot';

$player[0]['spell2'] = 'SummonerFlash';
$player[1]['spell2'] = 'SummonerFlash';
$player[2]['spell2'] = 'SummonerFlash';
$player[3]['spell2'] = 'SummonerFlash';
$player[4]['spell2'] = 'SummonerFlash';
$player[5]['spell2'] = 'SummonerFlash';
$player[6]['spell2'] = 'SummonerFlash';
$player[7]['spell2'] = 'SummonerFlash';
$player[8]['spell2'] = 'SummonerFlash';
$player[9]['spell2'] = 'SummonerFlash';

$player[0]['keystone'] = 6161;
$player[1]['keystone'] = 6262;
$player[2]['keystone'] = 6362;
$player[3]['keystone'] = 6162;
$player[4]['keystone'] = 6263;

$player[5]['keystone'] = 6261;
$player[6]['keystone'] = 6262;
$player[7]['keystone'] = 6164;
$player[8]['keystone'] = 6162;
$player[9]['keystone'] = 6363;

$lane[0] = 'Top';
$lane[1] = 'Jungle';
$lane[2] = 'Mid';
$lane[3] = 'ADC';
$lane[4] = 'Support';

echo '<div class="match">';
echo '<div class="match-info">';
echo 'Game Length: '.getTime($length);
echo '</div>';
echo '<div class="match-teams">';
echo '<div class="match-teams-blue">';
echo ($winner==0?'Victory':'Defeat').' - ';
echo $tk[0].' / '.$td[0];
echo '</div>';
echo '<div class="match-teams-red">';
echo ($winner==1?'Victory':'Defeat').' - ';
echo $tk[1].' / '.$td[1];
echo '</div>';
echo '</div>';
echo '<div class="match-players">';
echo '<div class="match-blue">';
for($i=0; $i<5; $i++) {
    echo ($i==$active?'<div class="match-player match-player-active">':'<div class="match-player">');
    echo '<div class="match-player-champion">'.getChampionIMG($player[$i]['champion'], $player[$i]['champion'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="match-player-spells">'.getSpellIMG($player[$i]['spell1']).'<br>';
    echo getSpellIMG($player[$i]['spell2']).'</div>';
    echo '<div class="match-player-keystone">'.getMasteryIMG($player[$i]['keystone']).'</div>';
    echo '<div class="match-player-kda">';
    echo $player[$i]['kills'].' / ';
    echo $player[$i]['deaths'].' / ';
    echo $player[$i]['assists'].'<br><span style="font-size: smaller">'.($player[$i]['deaths']==0?($player[$i]['kills']+$player[$i]['deaths']):round(($player[$i]['kills']+$player[$i]['assists'])/$player[$i]['deaths'], 2)).':1 KDA</span>';
    echo '</div>';
    echo '<div class="match-player-stats">';
    echo 'Damage: '.$player[$i]['damage'].' ('.$player[$i]['dmg/min'].'/min)<br>';
    echo 'Gold: '.$player[$i]['gold'].' ('.$player[$i]['gold/min'].'/min)<br>';
    echo 'CS: '.$player[$i]['cs'].' ('.$player[$i]['cs/min'].'/min)';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '<div class="match-middle">';
for($i=0; $i<5; $i++) {
    echo '<div class="match-lane">';
    echo '<div class="match-lane-box">';
    echo getLaneIMG($lane[$i], 40, 40);
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '<div class="match-red">';
for($i=5; $i<10; $i++) {
    echo ($i==$active?'<div class="match-player match-player-active">':'<div class="match-player">');
    echo '<div class="match-player-champion">'.getChampionIMG($player[$i]['champion'], $player[$i]['champion'], $ddver_latest, 40, 40).'</div>';
    echo '<div class="match-player-spells">'.getSpellIMG($player[$i]['spell1']).'<br>';
    echo getSpellIMG($player[$i]['spell2']).'</div>';
    echo '<div class="match-player-keystone">'.getMasteryIMG($player[$i]['keystone']).'</div>';
    echo '<div class="match-player-kda">';
    echo $player[$i]['kills'].' / ';
    echo $player[$i]['deaths'].' / ';
    echo $player[$i]['assists'].'<br><span style="font-size: smaller">'.($player[$i]['deaths']==0?($player[$i]['kills']+$player[$i]['deaths']):round(($player[$i]['kills']+$player[$i]['assists'])/$player[$i]['deaths'], 2)).':1 KDA</span>';
    echo '</div>';
    echo '<div class="match-player-stats">';
    echo 'Damage: '.$player[$i]['damage'].' ('.$player[$i]['dmg/min'].'/min)<br>';
    echo 'Gold: '.$player[$i]['gold'].' ('.$player[$i]['gold/min'].'/min)<br>';
    echo 'CS: '.$player[$i]['cs'].' ('.$player[$i]['cs/min'].'/min)';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
echo '<div class="match-bans">';
echo '<div class="match-bans-blue">';
echo 'Bans: ';
echo getChampionIMG($bans[0][0]).' ';
echo getChampionIMG($bans[0][1]).' ';
echo getChampionIMG($bans[0][2]);
echo '</div>';
echo '<div class="match-bans-red">';
echo 'Bans: ';
echo getChampionIMG($bans[1][0]).' ';
echo getChampionIMG($bans[1][1]).' ';
echo getChampionIMG($bans[1][2]);
echo '</div>';
echo '</div>';
echo '</div>';

?>



<?php require_once 'footer.php'; ?>