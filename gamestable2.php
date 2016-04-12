<?php
if(!empty($region) && !empty($username) && $accres->rowCount() > 0) {
    echo '<table class="table table-striped" id="tableid">';
    echo '<tbody><tr style="background-color: #1b1b1b; font-weight: bold; border-top: 2px black solid">';
    /*for ($i = 0; $i < $result->columnCount(); $i++) {
        if ($result->getColumnMeta($i)['name'] != 'I2' && $result->getColumnMeta($i)['name'] != 'I3' && $result->getColumnMeta($i)['name'] != 'I4' && $result->getColumnMeta($i)['name'] != 'I5' && $result->getColumnMeta($i)['name'] != 'I6' && $result->getColumnMeta($i)['name'] != 'S2' && $result->getColumnMeta($i)['name'] != 'ddver' && $result->getColumnMeta($i)['name'] != 'matchid') {
            echo '<th><a href="index.php?r=' . $region . '&name=' . $username . '&s=' . $season . '&q=' . $queue . '&order=' . ($i + 1) . '&dir=' . $diro . '&lane=' . $lane . '&champion=' . $champion . '&enemy=' . $enemy . '&limit=' . $limit . '&page=' . $page . '">' . $result->getColumnMeta($i)['name'] . '</a></th>';
        }
    }*/

    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Lane" style="width: 50px">Lane</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Champion" style="width: 44px">Cham</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Versus" style="width: 24px">VS</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Opponent" style="width: 44px">Oppo</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Spells" style="width: 24px">S</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Keystone" style="width: 24px">K</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Items" style="width: 64px">Items</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Trinket" style="width: 24px">T</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Kills/Deaths/Assists">K/D/A</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Damage">Damage</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Gold">Gold</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Creep Score">CS</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Game Length">Length</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Kill/Death Participation %">Participation</td>';
    echo '<td data-toggle="tooltip" data-container="body" data-placement="top" title="Date Played">Date</td>';

    echo '</tr>';//</thead>';

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

    /*echo '<tr class="info">';
    for ($i = 0; $i < $result->columnCount(); $i++) {
        if ($result->getColumnMeta($i)['name'] == '#') {
            echo '<td class="avg">' . $result->rowCount() . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'K') {
            echo '<td class="avg">' . round($ka, 1) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'D') {
            echo '<td class="avg">' . round($da, 1) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'A') {
            echo '<td class="avg">' . round($aa, 1) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'Damage') {
            echo '<td class="avg"><img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/score.png" width="20px" height="20px"/>' . round($dmga, 0) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'Gold') {
            echo '<td class="avg"><img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/gold.png" width="20px" height="20px"/>' . round($golda, 0) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'CS') {
            echo '<td class="avg"><img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/minion.png" width="20px" height="20px"/>' . round($csa, 0) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'Length') {
            echo '<td class="avg">' . $time . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'W/L' && $result->rowCount() != 0) {
            echo '<td class="avg">' . round(($wins / $result->rowCount()) * 100, 2) . '%</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'TK') {
            echo '<td class="avg">' . round($tka, 0) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'TD') {
            echo '<td class="avg">' . round($tda, 0) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'KDA') {
            echo '<td class="avg">' . round(($ka + $aa) / $da, 2) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'Dmg/min') {
            echo '<td class="avg">' . round($dmgma, 4) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'Gold/min') {
            echo '<td class="avg">' . round($goldma, 4) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'CS/min') {
            echo '<td class="avg">' . round($csma, 4) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'K/min') {
            echo '<td class="avg">' . round($kma, 4) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'D/min') {
            echo '<td class="avg">' . round($dma, 4) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'KP%') {
            echo '<td class="avg">' . round($kpa, 2) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'DP%') {
            echo '<td class="avg">' . round($dpa, 2) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] == 'W') {
            echo '<td class="avg">' . round($wa, 1) . '</td>';
        } else if ($result->getColumnMeta($i)['name'] != 'I2' && $result->getColumnMeta($i)['name'] != 'I3' && $result->getColumnMeta($i)['name'] != 'I4' && $result->getColumnMeta($i)['name'] != 'I5' && $result->getColumnMeta($i)['name'] != 'I6' && $result->getColumnMeta($i)['name'] != 'S2' && $result->getColumnMeta($i)['name'] != 'ddver' && $result->getColumnMeta($i)['name'] != 'matchid') {
            echo '<td class="avg">-</td>';
        }
    }
    echo '</tr>';*/

    //echo '<tbody>';

    echo '<tr class="average">';

    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">-</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.round($ka, 1).'/'.round($da, 1).'/'.round($aa, 1).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('score').round($dmga, 2).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('gold').round($golda, 2).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('minion').round($csa, 2).'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-top: 20px" rowspan="2">'.$time.'</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">KP: '.round($kpa, 2).'%</td>';
    echo '<td class="avg" style="border-color: #0a0a0a; padding-bottom: 0">-</td>';

    echo '</tr>';
    echo '<tr class="average">';

    echo '<td class="avg" style="border: none; padding-top: 0; padding-left: 2px">-</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">-</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($dmgma, 2).'/min)</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($goldma, 2).'/min)</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">('.round($csma, 2).'/min)</td>';
    echo '<td class="avg" style="border: none; padding-top: 0;">DP: '.round($dpa, 2).'%</td>';
    echo '<td class="avg" style="border: none; padding-top: 0">-</td>';

    echo '</tr>';

    foreach ($tablelimit as $row) {
        $color = "";

        if (array_key_exists('W/L', $row) && $row['W/L'] == "Win") {
//            $color = ' style="background-color: #bfffbe;"';
            $color = ' class="win"';
        } else if (array_key_exists('W/L', $row) && $row['W/L'] == "Loss") {
//            $color = ' style="background-color: #ffaa9f;"';
            $color = ' class="loss"';
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
        /*if ($row['K'] == $kh) {
            $kclass = ' class = "highest"';
        } else if($row['K'] == $kl) {
            $kclass = ' class = "lowest"';
        } else if($row['K'] >= $ka) {
            $kclass = ' id = "aboveavg"';
        } else if($row['K'] < $ka) {
            $kclass = ' id = "belowavg"';
        }
        if ($row['D'] == $dh) {
            $dclass = ' class = "highest"';
        } else if($row['D'] == $dl) {
            $dclass = ' class = "lowest"';
        } else if($row['D'] >= $da) {
            $dclass = ' id = "aboveavg"';
        } else if($row['D'] < $da) {
            $dclass = ' id = "belowavg"';
        }
        if ($row['A'] == $ah) {
            $aclass = ' class = "highest"';
        } else if($row['A'] == $al) {
            $aclass = ' class = "lowest"';
        } else if($row['A'] >= $aa) {
            $aclass = ' id = "aboveavg"';
        } else if($row['A'] < $aa) {
            $aclass = ' id = "belowavg"';
        }
        if ($row['Damage'] == $dmgh) {
            $dmgclass = ' class = "highest"';
        } else if($row['Damage'] == $dmgl) {
            $dmgclass = ' class = "lowest"';
        } else if($row['Damage'] >= $dmga) {
            $dmgclass = ' id = "aboveavg"';
        } else if($row['Damage'] < $dmga) {
            $dmgclass = ' id = "belowavg"';
        }
        if ($row['Gold'] == $goldh) {
            $goldclass = ' class = "highest"';
        } else if($row['Gold'] == $goldl) {
            $goldclass = ' class = "lowest"';
        } else if($row['Gold'] >= $golda) {
            $goldclass = ' id = "aboveavg"';
        } else if($row['Gold'] < $golda) {
            $goldclass = ' id = "belowavg"';
        }
        if ($row['CS'] == $csh) {
            $csclass = ' class = "highest"';
        } else if($row['CS'] == $csl) {
            $csclass = ' class = "lowest"';
        } else if($row['CS'] >= $csa) {
            $csclass = ' id = "aboveavg"';
        } else if($row['CS'] < $csa) {
            $csclass = ' id = "belowavg"';
        }*/

        $now = new DateTime();
        $then = new DateTime();
        $then->setTimestamp($row['Date']/1000);
        $ago = $now->diff($then);
        $days = $ago->days;
        $hours = $ago->h;

        $ddver = explode('.', $row['ddver']);

        $query = 'SELECT id, name FROM items_'.$ddver[0].'_'.$ddver[1].'_'.$ddver[2].' WHERE id='.$row['Items'];
        $result = $conn->prepare($query);
        $result->execute();
        $i1 = $result->fetchAll()[0]['name'];
        //var_dump($query, $i1, $row['ddver']);

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

        $query = 'SELECT id, name FROM keystones WHERE id='.$row['keystone'];
        $result = $conn->prepare($query);
        $result->execute();
        $keystonename = $result->fetchAll()[0]['name'];

        echo '<tr'.$color.'>';
        echo '<td rowspan="2" style="border-color: #0a0a0a"><a href="match.php?r='.$region.'&match='.$row['matchid'].'&player='.$userid.'" target="_blank">'.getLaneIMG($row['Lane'], 40, 40).'</a></td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a">'.getChampionIMG($row['Ch'], $row['champion'], '6.5.1', 40, 40).'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getVSIMG().'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a">'.getChampionIMG($row['VS'], $row['enemy'], '6.5.1', 40, 40).'</td>';
        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.getSpellIMG($row['Spells'], $row['S1N']).'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getMasteryIMG($row['keystone'], $keystonename, $row['ddver']).'</td>';
        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.getItemsIMG('top', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $row['ddver']).'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getItemIMG($row['T'], $i7).'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 20px";><div'.$kclass.' style="display: inline;">'.$row['K'].'</div> / <div'.$dclass.' style="display: inline;">'.$row['D'].'</div> / <div'.$aclass.' style="display: inline;">'.$row['A'].'</div></td>';
        echo '<td'.$dmgclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('score').$row['Damage'].'</td>';
        echo '<td'.$goldclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('gold').$row['Gold'].'</td>';
        echo '<td'.$csclass.' style="border-color: #0a0a0a; padding-bottom: 0">'.getUiIMG('minion').$row['CS'].'</td>';
        echo '<td rowspan="2" style="border-color: #0a0a0a; padding-top: 18px">'.getTime($row['Length']).'</td>';
        echo '<td'.$kpclass.' style="border-color: #0a0a0a; padding-bottom: 0">KP: '.$row['KP%'].'%</td>';
        echo '<td style="border-color: #0a0a0a; padding-bottom: 0">'.date('Y/m/d H:i:s', $row['Date'] / 1000).'</td>';

        echo '</tr>';
        echo '<tr'.$color.'>';

        echo '<td style="border: none; padding-top: 0; padding-left: 2px">'.getSpellIMG($row['S2'], $row['S2N']).'</td>';
        echo '<td style="border: none; padding-top: 0;">'.getItemsIMG('bot', $row['Items'], $row['I2'], $row['I3'], $row['I4'], $row['I5'], $row['I6'], $i1, $i2, $i3, $i4, $i5, $i6, $row['ddver']).'</td>';
        echo '<td'.$dmgmclass.' style="border: none; padding-top: 0;">('.$row['Dmg/min'].'/min)</td>';
        echo '<td'.$goldmclass.' style="border: none; padding-top: 0;">('.$row['Gold/min'].'/min)</td>';
        echo '<td'.$csmclass.' style="border: none; padding-top: 0;">('.$row['CS/min'].'/min)</td>';
        echo '<td'.$dpclass.' style="border: none; padding-top: 0;">DP: '.$row['DP%'].'%</td>';
        echo '<td style="border: none; padding-top: 0">'.$days.' days, '.$hours.' hours ago</td>';


        /*for ($i = 0; $i < $result->columnCount(); $i++) {
            $extra = "";

            if ($result->rowCount() > 1) {
                if (($result->getColumnMeta($i)['name'] == 'K' && $row[$i] == $kl) ||
                    ($result->getColumnMeta($i)['name'] == 'D' && $row[$i] == $dh) ||
                    ($result->getColumnMeta($i)['name'] == 'A' && $row[$i] == $al) ||
                    ($result->getColumnMeta($i)['name'] == 'Damage' && $row[$i] == $dmgl) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold' && $row[$i] == $goldl) ||
                    ($result->getColumnMeta($i)['name'] == 'CS' && $row[$i] == $csl) ||
                    ($result->getColumnMeta($i)['name'] == 'TK' && $row[$i] == $tkl) ||
                    ($result->getColumnMeta($i)['name'] == 'TD' && $row[$i] == $tdh) ||
                    ($result->getColumnMeta($i)['name'] == 'Dmg/min' && $row[$i] == $dmgml) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold/min' && $row[$i] == $goldml) ||
                    ($result->getColumnMeta($i)['name'] == 'CS/min' && $row[$i] == $csml) ||
                    ($result->getColumnMeta($i)['name'] == 'K/min' && $row[$i] == $kml) ||
                    ($result->getColumnMeta($i)['name'] == 'D/min' && $row[$i] == $dmh) ||
                    ($result->getColumnMeta($i)['name'] == 'KP%' && $row[$i] == $kpl) ||
                    ($result->getColumnMeta($i)['name'] == 'DP%' && $row[$i] == $dph) ||
                    ($result->getColumnMeta($i)['name'] == 'W' && $row[$i] == $wl)
                ) {
                    $extra .= ' class = "lowest"';
                } else if (($result->getColumnMeta($i)['name'] == 'K' && $row[$i] == $kh) ||
                    ($result->getColumnMeta($i)['name'] == 'D' && $row[$i] == $dl) ||
                    ($result->getColumnMeta($i)['name'] == 'A' && $row[$i] == $ah) ||
                    ($result->getColumnMeta($i)['name'] == 'Damage' && $row[$i] == $dmgh) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold' && $row[$i] == $goldh) ||
                    ($result->getColumnMeta($i)['name'] == 'CS' && $row[$i] == $csh) ||
                    ($result->getColumnMeta($i)['name'] == 'TK' && $row[$i] == $tkh) ||
                    ($result->getColumnMeta($i)['name'] == 'TD' && $row[$i] == $tdl) ||
                    ($result->getColumnMeta($i)['name'] == 'Dmg/min' && $row[$i] == $dmgmh) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold/min' && $row[$i] == $goldmh) ||
                    ($result->getColumnMeta($i)['name'] == 'CS/min' && $row[$i] == $csmh) ||
                    ($result->getColumnMeta($i)['name'] == 'K/min' && $row[$i] == $kmh) ||
                    ($result->getColumnMeta($i)['name'] == 'D/min' && $row[$i] == $dml) ||
                    ($result->getColumnMeta($i)['name'] == 'KP%' && $row[$i] == $kph) ||
                    ($result->getColumnMeta($i)['name'] == 'DP%' && $row[$i] == $dpl) ||
                    ($result->getColumnMeta($i)['name'] == 'W' && $row[$i] == $wh)
                ) {
                    $extra .= ' class = "highest"';
                } else if (($result->getColumnMeta($i)['name'] == 'K' && $row[$i] >= $ka) ||
                    ($result->getColumnMeta($i)['name'] == 'D' && $row[$i] <= $da) ||
                    ($result->getColumnMeta($i)['name'] == 'A' && $row[$i] >= $aa) ||
                    ($result->getColumnMeta($i)['name'] == 'Damage' && $row[$i] >= $dmga) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold' && $row[$i] >= $golda) ||
                    ($result->getColumnMeta($i)['name'] == 'CS' && $row[$i] >= $csa) ||
                    ($result->getColumnMeta($i)['name'] == 'TK' && $row[$i] > $tka) ||
                    ($result->getColumnMeta($i)['name'] == 'TD' && $row[$i] < $tda) ||
                    ($result->getColumnMeta($i)['name'] == 'Dmg/min' && $row[$i] >= $dmgma) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold/min' && $row[$i] >= $goldma) ||
                    ($result->getColumnMeta($i)['name'] == 'CS/min' && $row[$i] >= $csma) ||
                    ($result->getColumnMeta($i)['name'] == 'K/min' && $row[$i] >= $kma) ||
                    ($result->getColumnMeta($i)['name'] == 'D/min' && $row[$i] <= $dma) ||
                    ($result->getColumnMeta($i)['name'] == 'KP%' && $row[$i] >= $kpa) ||
                    ($result->getColumnMeta($i)['name'] == 'DP%' && $row[$i] <= $dpa) ||
                    ($result->getColumnMeta($i)['name'] == 'W' && $row[$i] >= $wa)
                ) {
                    $extra .= ' id = "aboveavg"';
                } else if (($result->getColumnMeta($i)['name'] == 'K' && $row[$i] < $ka) ||
                    ($result->getColumnMeta($i)['name'] == 'D' && $row[$i] > $da) ||
                    ($result->getColumnMeta($i)['name'] == 'A' && $row[$i] < $aa) ||
                    ($result->getColumnMeta($i)['name'] == 'Damage' && $row[$i] < $dmga) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold' && $row[$i] < $golda) ||
                    ($result->getColumnMeta($i)['name'] == 'CS' && $row[$i] < $csa) ||
                    ($result->getColumnMeta($i)['name'] == 'TK' && $row[$i] < $tka) ||
                    ($result->getColumnMeta($i)['name'] == 'TD' && $row[$i] > $tda) ||
                    ($result->getColumnMeta($i)['name'] == 'Dmg/min' && $row[$i] < $dmgma) ||
                    ($result->getColumnMeta($i)['name'] == 'Gold/min' && $row[$i] < $goldma) ||
                    ($result->getColumnMeta($i)['name'] == 'CS/min' && $row[$i] < $csma) ||
                    ($result->getColumnMeta($i)['name'] == 'K/min' && $row[$i] < $kma) ||
                    ($result->getColumnMeta($i)['name'] == 'D/min' && $row[$i] > $dma) ||
                    ($result->getColumnMeta($i)['name'] == 'KP%' && $row[$i] < $kpa) ||
                    ($result->getColumnMeta($i)['name'] == 'DP%' && $row[$i] > $dpa) ||
                    ($result->getColumnMeta($i)['name'] == 'W' && $row[$i] < $wa)
                ) {
                    $extra .= ' id = "belowavg"';
                }
            }

            if (array_key_exists('Ch', $row) && $result->getColumnMeta($i)['name'] == 'Ch') {
                echo '<td' . $extra . '><img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/champion/' . $row[$i] . '.png" width="20px" height="20px"/> ' . /*$row[$i] .
                    '</td>';
            } else if (array_key_exists('VS', $row) && $result->getColumnMeta($i)['name'] == 'VS') {
                echo '<td' . $extra . '><img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/champion/' . $row[$i] . '.png" width="20px" height="20px"/> ' .
                    '</td>';
            } else if (array_key_exists('Gold', $row) && $result->getColumnMeta($i)['name'] == 'Gold') {
                echo '<td' . $extra . '><img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/gold.png" width="20px" height="20px"/>' . $row[$i] . '</td>';
            } else if (array_key_exists('Damage', $row) && $result->getColumnMeta($i)['name'] == 'Damage') {
                echo '<td' . $extra . '><img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/score.png" width="20px" height="20px"/>' . $row[$i] . '</td>';
            } else if (array_key_exists('CS', $row) && $result->getColumnMeta($i)['name'] == 'CS') {
                echo '<td' . $extra . '><img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/minion.png" width="20px" height="20px"/>' . $row[$i] . '</td>';
            } else if (array_key_exists('Length', $row) && $result->getColumnMeta($i)['name'] == 'Length') {
                echo '<td' . $extra . '>' . getTime($row[$i]) . '</td>';
            } else if ((array_key_exists('Spells', $row) && $result->getColumnMeta($i)['name'] == 'Spells')) {
                echo '<td' . $extra . '>';
                echo '<img src="http://ddragon.leagueoflegends.com/cdn/6.3.1/img/spell/' . $row[$i] . '.png" width="20px" height="20px"/>';
                echo '<img src="http://ddragon.leagueoflegends.com/cdn/6.3.1/img/spell/' . $row['S2'] . '.png" width="20px" height="20px"/>';
                echo '</td>';
            } else if ((array_key_exists('Items', $row) && $result->getColumnMeta($i)['name'] == 'Items')) {
                echo '<td' . $extra . '>';
                if ($row[$i] != 0) {
                    echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row[$i] . '.png" width="20px" height="20px"/>';
                };
                if ($row['I2'] != 0) {
                    echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row['I2'] . '.png" width="20px" height="20px"/>';
                };
                if ($row['I3'] != 0) {
                    echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row['I3'] . '.png" width="20px" height="20px"/>';
                };
                if ($row['I4'] != 0) {
                    echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row['I4'] . '.png" width="20px" height="20px"/>';
                };
                if ($row['I5'] != 0) {
                    echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row['I5'] . '.png" width="20px" height="20px"/>';
                };
                if ($row['I6'] != 0) {
                    echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row['I6'] . '.png" width="20px" height="20px"/>';
                };
                echo '</td>';
            } else if ((array_key_exists('T', $row) && $result->getColumnMeta($i)['name'] == 'T')) {
                echo '<td' . $extra . '>';
                echo '<img src="http://ddragon.leagueoflegends.com/cdn/' . $row['ddver'] . '/img/item/' . $row[$i] . '.png" width="20px" height="20px"/>';
                echo '</td>';
            } else if (array_key_exists('Date', $row) && $result->getColumnMeta($i)['name'] == 'Date') {
                echo '<td' . $extra . '>' . date('Y/m/d H:i:s', $row[$i] / 1000) . '</td>';
            } else if ((array_key_exists('Lane', $row) && $result->getColumnMeta($i)['name'] == 'Lane')) {
                echo '<td' . $extra . '>';
                echo '<img src="assets/lane_' . $row[$i] . '.png" width="20px" height="20px"/>';
                echo '</td>';
            } else if ((array_key_exists('#', $row) && $result->getColumnMeta($i)['name'] == '#')) {
                echo '<td' . $extra . '><a href="match.php?r='.$region.'&match=' . $row['matchid'] . '&player='.$userid.'">' . $row[$i] . '</a></td>';
            } else if ($result->getColumnMeta($i)['name'] != 'I2' && $result->getColumnMeta($i)['name'] != 'I3' && $result->getColumnMeta($i)['name'] != 'I4' && $result->getColumnMeta($i)['name'] != 'I5' && $result->getColumnMeta($i)['name'] != 'I6' && $result->getColumnMeta($i)['name'] != 'S2' && $result->getColumnMeta($i)['name'] != 'ddver' && $result->getColumnMeta($i)['name'] != 'matchid') {
                echo '<td' . $extra . '>' . $row[$i] . '</td>';
            }
        }*/

        echo "</tr>";
    }

    echo "</tbody>";

    echo "</table>";

//echo '</div>';
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