<?php
if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {



//    echo '<table class="table table-striped" id="tableid">';
//    echo '<tbody><tr style="background-color: #1b1b1b; font-weight: bold; border-top: 2px black solid">';
//
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Lane" style="width: 50px">Lane</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Champion" style="width: 44px">Cham</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Versus" style="width: 24px">VS</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Opponent" style="width: 44px">Oppo</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Spells" style="width: 24px">S</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Keystone" style="width: 24px">K</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Items" style="width: 64px">Items</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Trinket" style="width: 24px">T</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Kills/Deaths/Assists">K/D/A</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Damage">Damage</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Gold">Gold</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Creep Score">CS</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Game Length">Length</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Kill/Death Participation %">Participation</td>';
//    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Date Played">Date</td>';
//
//    echo '</tr>';//</thead>';

    $kh = 0;
    $kl = 10000000;
    $dh = 0;
    $dl = 10000000;
    $ah = 0;
    $al = 10000000;
    $dmgh = 0;
    $dmgl = 1000000000;
    $goldh = 0;
    $goldl = 100000000;
    $csh = 0;
    $csl = 100000000;
    $dmgmh = 0;
    $dmgml = 100000000;
    $goldmh = 0;
    $goldml = 10000000;
    $csmh = 0;
    $csml = 1000000;
    $kmh = 0;
    $kml = 10000000;
    $dmh = 0;
    $dml = 10000000;
    $kph = 0;
    $kpl = 100000000;
    $dph = 0;
    $dpl = 10000000;

    $ka = 0;
    $da = 0;
    $aa = 0;
    $dmga = 0;
    $golda = 0;
    $csa = 0;
    $tka = 0;
    $tda = 0;
    $dmgma = 0;
    $goldma = 0;
    $csma = 0;
    $kma = 0;
    $dma = 0;
    $kpa = 0;
    $dpa = 0;

    $tha = 0;
    $tma = 0;
    $tsa = 0;

    $wins = 0;

    $tkh = 0;
    $tkl = 100000;
    $tdh = 0;
    $tdl = 100000;

    $th = 0;
    $tl = 1000000000000;
    $ta = 0;

    $wa = 0;
    $wl = 100000000;
    $wh = 0;

    for ($r = 0; $r < $result->rowCount(); $r++) {
        for ($c = 0; $c < $result->columnCount(); $c++) {
            if ($result->getColumnMeta($c)['name'] == 'K') {
                if ($table[$r][$c] > $kh) {
                    $kh = $table[$r][$c];
                }
                if ($table[$r][$c] < $kl) {
                    $kl = $table[$r][$c];
                }
                $ka += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'D') {
                if ($table[$r][$c] > $dh) {
                    $dh = $table[$r][$c];
                }
                if ($table[$r][$c] < $dl) {
                    $dl = $table[$r][$c];
                }
                $da += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'A') {
                if ($table[$r][$c] > $ah) {
                    $ah = $table[$r][$c];
                }
                if ($table[$r][$c] < $al) {
                    $al = $table[$r][$c];
                }
                $aa += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'Damage') {
                if ($table[$r][$c] > $dmgh) {
                    $dmgh = $table[$r][$c];
                }
                if ($table[$r][$c] < $dmgl) {
                    $dmgl = $table[$r][$c];
                }
                $dmga += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'Gold') {
                if ($table[$r][$c] > $goldh) {
                    $goldh = $table[$r][$c];
                }
                if ($table[$r][$c] < $goldl) {
                    $goldl = $table[$r][$c];
                }
                $golda += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'CS') {
                if ($table[$r][$c] > $csh) {
                    $csh = $table[$r][$c];
                }
                if ($table[$r][$c] < $csl) {
                    $csl = $table[$r][$c];
                }
                $csa += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'Length') {
                if ($table[$r][$c] > $th) {
                    $th = $table[$r][$c];
                }
                if ($table[$r][$c] < $tl) {
                    $tl = $table[$r][$c];
                }
                $ta += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'W/L') {
                if ($table[$r][$c] == 'Win') {
                    $wins++;
                }
            }
            if ($result->getColumnMeta($c)['name'] == 'TK') {
                if ($table[$r][$c] > $tkh) {
                    $tkh = $table[$r][$c];
                }
                if ($table[$r][$c] < $tkl) {
                    $tkl = $table[$r][$c];
                }
                $tka += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'TD') {
                if ($table[$r][$c] > $tdh) {
                    $tdh = $table[$r][$c];
                }
                if ($table[$r][$c] < $tdl) {
                    $tdl = $table[$r][$c];
                }
                $tda += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'Dmg/min') {
                if ($table[$r][$c] > $dmgmh) {
                    $dmgmh = $table[$r][$c];
                }
                if ($table[$r][$c] < $dmgml) {
                    $dmgml = $table[$r][$c];
                }
                $dmgma += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'Gold/min') {
                if ($table[$r][$c] > $goldmh) {
                    $goldmh = $table[$r][$c];
                }
                if ($table[$r][$c] < $goldml) {
                    $goldml = $table[$r][$c];
                }
                $goldma += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'CS/min') {
                if ($table[$r][$c] > $csmh) {
                    $csmh = $table[$r][$c];
                }
                if ($table[$r][$c] < $csml) {
                    $csml = $table[$r][$c];
                }
                $csma += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'K/min') {
                if ($table[$r][$c] > $kmh) {
                    $kmh = $table[$r][$c];
                }
                if ($table[$r][$c] < $kml) {
                    $kml = $table[$r][$c];
                }
                $kma += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'D/min') {
                if ($table[$r][$c] > $dmh) {
                    $dmh = $table[$r][$c];
                }
                if ($table[$r][$c] < $dml) {
                    $dml = $table[$r][$c];
                }
                $dma += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'KP%') {
                if ($table[$r][$c] > $kph) {
                    $kph = $table[$r][$c];
                }
                if ($table[$r][$c] < $kpl) {
                    $kpl = $table[$r][$c];
                }
                $kpa += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'DP%') {
                if ($table[$r][$c] > $dph) {
                    $dph = $table[$r][$c];
                }
                if ($table[$r][$c] < $dpl) {
                    $dpl = $table[$r][$c];
                }
                $dpa += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'W') {
                if ($table[$r][$c] > $wh) {
                    $wh = $table[$r][$c];
                }
                if ($table[$r][$c] < $wl) {
                    $wl = $table[$r][$c];
                }
                $wa += $table[$r][$c];
            }
        }
    }

    if ($result->rowCount() != 0) {
        $ka /= $result->rowCount();
        $da /= $result->rowCount();
        $aa /= $result->rowCount();
        $dmga /= $result->rowCount();
        $golda /= $result->rowCount();
        $csa /= $result->rowCount();
        $tka /= $result->rowCount();
        $tda /= $result->rowCount();
        $dmgma /= $result->rowCount();
        $goldma /= $result->rowCount();
        $csma /= $result->rowCount();
        $kma /= $result->rowCount();
        $dma /= $result->rowCount();
        $kpa /= $result->rowCount();
        $dpa /= $result->rowCount();

        $tha /= $result->rowCount();
        $tma /= $result->rowCount();
        $tsa /= $result->rowCount();

        $ta /= $result->rowCount();
        $wa /= $result->rowCount();
    }

    $time = getTime($ta);

//    echo '<tr class="average">';
//
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.round($ka, 1).'/'.round($da, 1).'/'.round($aa, 1).'</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('score').round($dmga, 2).'</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('gold').round($golda, 2).'</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('minion').round($csa, 2).'</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.$time.'</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">KP: '.round($kpa, 2).'%</td>';
//    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
//
//    echo '</tr>';
//    echo '<tr class="average">';
//
//    echo '<td class="avg" style="border: none; padding-top: 0; padding-left: 2px">-</td>';
//    echo '<td class="avg" style="border: none; padding-top: 0;">-</td>';
//    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($dmgma, 2).'/min)</td>';
//    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($goldma, 2).'/min)</td>';
//    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($csma, 2).'/min)</td>';
//    echo '<td class="avg" style="border: none; padding-top: 0;">DP: '.round($dpa, 2).'%</td>';
//    echo '<td class="avg" style="border: none; padding-top: 0">-</td>';
//
//    echo '</tr>';

    echo '<div class="games">';

    echo '<div class="games-rows">';

    echo '<div class="game game-average" id="matchavg">';
    echo '<div class="game-info">';
    echo '<div class="game-avg">';
    echo 'Average:';
    echo '</div>';
    echo '<div class="game-lane">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-champion">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-vs">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-enemy">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-spells">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-keystone">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-items">';
    echo '</div>';
    echo '<div class="game-trinket">';
//    echo '-';
    echo '</div>';
    echo '<div class="game-kda">';
    echo round($ka, 1).'/'.round($da, 1).'/'.round($aa, 1);
    echo '<div style="font-size: smaller">'.round(($ka+$aa)/$da, 2).':1 KDA</div>';
    echo '</div>';
    echo '<div class="game-damage">';
    echo getUiIMG('score').round($dmga, 2).' ';
    echo '('.round($dmgma, 2).'/min)';
    echo '</div>';
    echo '<div class="game-gold">';
    echo getUiIMG('coin').round($golda, 2).' ';
    echo '('.round($goldma, 2).'/min)';
    echo '</div>';
    echo '<div class="game-cs">';
    echo getUiIMG('minion').round($csa, 2).' ';
    echo '('.round($csma, 2).'/min)';
    echo '</div>';
    echo '<div class="game-length">';
    echo '</div>';
    echo '<div class="game-participation">';
    echo 'KP: '.round($kpa, 2).'% ';
    echo 'DP: '.round($dpa, 2).'%';
    echo '</div>';
    echo '<div class="game-date">';
    echo 'Game Length: '.$time;
    echo '</div>';

    echo '</div>';
    echo '<div class="game-more" id="matchavg-more">';
    echo '</div>';
    echo '</div>';

    foreach ($tablelimit as $row) {
        $match = array();
        try {
            $match = json_decode(utf8_decode($row['match']), true);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
//        var_dump($match, $row['match'], $row['pid']);
//        $masteries = json_decode($row['masteries'], true);
        $masteries = $match['participants'][$row['pid']-1]['masteries'];
        $lane = getCorrectLane($match, $row['pid']-1);
        $enemyid = getEnemyChampionID($match, $row['pid']-1);

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

        $row['Items'] = $match['participants'][$row['pid']-1]['stats']['item0'];
        $row['I2'] = $match['participants'][$row['pid']-1]['stats']['item1'];
        $row['I3'] = $match['participants'][$row['pid']-1]['stats']['item2'];
        $row['I4'] = $match['participants'][$row['pid']-1]['stats']['item3'];
        $row['I5'] = $match['participants'][$row['pid']-1]['stats']['item4'];
        $row['I6'] = $match['participants'][$row['pid']-1]['stats']['item5'];
        $row['T'] = $match['participants'][$row['pid']-1]['stats']['item6'];
        $row['version'] = $match['matchVersion'];

        $greenwardsbought = $match['participants'][$row['pid']-1]['stats']['sightWardsBoughtInGame'];
        $pinkwardsbought = $match['participants'][$row['pid']-1]['stats']['visionWardsBoughtInGame'];
        $wardsplaced = $match['participants'][$row['pid']-1]['stats']['wardsPlaced'];
        $wardsdestroyed = $match['participants'][$row['pid']-1]['stats']['wardsKilled'];

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

//        echo '<tr'.$color.'>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a"><a href="match.php?r='.$region.'&match='.$row['matchid'].'&player='.$userid.'" target="_blank">'.getLaneIMG($row['Lane'], 40, 40).'</a></td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a">'.getChampionIMG($row['Ch'], $row['champion'], '6.5.1', 40, 40).'</td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getVSIMG().'</td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a">'.getChampionIMG($row['VS'], $row['enemy'], '6.5.1', 40, 40).'</td>';
//        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.getSpellIMG($row['Spells'], $row['S1N']).'</td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getMasteryIMG($row['keystone'], $keystonename, $row['ddver']).'</td>';
//        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.getItemsIMG('top', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $row['ddver']).'</td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getItemIMG($row['T'], $i7).'</td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 20px";><div'.$kclass.' style="display: inline;">'.$row['K'].'</div> / <div'.$dclass.' style="display: inline;">'.$row['D'].'</div> / <div'.$aclass.' style="display: inline;">'.$row['A'].'</div></td>';
//        echo '<td'.$dmgclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('score').$row['Damage'].'</td>';
//        echo '<td'.$goldclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('gold').$row['Gold'].'</td>';
//        echo '<td'.$csclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('minion').$row['CS'].'</td>';
//        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getTime($row['Length']).'</td>';
//        echo '<td'.$kpclass.' style="border-color: #0a0a0a; padding-bottom: 0">KP: '.$row['KP%'].'%</td>';
//        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.date('Y/m/d H:i:s', $row['Date'] / 1000).'</td>';
//
//        echo '</tr>';
//        echo '<tr'.$color.'>';
//
//        echo '<td style="border: none; padding-top: 0; padding-left: 2px">'.getSpellIMG($row['S2'], $row['S2N']).'</td>';
//        echo '<td style="border: none; padding-top: 0;">'.getItemsIMG('bot', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $row['ddver']).'</td>';
//        echo '<td'.$dmgmclass.' style="border: none; padding-top: 0;">('.$row['Dmg/min'].'/min)</td>';
//        echo '<td'.$goldmclass.' style="border: none; padding-top: 0;">('.$row['Gold/min'].'/min)</td>';
//        echo '<td'.$csmclass.' style="border: none; padding-top: 0;">('.$row['CS/min'].'/min)</td>';
//        echo '<td'.$dpclass.' style="border: none; padding-top: 0;">DP: '.$row['DP%'].'%</td>';
//        echo '<td style="border: none; padding-top: 0">'.$days.' days, '.$hours.' hours ago</td>';
//
//        echo "</tr>";

        echo '<div class="game game-'.strtolower($row['W/L']).'" onclick="toggleMatch('.$row['matchid'].')">';
        echo '<div class="game-info">';
        echo '<div class="game-lane">';
        echo '<a href="match.php?r='.$region.'&match='.$row['matchid'].'&player='.$userid.'" target="_blank">'.getLaneIMG($lane, 40, 40).'</a>';
        echo '</div>';
        echo '<div class="game-champion">';
        echo getChampionIMG($row['Ch'], $row['champion'], '6.6.1', 60, 60);
        echo '</div>';
        echo '<div class="game-enemy">';
        echo getChampionIMG($enemy['pic'], $enemy['name'], '6.6.1', 60, 60);
        echo '</div>';
        echo '<div class="game-vs">';
        echo getVSIMG($row['teamid']);
        echo '</div>';
        echo '<div class="game-spells">';
        echo getSpellIMG($row['Spells'], $row['S1N']).getSpellIMG($row['S2'], $row['S2N']);
        echo '</div>';
        echo '<div class="game-keystone">';
        echo getMasteryIMG($keystone, $keystonename, $ddvero);
        echo '</div>';
        echo '<div class="game-items">'.getItemsIMG('all', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $ddvero);
        //echo '<div class="game-pos-top">'.getItemsIMG('top', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $row['ddver']).'</div>';
        //echo '<div class="game-pos-bot">'.getItemsIMG('bot', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $row['ddver']).'</div>';
        echo '</div>';
        echo '<div class="game-trinket">';
        echo getItemIMG($row['T'], $i7);
        echo '</div>';
        echo '<div class="game-kda">';
        echo '<span class="'.$kclass.'">'.$row['K'].'</span> / <span class="'.$dclass.'">'.$row['D'].'</span> / <span class="'.$aclass.'">'.$row['A'].'</span>';
        echo '<div style="font-size: smaller">'.round(($row['K']+$row['A'])/$row['D'], 2).':1 KDA</div>';
        echo '</div>';
        echo '<div class="game-damage">';
        echo getUiIMG('score').'Damage: <span class="'.$dmgclass.'">'.$row['Damage'].'</span> ';
        echo '<span class="'.$dmgmclass.'">('.$row['Dmg/min'].'/min)</span>';
        echo '</div>';
        echo '<div class="game-gold">';
        echo getUiIMG('coin').'Gold: <span class="'.$goldclass.'">'.$row['Gold'].'</span> ';
        echo '<span class="'.$goldmclass.'">('.$row['Gold/min'].'/min)</span>';
        echo '</div>';
        echo '<div class="game-cs">';
        echo getUiIMG('minion').'CS: <span class="'.$csclass.'">'.$row['CS'].'</span> ';
        echo '<span class="'.$csmclass.'">('.$row['CS/min'].'/min)</span>';
        echo '</div>';
//        echo '<div class="game-length">';
//        echo getTime($row['Length']);
//        echo '</div>';
        echo '<div class="game-participation">';
        echo '<span class="'.$kpclass.'">KP: '.$row['KP%'].'%</span> ';
        echo '<span class="'.$dpclass.'">DP: '.$row['DP%'].'%</span>';
        echo '</div>';
        echo '<div class="game-date">';
        echo 'Game Length: '.getTime($row['Length']).' - ';
        echo $days.' day'.addS($days).', '.$hours.' hour'.addS($hours).' ago - ';
        echo date('Y/m/d H:i:s T', $row['Date'] / 1000);
        echo '</div>';
        echo '<div class="game-wards">';
//        echo '<div style="color: green">'.$greenwardsbought.getUiIMG('ward_green').'</div>';
        echo '<span style="color: #00ab00" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Placed">' .$wardsplaced.getUiIMG('ward_green').'</span> ';
        echo '<span style="color: #ff4121" data-toggle="tooltip" data-placement="top" title="Wards/Trinkets Destroyed">' .$wardsdestroyed.getUiIMG('ward_destroy').'</span> ';
        echo '<span style="color: hotpink" data-toggle="tooltip" data-placement="top" title="Pink Wards Bought">'.$pinkwardsbought.getUiIMG('ward_pink').'</span>';
        echo '</div>';
        echo '<div class="game-team">';
        echo getTeamIMG($row['teamid']);
        echo '</div>';
        echo '</div>';

        echo '<div class="game-more" id="match-more-'.$row['matchid'].'">';
        echo 'add full match info here later';
        echo '<pre>';
        print_r($row['match']);
        echo '</pre>';
        echo '</div>';
        echo '</div>';


    }

    echo '</div>';

    echo '<div class="games-side-info">';
    //echo 'todo side info here';
    include 'sideinfo.php';
    echo '</div>';

    echo '</div>';

    //echo "</tbody>";

    //echo "</table>";

if(!empty($_POST['update']) && $_POST['update'] == 'confirm') {
    $_POST['update'] = '';
}


    echo '<div class="pages">';
    echo '<div class="pageleft">';

    if ($page != 1) {
        //echo '<a href="#" class="btn btn-info" role="button"><< First Page</a> ';
        echo '<form action="/index.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key != "page") {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo "<input type='hidden' name='page' value='".(1)."'/>";
        echo '<input type="submit" value="<< First Page" class="btn btn-info" />';
        echo '</form> ';
    } else {
        echo '<a href="#" class="btn btn-danger disabled" role="button"><< First Page</a> ';
    }

    if ($page > 1) {
        //echo '<a href="#" class="btn btn-info" role="button">< Previous Page</a>';
        echo '<form action="/index.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key != "page") {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo "<input type='hidden' name='page' value='".($page-1)."'/>";
        echo '<input type="submit" value="< Previous Page" class="btn btn-info" />';
        echo '</form>';
    } else {
        echo '<a href="#" class="btn btn-danger disabled" role="button">< Previous Page</a>';
    }

    echo '</div>';
    echo '<div class="pageright">';

    if ($page != $totalpages) {
        //echo '<a href="#" class="btn btn-info" role="button">Next Page ></a> ';
        echo '<form action="/index.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key != "page") {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo "<input type='hidden' name='page' value='".($page+1)."'/>";
        echo '<input type="submit" value="Next Page >" class="btn btn-info" />';
        echo '</form> ';
    } else {
        echo '<a href="#" class="btn btn-danger disabled" role="button">Next Page ></a> ';
    }

    if ($page != $totalpages) {
        //echo '<a href="javascript:gotoPage('.$totalpages.')" class="btn btn-info" role="button">Last Page >></a>';
        echo '<form action="/index.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key != "page") {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo "<input type='hidden' name='page' value='$totalpages'/>";
        echo '<input type="submit" value="Last Page >>" class="btn btn-info" />';
        echo '</form>';
    } else {
        echo '<a href="" class="btn btn-danger disabled" role="button">Last Page >></a>';
    }
    //echo '<a href="#" class="btn btn-info" role="button">Link Button</a>';

    echo '</div>';
    echo '<div class="pagecenter">';

    for($i=1; $i<=$totalpages; $i++) {
        if ($i != $page) {
            echo '<form action="/index.php" method="get">';
            foreach ($_GET as $key => $value) {
                if ($key != "page") {
                    echo "<input type='hidden' name='$key' value='$value'/>";
                }
            }
            echo "<input type='hidden' name='page' value='".($i)."'/>";
            echo '<input type="submit" value="'.$i.'" class="btn btn-info" />';
            echo '</form> ';
        } else {
            echo '<a href="" class="btn btn-danger disabled" role="button">'.$i.'</a> ';
        }
    }

    echo '</div>';
    echo '</div>';

}
?>