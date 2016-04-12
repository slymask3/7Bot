<?php
if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {
    $query = "SELECT *, c.pic as cpic, c.name as cname, s1.pic as s1pic, s1.name as s1name, s2.pic as s2pic, s2.name as s2name, m.name as map,
              round(damage/(length/60), 2) as 'Dmg/min', round(gold/(length/60), 2) as 'Gold/min', round(cs/(length/60), 2) as 'CS/min', kills/(length/60) as 'K/min', deaths/(length/60) as 'D/min' FROM ".$dbtable."
              LEFT JOIN champions c ON championid=c.id
              LEFT JOIN spells s1 ON spell1=s1.id
              LEFT JOIN spells s2 ON spell2=s2.id
              LEFT JOIN maps m ON mapid=m.id ORDER BY creation DESC";
    $result = $conn->prepare($query);
    $result->execute();
    $table = $result->fetchAll();

    echo '<div class="table-top"></div>';
    echo '<table class="table table-striped" id="tableid">';
    echo '<tbody><tr style="background-color: #1b1b1b; font-weight: bold; border-top: 2px black solid">';

    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Map" style="width: 50px">Map</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Mode">Mode</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Lane" style="width: 44px">Lane</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Champion" style="width: 44px">Cham</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Spells" style="width: 24px">S</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Items" style="width: 64px">Items</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Trinket" style="width: 24px">T</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Kills/Deaths/Assists">K/D/A</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Damage">Damage</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Gold">Gold</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Creep Score">CS</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Influence Points Earned">IP</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Game Length">Length</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Date Played">Date</td>';

    echo '</tr>';

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

    $tha = 0;
    $tma = 0;
    $tsa = 0;

    $wins = 0;

    $th = 0;
    $tl = 1000000000000;
    $ta = 0;

    $lph = 0;
    $lpl = 1000000000000;
    $lpa = 0;

    for ($r = 0; $r < $result->rowCount(); $r++) {
        for ($c = 0; $c < $result->columnCount(); $c++) {
            if ($result->getColumnMeta($c)['name'] == 'kills') {
                if ($table[$r][$c] > $kh) {
                    $kh = $table[$r][$c];
                }
                if ($table[$r][$c] < $kl) {
                    $kl = $table[$r][$c];
                }
                $ka += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'deaths') {
                if ($table[$r][$c] > $dh) {
                    $dh = $table[$r][$c];
                }
                if ($table[$r][$c] < $dl) {
                    $dl = $table[$r][$c];
                }
                $da += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'assists') {
                if ($table[$r][$c] > $ah) {
                    $ah = $table[$r][$c];
                }
                if ($table[$r][$c] < $al) {
                    $al = $table[$r][$c];
                }
                $aa += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'damage') {
                if ($table[$r][$c] > $dmgh) {
                    $dmgh = $table[$r][$c];
                }
                if ($table[$r][$c] < $dmgl) {
                    $dmgl = $table[$r][$c];
                }
                $dmga += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'gold') {
                if ($table[$r][$c] > $goldh) {
                    $goldh = $table[$r][$c];
                }
                if ($table[$r][$c] < $goldl) {
                    $goldl = $table[$r][$c];
                }
                $golda += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'cs') {
                if ($table[$r][$c] > $csh) {
                    $csh = $table[$r][$c];
                }
                if ($table[$r][$c] < $csl) {
                    $csl = $table[$r][$c];
                }
                $csa += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'length') {
                if ($table[$r][$c] > $th) {
                    $th = $table[$r][$c];
                }
                if ($table[$r][$c] < $tl) {
                    $tl = $table[$r][$c];
                }
                $ta += $table[$r][$c];
            }
            if ($result->getColumnMeta($c)['name'] == 'outcome') {
                if ($table[$r][$c] == 'Win') {
                    $wins++;
                }
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
            if ($result->getColumnMeta($c)['name'] == 'ip') {
                if ($table[$r][$c] > $lph) {
                    $lph = $table[$r][$c];
                }
                if ($table[$r][$c] < $lpl) {
                    $lpl = $table[$r][$c];
                }
                $lpa += $table[$r][$c];
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

        $lpa /= $result->rowCount();
    }

    $time = getTime($ta);

    echo '<tr style="background-color: #3d3d3d;">';

    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.round($ka, 1).'/'.round($da, 1).'/'.round($aa, 1).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('score').round($dmga, 2).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('gold').round($golda, 2).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('minion').round($csa, 2).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.round($lpa, 1).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.$time.'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';

    echo '</tr>';
    echo '<tr style="background-color: #3d3d3d;">';

    echo '<td class="avg" style="border: none; padding-top: 0; padding-left: 2px">-</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">-</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($dmgma, 2).'/min)</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($goldma, 2).'/min)</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($csma, 2).'/min)</td>';
    echo '<td class="avg" style="border: none; padding-top: 0">-</td>';

    echo '</tr>';

    foreach ($table as $row) {
        $mode = '';
        if($row['subtype'] == 'NONE') {
            $mode = '?';
        } else if($row['subtype'] == 'NORMAL') {
            $mode = 'Normal 5v5';
        } else if($row['subtype'] == 'BOT') {
            $mode = 'Bot 5v5';
        } else if($row['subtype'] == 'RANKED_SOLO_5x5') {
            $mode = 'Ranked Solo 5v5';
        } else if($row['subtype'] == 'RANKED_PREMADE_3x3') {
            $mode = 'Ranked Premade 3v3';
        } else if($row['subtype'] == 'RANKED_PREMADE_5x5') {
            $mode = 'Ranked Premade 5v5';
        } else if($row['subtype'] == 'ODIN_UNRANKED') {
            $mode = 'ODIN';
        } else if($row['subtype'] == 'RANKED_TEAM_3x3') {
            $mode = 'Ranked Team 3v3';
        } else if($row['subtype'] == 'RANKED_TEAM_5x5') {
            $mode = 'Ranked Team 5v5';
        } else if($row['subtype'] == 'NORMAL_3x3') {
            $mode = 'Normal 3v3';
        } else if($row['subtype'] == 'BOT_3x3') {
            $mode = 'Bot 3v3';
        } else if($row['subtype'] == 'CAP_5x5') {
            $mode = 'CAP 5v5';
        } else if($row['subtype'] == 'ARAM_UNRANKED_5x5') {
            $mode = 'Aram 5v5';
        } else if($row['subtype'] == 'ONEFORALL_5x5') {
            $mode = 'One For All 5v5';
        } else if($row['subtype'] == 'FIRSTBLOOD_1x1') {
            $mode = 'Firstblood 1v1';
        } else if($row['subtype'] == 'FIRSTBLOOD_2x2') {
            $mode = 'Firstblood 2v2';
        } else if($row['subtype'] == 'SR_6x6') {
            $mode = 'Normal 6v6';
        } else if($row['subtype'] == 'URF') {
            $mode = 'URF';
        } else if($row['subtype'] == 'URF_BOT') {
            $mode = 'URF Bot';
        } else if($row['subtype'] == 'NIGHTMARE_BOT') {
            $mode = 'Nightmare Bots 5v5';
        } else if($row['subtype'] == 'ASCENSION') {
            $mode = 'Ascension';
        } else if($row['subtype'] == 'HEXAKILL') {
            $mode = 'Hexakill';
        } else if($row['subtype'] == 'KING_PORO') {
            $mode = 'King Poro';
        } else if($row['subtype'] == 'COUNTER_PICK') {
            $mode = 'Counter Pick';
        } else if($row['subtype'] == 'BILGEWATER') {
            $mode = 'Bilgewater';
        }


        $color = "";

        if (array_key_exists('outcome', $row) && $row['outcome'] == "Win") {
            $color = ' style="background-color: #023500;"';
        } else if (array_key_exists('outcome', $row) && $row['outcome'] == "Loss") {
            $color = ' style="background-color: #460606;"';
        }

        $kclass = getRowColorO($row['kills'], $kh, $kl, $ka);
        $dclass = getRowColorIO($row['deaths'], $dh, $dl, $da);
        $aclass = getRowColorO($row['assists'], $ah, $al, $aa);
        $dmgclass = getRowColorO($row['damage'], $dmgh, $dmgl, $dmga);
        $goldclass = getRowColorO($row['gold'], $goldh, $goldl, $golda);
        $csclass = getRowColorO($row['cs'], $csh, $csl, $csa);
        $dmgmclass = getRowColorO($row['Dmg/min'], $dmgmh, $dmgml, $dmgma);
        $goldmclass = getRowColorO($row['Gold/min'], $goldmh, $goldml, $goldma);
        $csmclass = getRowColorO($row['CS/min'], $csmh, $csml, $csma);
        $ipclass = getRowColorO($row['ip'], $lph, $lpl, $lpa);

        $now = new DateTime();
        $then = new DateTime();
        $then->setTimestamp($row['creation']/1000);
        $ago = $now->diff($then);
        $days = $ago->days;
        $hours = $ago->h;

        $ddver = explode('.', '6.5.1');

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item0'];
        $result = $conn->prepare($query);
        $result->execute();
        $i1 = $result->fetchAll()[0]['name'];
        //var_dump($query, $i1, $row['ddver']);

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item1'];
        $result = $conn->prepare($query);
        $result->execute();
        $i2 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item2'];
        $result = $conn->prepare($query);
        $result->execute();
        $i3 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item3'];
        $result = $conn->prepare($query);
        $result->execute();
        $i4 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item4'];
        $result = $conn->prepare($query);
        $result->execute();
        $i5 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item5'];
        $result = $conn->prepare($query);
        $result->execute();
        $i6 = $result->fetchAll()[0]['name'];

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['item6'];
        $result = $conn->prepare($query);
        $result->execute();
        $i7 = $result->fetchAll()[0]['name'];

        echo '<tr'.$color.'>';
        echo '<td rowspan="2" style="border-color: #0a0a0a">'.getMapIMG($row['mapid'], $row['map'], '6.5.1', 40, 40).'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 20px">'.$mode.'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a"><a href="match.php?r='.$region.'&match='.$row['matchid'].'&player='.$userid.'" target="_blank">'.getLaneIMG($row['lane'], 40, 40).'</a></td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a">'.getChampionIMG($row['cpic'], $row['cname'], '6.5.1', 40, 40).'</td>';
        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.getSpellIMG($row['s1pic'], $row['s1name']).'</td>';
        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.getItemsIMG('top', $row['item0'], $row['item1'], $row['item2'], $row['item3'], $row['item4'], $row['item5'], $i1, $i2, $i3, $i4, $i5, $i6, '6.5.1').'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getItemIMG($row['item6'], $i7).'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 20px";><div'.$kclass.' style="display: inline;">'.$row['kills'].'</div> / <div'.$dclass.' style="display: inline;">'.$row['deaths'].'</div> / <div'.$aclass.' style="display: inline;">'.$row['assists'].'</div></td>';
        echo '<td'.$dmgclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('score').$row['damage'].'</td>';
        echo '<td'.$goldclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('gold').$row['gold'].'</td>';
        echo '<td'.$csclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('minion').$row['cs'].'</td>';
        echo '<td'.$ipclass.' rowspan="2" style="border-color: #0a0a0a; padding-top: 20px">'.$row['ip'].'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 20px">'.getTime($row['length']).'</td>';
        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.date('Y/m/d H:i:s', $row['creation'] / 1000).'</td>';

        echo '</tr>';
        echo '<tr'.$color.'>';

        echo '<td style="border: none; padding-top: 0; padding-left: 2px">'.getSpellIMG($row['s2pic'], $row['s2name']).'</td>';
        echo '<td style="border: none; padding-top: 0;">'.getItemsIMG('bot', $row['item0'], $row['item1'], $row['item2'], $row['item3'], $row['item4'], $row['item5'], $i1, $i2, $i3, $i4, $i5, $i6, '6.5.1').'</td>';
        echo '<td'.$dmgmclass.' style="border: none; padding-top: 0;">('.$row['Dmg/min'].'/min)</td>';
        echo '<td'.$goldmclass.' style="border: none; padding-top: 0;">('.$row['Gold/min'].'/min)</td>';
        echo '<td'.$csmclass.' style="border: none; padding-top: 0;">('.$row['CS/min'].'/min)</td>';
        echo '<td style="border: none; padding-top: 0">'.$days.' days, '.$hours.' hours ago</td>';

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo '<div class="table-bot"></div>';
}
?>