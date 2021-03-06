<?php
if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {
    echo '<div id="users">';

    echo '<div class="gamestable-search-order">';

    echo '
          <label for="search-lane">Lane:</label>
          <input class="search-games" id="search-lane" placeholder="" />
          <label for="search-champion">Champion:</label>
          <input class="search-games" id="search-champion" placeholder="" />
          <label for="search-enemy">Opponent:</label>
          <input class="search-games" id="search-enemy" placeholder="" />
          <div style="float: right">
          <label for="pages"># of Games Per Page:</label>
          <input class="search-games" id="pages" type="number" placeholder="Games Per Page" value="50" min="1" max="9999" />
          </div>
          <br>
          <label for="ord">Order:</label>
          <button class="sort" data-sort="sort-champion" id="ord">Champion</button>
          <button class="sort" data-sort="sort-enemy">Opponent</button>
          <button class="sort" data-sort="sort-kills">Kills</button>
          <button class="sort" data-sort="sort-deaths">Deaths</button>
          <button class="sort" data-sort="sort-assits">Assists</button>
          <button class="sort" data-sort="sort-damage">Damage</button>
          <button class="sort" data-sort="sort-damagem">Damage/min</button>
          <button class="sort" data-sort="sort-gold">Gold</button>
          <button class="sort" data-sort="sort-goldm">Gold/min</button>
          <button class="sort" data-sort="sort-cs">CS</button>
          <button class="sort" data-sort="sort-csm">CS/min</button>
          <button class="sort" data-sort="sort-date">Date</button>
          <button class="sort" data-sort="sort-length">Length</button>
          <button class="sort" data-sort="sort-cc">CCS</button>
          <button class="sort" data-sort="sort-7bs">7BS</button>
          <br>';

    echo '<b>Loaded '.$resultlimit->rowCount().' Games in this Queue.</b> ';
    echo '<b>(Took '.$secondstograb.' seconds to load the games)</b>';

    echo '</div>';

    echo '<div class="games">';



    echo '<div class="games-rows">';

    echo '<div class="game game-average" id="matchavg">';
    echo '<div class="game-info">';
    echo '<div class="game-avg" id="p1">';
    echo 'Average for All Games (<span id="total-games"></span>):';
    echo '</div>';
    echo '<div class="game-lane">';
    echo '</div>';
    echo '<div class="game-champion">';
    echo '</div>';
    echo '<div class="game-vs">';
    echo '</div>';
    echo '<div class="game-enemy">';
    echo '</div>';
    echo '<div class="game-spells">';
    echo '</div>';
    echo '<div class="game-keystone">';
    echo '</div>';
    echo '<div class="game-items">';
    echo '</div>';
    echo '<div class="game-trinket">';
    echo '</div>';
    echo '<div class="game-kda">';
    echo '<span id="avg-kills">'.round($ka, 1).'</span> / <span id="avg-deaths">'.round($da, 1).'</span> / <span id="avg-assists">'.round($aa, 1).'</span>';
    echo '<div style="font-size: smaller"><span id="avg-kda">'.round(($ka+$aa)/$da, 2).'</span>:1 KDA</div>';
    echo '</div>';
//    echo '<div class="game-damage">';
//    echo getUiIMG('score').'Damage: <span id="avg-damage">'.round($dmga, 2).'</span> ';
//    echo '(<span id="avg-damagem">'.round($dmgma, 2).'</span>/min)';
//    echo '</div>';
//    echo '<div class="game-gold">';
//    echo getUiIMG('coin').'Gold: <span id="avg-gold">'.round($golda, 2).'</span> ';
//    echo '(<span id="avg-goldm">'.round($goldma, 2).'</span>/min)';
//    echo '</div>';
//    echo '<div class="game-cs">';
//    echo getUiIMG('minion').'CS: <span id="avg-cs">'.round($csa, 2).'</span> ';
//    echo '(<span id="avg-csm">'.round($csma, 2).'</span>/min)';
//    echo '</div>';
    echo '<div class="game-dgc">';
    echo '<table>';
    echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="Damage">';
    echo '<td>'.getUiIMG('score').'</td>';
    echo '<td><span id="avg-damage">'.number_format($dmga, 2).'</span>';
    echo '</td><td><span class="dmgm-color">(<span id="avg-damagem">'.round($dmgma, 2).'</span>/min)</span></td>';
    echo '</tr>';
    echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="Gold">';
    echo '<td>'.getUiIMG('coin').'</td>';
    echo '<td><span id="avg-gold">'.number_format($golda, 2).'</span>';
    echo '</td><td><span class="goldm-color">(<span id="avg-goldm">'.round($goldma, 2).'</span>/min)</span></td>';
    echo '</tr>';
    echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="CS">';
    echo '<td>'.getUiIMG('minion').'</td>';
    echo '<td><span id="avg-cs">'.number_format($csa, 2).'</span>';
    echo '</td><td><span class="csm-color">(<span id="avg-csm">'.round($csma, 2).'</span>/min)</span></td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';

    echo '<div class="game-length">';
    echo '</div>';
    echo '<div class="game-participation">';
    echo '<div>KP: <span id="avg-kp">'.round($kpa, 2).'</span>%</div>';
    echo '<div>DP: <span id="avg-dp">'.round($dpa, 2).'</span>%</div>';
    echo '</div>';
    echo '<div class="game-date">';
    echo 'Game Length: <span id="avg-length">'.$time.'</span>';
    echo '</div>';
    echo '<div class="game-team">';
    echo '<span class="game-7bs" data-toggle="tooltip" data-placement="top" title="7 Bot Score">7BS: <span id="avg-7bs">0</span></span> ';
    echo '</div>';
//    echo '<div class="game-wards">';
//    echo '<span data-toggle="tooltip" data-placement="top" title="Crowd Control Score" style="display: none">CCS: <span id="avg-cc">0</span></span>';
//    echo '</div>';
    echo '<div class="game-wards">';
    echo '<span style="display:none"><span data-toggle="tooltip" data-placement="top" title="Crowd Control Score">CCS: <span id="avg-cc">'.$cc.'</span></span> - </span>';
    echo '<span style="color: #00ab00" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Placed"><span id="avg-wg">0</span>'.getUiIMG('ward_green').'</span> ';
    echo '<span style="color: #ff4121" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Destroyed"><span id="avg-wd">0</span>'.getUiIMG('ward_destroy').'</span> ';
    echo '<span style="color: hotpink" data-toggle="tooltip" data-placement="top" title="Pink Wards Bought"><span id="avg-wp">0</span>'.getUiIMG('ward_pink').'</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="game game-average" id="matchavg-f" style="display: none">';
    echo '<div class="game-info">';
    echo '<div class="game-avg">';
    echo 'Average for Filtered Games (<span id="total-games-f"></span>):';
    echo '</div>';
    echo '<div class="game-kda">';
    echo '<span id="avg-kills-f">'.round($ka, 1).'</span> / <span id="avg-deaths-f">'.round($da, 1).'</span> / <span id="avg-assists-f">'.round($aa, 1).'</span>';
    echo '<div style="font-size: smaller"><span id="avg-kda-f">'.round(($ka+$aa)/$da, 2).'</span>:1 KDA</div>';
    echo '</div>';
//    echo '<div class="game-damage">';
//    echo getUiIMG('score').'Damage: <span id="avg-damage-f">'.round($dmga, 2).'</span> ';
//    echo '(<span id="avg-damagem-f">'.round($dmgma, 2).'</span>/min)';
//    echo '</div>';
//    echo '<div class="game-gold">';
//    echo getUiIMG('coin').'Gold: <span id="avg-gold-f">'.round($golda, 2).'</span> ';
//    echo '(<span id="avg-goldm-f">'.round($goldma, 2).'</span>/min)';
//    echo '</div>';
//    echo '<div class="game-cs">';
//    echo getUiIMG('minion').'CS: <span id="avg-cs-f">'.round($csa, 2).'</span> ';
//    echo '(<span id="avg-csm-f">'.round($csma, 2).'</span>/min)';
//    echo '</div>';
    echo '<div class="game-dgc">';
    echo '<table>';
    echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="Damage">';
    echo '<td>'.getUiIMG('score').'</td>';
    echo '<td><span id="avg-damage-f">'.number_format($dmga, 2).'</span>';
    echo '</td><td><span class="dmgm-color">(<span id="avg-damagem-f">'.round($dmgma, 2).'</span>/min)</span></td>';
    echo '</tr>';
    echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="Gold">';
    echo '<td>'.getUiIMG('coin').'</td>';
    echo '<td><span id="avg-gold-f">'.number_format($golda, 2).'</span>';
    echo '</td><td><span class="goldm-color">(<span id="avg-goldm-f">'.round($goldma, 2).'</span>/min)</span></td>';
    echo '</tr>';
    echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="CS">';
    echo '<td>'.getUiIMG('minion').'</td>';
    echo '<td><span id="avg-cs-f">'.number_format($csa, 2).'</span>';
    echo '</td><td><span class="csm-color">(<span id="avg-csm-f">'.round($csma, 2).'</span>/min)</span></td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';

    echo '<div class="game-participation">';
    echo '<div>KP: <span id="avg-kp-f">'.round($kpa, 2).'</span>%</div>';
    echo '<div>DP: <span id="avg-dp-f">'.round($dpa, 2).'</span>%</div>';
    echo '</div>';
    echo '<div class="game-date">';
    echo 'Game Length: <span id="avg-length-f">'.$time.'</span>';
    echo '</div>';
    echo '<div class="game-team">';
    echo '<span class="game-7bs" data-toggle="tooltip" data-placement="top" title="7 Bot Score">7BS: <span id="avg-7bs-f">0</span></span> ';
    echo '</div>';
    echo '<div class="game-wards">';
    echo '<span style="display:none"><span data-toggle="tooltip" data-placement="top" title="Crowd Control Score">CCS: <span id="avg-cc-f">'.$cc.'</span></span> - </span>';
    echo '<span style="color: #00ab00" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Placed"><span id="avg-wg-f">0</span>'.getUiIMG('ward_green').'</span> ';
    echo '<span style="color: #ff4121" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Destroyed"><span id="avg-wd-f">0</span>'.getUiIMG('ward_destroy').'</span> ';
    echo '<span style="color: hotpink" data-toggle="tooltip" data-placement="top" title="Pink Wards Bought"><span id="avg-wp-f">0</span>'.getUiIMG('ward_pink').'</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<ul class="list" style="list-style: none; padding: 0; margin: 0;">';

    $number = count($tablelimit)+1;
    $gamenumberid = 0;
    foreach ($tablelimit as $row) {
        echo '<li>';

        $match = array();
        try {
            $match = json_decode(utf8_decode($row['match']), true);
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        $row['pid'] -= 1;
        $row['Date'] = $match['matchCreation'];
        $row['Length'] = $match['matchDuration'];
        $row['displayname'] = $match['participantIdentities'][$row['pid']]['summonrName'];
        $row['lane'] = $match['participants'][$row['pid']]['timeline']['lane'];
        $row['role'] = $match['participants'][$row['pid']]['timeline']['role'];
        $row['championid'] = $match['participants'][$row['pid']]['championId'];
        $row['K'] = $match['participants'][$row['pid']]['stats']['kills'];
        $row['D'] = $match['participants'][$row['pid']]['stats']['deaths'];
        $row['A'] = $match['participants'][$row['pid']]['stats']['assists'];
        $row['Damage'] = $match['participants'][$row['pid']]['stats']['totalDamageDealtToChampions'];
        $row['Gold'] = $match['participants'][$row['pid']]['stats']['goldEarned'];
        $row['CS'] = $match['participants'][$row['pid']]['stats']['minionsKilled']+$match['participants'][$row['pid']]['stats']['neutralMinionsKilled'];
        $row['Dmg/min'] = round($row['Damage']/($row['Length']/60), 2);
        $row['Gold/min'] = round($row['Gold']/($row['Length']/60), 2);
        $row['CS/min'] = round($row['CS']/($row['Length']/60), 2);
        $row['K/min'] = round($row['K']/($row['Length']/60), 2);
        $row['D/min'] = round($row['D']/($row['Length']/60), 2);
        $row['A/min'] = round($row['A']/($row['Length']/60), 2);
        $row['teamid'] = $match['participants'][$row['pid']]['teamId'];
        $row['W/L'] = ($match['participants'][$row['pid']]['stats']['winner'] ? 'Win' : 'Loss');

        $query = 'SELECT id, name, pic FROM champions WHERE id='.$row['championid'];
        $result = $conn->prepare($query);
        $result->execute();
        $fetchall = $result->fetchAll()[0];
        $row['Ch'] = $fetchall['pic'];
        $row['champion'] = $fetchall['name'];

        $query = 'SELECT id, name, pic FROM spells WHERE id='.$match['participants'][$row['pid']]['spell1Id'];
        $result = $conn->prepare($query);
        $result->execute();
        $fetchall = $result->fetchAll()[0];
        $row['Spells'] = $fetchall['pic'];
        $row['S1N'] = $fetchall['name'];

        $query = 'SELECT id, name, pic FROM spells WHERE id='.$match['participants'][$row['pid']]['spell2Id'];
        $result = $conn->prepare($query);
        $result->execute();
        $fetchall = $result->fetchAll()[0];
        $row['S2'] = $fetchall['pic'];
        $row['S2N'] = $fetchall['name'];

        $tk = 0;
        $td = 0;
        for($i=0; $i<10; $i++) {
//            echo $i.' - '.$match['participants'][$i]['teamId'].' - '.$row['teamid'].' | ';
            if($match['participants'][$i]['teamId'] == $row['teamid']) {
                $tk += $match['participants'][$i]['stats']['kills'];
                $td += $match['participants'][$i]['stats']['deaths'];
            }
        }

//        echo $tk;

        $row['KP%'] = round((($row['K']+$row['A'])/$tk)*100, 2);
        $row['DP%'] = round((($row['D'])/$td)*100, 2);

//        var_dump($match, $row['match'], $row['pid']);
//        $masteries = json_decode($row['masteries'], true);
        $masteries = $match['participants'][$row['pid']]['masteries'];
        $lane = getCorrectLane($match, $row['pid']);
        $enemyid = getEnemyChampionID($match, $row['pid']);

        $query = 'SELECT id, name, pic FROM champions WHERE id='.$enemyid;
        $result = $conn->prepare($query);
        $result->execute();
        $enemy = $result->fetchAll()[0];

        /////get keystone//////
        $keystone = 0;
        for($i=0; $i<count($masteries); $i++) {
            $query = "SELECT * FROM keystones WHERE id=".$masteries[$i]['masteryId'];
            $res = $conn->prepare($query);
            $res->execute();
            if($res->rowCount() > 0) {
                $keystone = $masteries[$i]['masteryId'];
            }
//            var_dump($row['masteries'][$i]['masteryId']);
        }
        //////////////////////
//
        //var_dump($keystone);
        //var_dump($masteries);

        $row['Items'] = $match['participants'][$row['pid']]['stats']['item0'];
        $row['I2'] = $match['participants'][$row['pid']]['stats']['item1'];
        $row['I3'] = $match['participants'][$row['pid']]['stats']['item2'];
        $row['I4'] = $match['participants'][$row['pid']]['stats']['item3'];
        $row['I5'] = $match['participants'][$row['pid']]['stats']['item4'];
        $row['I6'] = $match['participants'][$row['pid']]['stats']['item5'];
        $row['T'] = $match['participants'][$row['pid']]['stats']['item6'];
        $row['version'] = $match['matchVersion'];

        $greenwardsbought = $match['participants'][$row['pid']]['stats']['sightWardsBoughtInGame'];
        $pinkwardsbought = $match['participants'][$row['pid']]['stats']['visionWardsBoughtInGame'];
        $wardsplaced = $match['participants'][$row['pid']]['stats']['wardsPlaced'];
        $wardsdestroyed = $match['participants'][$row['pid']]['stats']['wardsKilled'];

        $cc = $match['participants'][$row['pid']]['stats']['totalTimeCrowdControlDealt'];

        $s = getSeasonCode($match['season']);
        $q = getQueueCode($match['queueType']);
        $q2 = getQueueCode2($match['queueType']);
        $ss = getSeasonString($match['season']);
        $qs = getQueueString($match['queueType']);

        $color = "";

        if (array_key_exists('W/L', $row) && $row['W/L'] == "Win") {
//            $color = ' style="background-color: #bfffbe;"';
            $color = 'win';
        } else if (array_key_exists('W/L', $row) && $row['W/L'] == "Loss") {
//            $color = ' style="background-color: #ffaa9f;"';
            $color = 'loss';
        }

        if (array_key_exists('Winrate', $row) && $row['Winrate'] > 50) {
            $color = ' class="win"';
        } else if (array_key_exists('Winrate', $row) && $row['Winrate'] == 50) {
            $color = ' class="warning"';
        } else if (array_key_exists('Winrate', $row) && $row['Winrate'] < 50) {
            $color = ' class="loss"';
        }

        $kclass = getRowColor($row['K'], $kh, $kl, $ka);
        $dclass = getRowColorI($row['D'], $dh, $dl, $da);
        $aclass = getRowColor($row['A'], $ah, $al, $aa);
        $dmgclass = getRowColor($row['Damage'], $dmgh, $dmgl, $dmga);
        $goldclass = getRowColor($row['Gold'], $goldh, $goldl, $golda);
        $csclass = getRowColor($row['CS'], $csh, $csl, $csa);
        $dmgmclass = getRowColor($row['Dmg/min'], $dmgmh, $dmgml, $dmgma);
        $goldmclass = getRowColor($row['Gold/min'], $goldmh, $goldml, $goldma);
        $csmclass = getRowColor($row['CS/min'], $csmh, $csml, $csma);
        $kpclass = getRowColor($row['KP%'], $kph, $kpl, $kpa);
        $dpclass = getRowColorI($row['DP%'], $dph, $dpl, $dpa);

        $now = new DateTime();
        $then = new DateTime();
        $then->setTimestamp($row['Date']/1000);
        $ago = $now->diff($then);
        $days = $ago->days;
        $hours = $ago->h;

        $ddvero = getDDVer($row['version']);
        $ddver = explode('.', $ddvero);

//        var_dump($ddver);

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['Items'];
        $result = $conn->prepare($query);
        $result->execute();
        $i1 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['I2'];
        $result = $conn->prepare($query);
        $result->execute();
        $i2 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['I3'];
        $result = $conn->prepare($query);
        $result->execute();
        $i3 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['I4'];
        $result = $conn->prepare($query);
        $result->execute();
        $i4 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['I5'];
        $result = $conn->prepare($query);
        $result->execute();
        $i5 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['I6'];
        $result = $conn->prepare($query);
        $result->execute();
        $i6 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['T'];
        $result = $conn->prepare($query);
        $result->execute();
        $i7 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM keystones WHERE id='.$keystone;
        $result = $conn->prepare($query);
        $result->execute();
        $keystonename = $result->fetchAll()[0]['name'];


        $premades = array();
        $pis = array();
        $query = "SELECT CAST(premade as CHAR) as 'premade'
          FROM sideinfo_".$region."_".$seasonCode."
          WHERE summonerid=".$userid;
        $result = $conn->prepare($query);
        $result->execute();
        $fulltable = $result->fetchAll();
        $premadestable = json_decode($fulltable[0]['premade'], true);
        foreach($premadestable as $pre) {
            foreach($match['participantIdentities'] as $pi) {
                if($pi['player']['summonerName'] == $pre['duo']) {
                    array_push($premades, $pre['duo']);
                    array_push($pis, $pi['participantId']-1);
                }
            }
        }

//        var_dump($match['participantIdentities'], $premades, $pis, $row['pid']);

        $ddvertouse = $ddvero;
        if($ddvertouse == '6.10.1') {
            $ddvertouse = '6.10.1';
        }


        $number--;

//        echo '<div class="sort-date">'.$row['Ch'].'</div>';
        echo '<div class="sort-length" style="display: none;">'.$row['Length'].'</div>';
        echo '<div class="sort-lane" style="display: none;">'.$lane.'</div>';
        echo '<div class="sort-champion" style="display: none;">'.$row['champion'].'</div>';
        echo '<div class="sort-enemy" style="display: none;">'.$enemy['name'].'</div>';

        echo '<div class="game game-'.strtolower($row['W/L']).'" id="game-number-'.($gamenumberid).'">';
        echo '<div class="game-info" onclick="toggleMatch('.$row['matchid'].')">';
        echo '<div class="game-lane">';
        echo '<a href="match.php?r='.$region.'&match='.$row['matchid'].'&player='.$userid.'" target="_blank">'.getLaneIMG($lane, 40, 40).'</a>';
        echo '</div>';
        echo '<div class="game-champion">';
        echo getChampionIMG($row['Ch'], $row['champion'], $ddvertouse, 60, 60, 2);
        echo '</div>';
        echo '<div class="game-enemy">';
        echo getChampionIMG($enemy['pic'], $enemy['name'], $ddvertouse, 60, 60, 3);
        echo '</div>';
        echo '<div class="game-vs">';
        echo getVSIMG($row['teamid']);
        echo '</div>';
        echo '<div class="game-spells">';
        echo getSpellIMG($row['Spells'], $row['S1N']).getSpellIMG($row['S2'], $row['S2N']);
        echo '</div>';
        echo '<div class="game-keystone">';
        echo getMasteryIMG($keystone, $keystonename, $ddvertouse);
        echo '</div>';
        echo '<div class="game-items">'.getItemsIMG('all', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $ddvertouse);
        echo '</div>';
        echo '<div class="game-trinket">';
        echo getItemIMG($row['T'], $i7);
        echo '</div>';
        echo '<div class="game-kda">';
        echo '<span class="sort-kills" data-toggle="tooltip" data-placement="top" title="'.$row['K/min'].'/min">'.$row['K'].'</span> /
              <span class="sort-deaths" data-toggle="tooltip" data-placement="top" title="'.$row['D/min'].'/min">'.$row['D'].'</span> /
              <span class="sort-assists" data-toggle="tooltip" data-placement="top" title="'.$row['A/min'].'/min">'.$row['A'].'</span>';
        echo '<div style="font-size: smaller"><span class="sort-kda">'.($row['D']==0?$row['K']+$row['A']:round(($row['K']+$row['A'])/$row['D'], 2)).'</span>:1 KDA</div>';
        echo '</div>';
//        echo '<div class="game-damage">';
//        echo getUiIMG('score').'Damage: <span class="sort-damage">'.$row['Damage'].'</span> ';
//        echo '<span class="dmgm-color">(<span class="sort-damagem">'.$row['Dmg/min'].'</span>/min)</span>';
//        echo '</div>';
//        echo '<div class="game-gold">';
//        echo getUiIMG('coin').'Gold: <span class="sort-gold">'.$row['Gold'].'</span> ';
//        echo '<span class="goldm-color">(<span class="sort-goldm">'.$row['Gold/min'].'</span>/min)</span>';
//        echo '</div>';
//        echo '<div class="game-cs">';
//        echo getUiIMG('minion').'CS: <span class="sort-cs">'.$row['CS'].'</span> ';
//        echo '<span class="csm-color">(<span class="sort-csm">'.$row['CS/min'].'</span>/min)</span>';
//        echo '</div>';
        echo '<div class="game-dgc">';
        echo '<table>';
        echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="Damage">';
        echo '<td>'.getUiIMG('score').'</td>';
        echo '<td><span class="sort-damage">'.number_format($row['Damage']).'</span>';
        echo '</td><td><span class="dmgm-color">(<span class="sort-damagem">'.$row['Dmg/min'].'</span>/min)</span></td>';
        echo '</tr>';
        echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="Gold">';
        echo '<td>'.getUiIMG('coin').'</td>';
        echo '<td><span class="sort-gold">'.number_format($row['Gold']).'</span>';
        echo '</td><td><span class="goldm-color">(<span class="sort-goldm">'.$row['Gold/min'].'</span>/min)</span></td>';
        echo '</tr>';
        echo '<tr data-container="body" data-toggle="tooltip" data-placement="right" title="CS">';
        echo '<td>'.getUiIMG('minion').'</td>';
        echo '<td><span class="sort-cs">'.number_format($row['CS']).'</span>';
        echo '</td><td><span class="csm-color">(<span class="sort-csm">'.$row['CS/min'].'</span>/min)</span></td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';

        echo '<div class="game-participation">';
        echo '<div class="kp-color" data-container="body" data-toggle="tooltip" data-placement="right" title="Kill Participation">KP: <span class="sort-kp">'.fixP($row['KP%']).'</span>%</div> ';
        echo '<div class="dp-color" data-container="body" data-toggle="tooltip" data-placement="right" title="Death Participation">DP: <span class="sort-dp">'.fixP($row['DP%']).'</span>%</div>';
        echo '</div>';
        echo '<div class="game-date">';
        echo 'Game Length: <span>'.getTime($row['Length']).'</span> - ';
        echo $days.' day'.addS($days).', '.$hours.' hour'.addS($hours).' ago - ';
        echo '<span class="sort-date">'.date('Y/m/d H:i:s T', $row['Date'] / 1000).' - </span>';
        echo '<span class="game-number" data-toggle="tooltip" data-placement="top" title="'.$number.getOrdinal($number).' Game Played in this Queue">'.$number.'</span>';
        echo '</div>';
        echo '<div class="game-wards">';
        echo '<span style="display:none"><span data-toggle="tooltip" data-placement="top" title="Crowd Control Score">CCS: <span class="sort-cc cc-color">'.$cc.'</span></span> - </span>';
        echo '<span style="color: #00ab00" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Placed"><span class="sort-wg">'.$wardsplaced.'</span>'.getUiIMG('ward_green').'</span> ';
        echo '<span style="color: #ff4121" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Destroyed"><span class="sort-wd">'.$wardsdestroyed.'</span>'.getUiIMG('ward_destroy').'</span> ';
        echo '<span style="color: hotpink" data-toggle="tooltip" data-placement="top" title="Pink Wards Bought"><span class="sort-wp">'.$pinkwardsbought.'</span>'.getUiIMG('ward_pink').'</span>';
        echo ' <span class="game-ddver" data-toggle="tooltip" data-placement="top" title="Season: '.$ss.' Queue: '.$qs.'">('.$q2.')</span>';
        echo ' <span class="game-ddver" data-toggle="tooltip" data-placement="top" title="Game Version '.$row['version'].'">(v'.$ddver[0].'.'.$ddver[1].')</span>';
        echo '</div>';
        echo '<div class="game-team">';
        echo '<span class="game-7bs" data-toggle="tooltip" data-placement="top" title="7 Bot Score (IN EARLY ALPHA STAGE)">7BS: <span class="sort-7bs 7bs-color">'.
                get7BS($lane, $row['K/min'],$row['D/min'],$row['A/min'],$row['Dmg/min'],$row['Gold/min'],$row['CS/min'],$wardsplaced, $wardsdestroyed, $pinkwardsbought, $cc)
            .'</span></span> ';
        echo getTeamIMG($row['teamid']);
        echo '</div>';
        echo '<div class="game-premade">';
        echo (!empty($premades)?'<span style="text-decoration: underline">Premades:</span><br>':'');
        for($i=0; $i<count($premades); $i++) {
            $query = 'SELECT id, name, pic FROM champions WHERE id='.$match['participants'][$pis[$i]]['championId'];
            $result = $conn->prepare($query);
            $result->execute();
            $duo = $result->fetchAll()[0];
            echo getLaneIMG(getCorrectLane($match, $pis[$i]), 14, 14);
            echo getChampionIMG($duo['pic'], $duo['name'], $ddvertouse, 14, 14, 0);
            echo '<a href="?r='.$region.'&name='.strtolower(str_replace(' ', '', $premades[$i])).'">'.$premades[$i].'</a><br>';
        }
        echo '</div>';
        echo '</div>';

        echo '<div class="game-more" id="match-more-'.$row['matchid'].'">';
        echo 'add full match info here later';
        echo getFullMasteryIMG($masteries, $ddvertouse);
        echo '<pre>';
        print_r($row['match']);
        echo '</pre>';
        echo '</div>';
        echo '</div>';

//        echo '<p class="name">'.$row['Ch'].'</p>';
//        echo '<p class="sort-damage">'.$row['Damage'].'</p>';

        echo '</li>';

        $gamenumberid++;
    }
    echo '</ul>';

echo '<div class="gamestable-pages">';
    echo '<ul class="pagination" id="pagination-div" style="margin: 0"></ul>';
    echo '</div>';

    ///

    echo '</div>';

    echo '<div class="games-side-info">';
    include 'sideinfo.php';
    echo '</div>';
    echo '</div>';//div users

//    echo '<div class="pages">';
//    echo '<ul class="pagination" style="margin: 0"></ul>';
//    echo '</div>';

    echo '</div>';



    if(!empty($_POST['update']) && $_POST['update'] == 'confirm') {
        $_POST['update'] = '';
    }
}
?>
<script src="gameslist.js"></script>