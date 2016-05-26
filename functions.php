<?php
$imgerr = "this.src='assets/error.png'";
$websitename = '7 Bot';
$ddver_latest = '6.10.1';
$totalchampions = 131;
include('hidden.php');

set_time_limit(0);
error_reporting(E_ERROR | E_PARSE);

function getTime($unix) {
    $min = floor($unix / 60);
    $sec = $unix % 60;

    $mins = $min;
    if($min < 10) {
        $mins = '0'.$min;
    }
    $secs = $sec;
    if($sec < 10) {
        $secs = '0'.$sec;
    }

    return $mins.':'.$secs;
}

function getDDV($versions, $end = '') {
    //https://ddragon.leagueoflegends.com/cdn/'.$ver.'/img/item/' . $row[$i] . '.png



    //var_dump($versions);
    //var_dump($versions[0]);
    //var_dump($versions[0][0]);


    $i = 0;
    //for($i=0; $i < count($versions); $i++) {
    $continue = true;

    while($continue) {
    //while(!url_exists('https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end)) {
       /* echo 'https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end;
        echo '<img src="https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end.'" width="20px" height="20px"/>';
        if((url_exists('https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end))) {
            echo 'Yes';
        } else {
            echo 'No';
        }
        echo '<br>';*/
        //echo 'https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end;
        //echo '<br>';
        try {
            if (getimagesize('http://ddragon.leagueoflegends.com/cdn/' . $versions[$i]['version'] . '/img/' . $end) == true) {
                //if($i >= 5) {
                $continue = false;
                //break;
            } else {
                $i++;
            }
        } catch(Exception $e) {

        }
//echo (url_exists('https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end));
//echo true;
        //echo '<img src="'.'https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end.'" /">';

        /*if((url_exists('http://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end))) {
            echo 'Yes';
        } else {
            echo 'No';
        }*/

    }


    return 'https://ddragon.leagueoflegends.com/cdn/'.$versions[$i]['version'].'/img/'.$end;
}

function url_exists($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    } else{
      $status = false;
    }
    curl_close($ch);

    //echo '$code == '.$code;
    //echo ' $status == '.$status.'<br>';
   return $status;
}

function ur_exists($url){
   $headers=get_headers($url);
   return stripos($headers[0],"200 OK")?true:false;
}

function r_exists($url){
   return getimagesize($url);
}

//echo getDDV('item/3001.png');
//echo getDDV('item/3255.png');

//echo '<img src="'.getDDV('img/item/' . $row[$i] . '.png').'" width="20px" height="20px"/>';

    //$conn = null;

function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    //return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
}

function createGamesTableIfNotExists($table) {
    $query = 'CREATE TABLE IF NOT EXISTS ' . $table . ' (
                        matchid BIGINT PRIMARY KEY,
                        lane VARCHAR(7),
                        championid INT,
                        enemyid INT,
                        kills INT,
                        deaths INT,
                        assists INT,
                        damage INT,
                        gold INT,
                        cs INT,
                        length INT,
                        outcome VARCHAR(4),
                        teamKills INT,
                        teamDeaths INT,
                        creation BIGINT,
                        spell1id INT,
                        spell2id INT,
                        item0 INT,
                        item1 INT,
                        item2 INT,
                        item3 INT,
                        item4 INT,
                        item5 INT,
                        item6 INT,
                        wards INT,
                        team VARCHAR(4),
                        ddver VARCHAR(20),
                        keystone INT
                    ) COLLATE utf8_general_ci;';
    return $query;
}

function createMatchesTableIfNotExists($region) {
    $query = 'CREATE TABLE IF NOT EXISTS matches_'.strtoupper($region).' (
                        matchid BIGINT PRIMARY KEY,
                        data JSON
                    ) COLLATE utf8_general_ci;';
    return $query;
}

function createMatchesTableIfNotExists3($region, $season) {
    $query = 'CREATE TABLE IF NOT EXISTS matches_'.strtoupper($region).'_'.$season.' (
                        matchid BIGINT PRIMARY KEY,
                        data JSON
                    ) COLLATE utf8_general_ci;';
    return $query;
}

function createMatchesTableIfNotExists2($region) {
    $query = 'CREATE TABLE IF NOT EXISTS matches_'.strtoupper($region).' (
                    matchid INT PRIMARY KEY NOT NULL,
                    creation BIGINT,
                    duration INT,
                    type VARCHAR(30),
                    mode VARCHAR(30),
                    queue VARCHAR(30),
                    season VARCHAR(30),
                    version VARCHAR(20),
                    ddver VARCHAR(20),
                    mapid SMALLINT,
                    platform VARCHAR(10),
                    winner SMALLINT, ';
    for($i=0; $i<10; $i++) {
        $query .=  'p'.$i.'id INT,
                    p'.$i.'displayname VARCHAR(16),
                    p'.$i.'lane VARCHAR(7),
                    p'.$i.'championid INT,
                    p'.$i.'kills INT,
                    p'.$i.'deaths INT,
                    p'.$i.'assists INT,
                    p'.$i.'damage INT,
                    p'.$i.'gold INT,
                    p'.$i.'cs INT,
                    p'.$i.'spell1id INT,
                    p'.$i.'spell2id INT,
                    p'.$i.'item0 INT,
                    p'.$i.'item1 INT,
                    p'.$i.'item2 INT,
                    p'.$i.'item3 INT,
                    p'.$i.'item4 INT,
                    p'.$i.'item5 INT,
                    p'.$i.'item6 INT,
                    p'.$i.'wards INT,
                    p'.$i.'teamid SMALLINT,
                    p'.$i.'keystone INT, ';
    }
    $query.=       'ban11 INT,
                    ban12 INT,
                    ban13 INT,
                    ban21 INT,
                    ban22 INT,
                    ban23 INT,
                    timeline JSON
                );';
    return $query;
}

function createMatchesTableIfNotExists4($region, $season) {
    $query = 'CREATE TABLE matches_'.$region.'_'.$season.' ( matchid BIGINT, creation DATE, data JSON, PRIMARY KEY(matchid, creation) )
PARTITION BY RANGE(MONTH(creation)) (
  PARTITION jan VALUES LESS THAN (2) ENGINE = MyISAM,
  PARTITION feb VALUES LESS THAN (3) ENGINE = MyISAM,
  PARTITION mar VALUES LESS THAN (4) ENGINE = MyISAM,
  PARTITION apr VALUES LESS THAN (5) ENGINE = MyISAM,
  PARTITION may VALUES LESS THAN (6) ENGINE = MyISAM,
  PARTITION jun VALUES LESS THAN (7) ENGINE = MyISAM,
  PARTITION jul VALUES LESS THAN (8) ENGINE = MyISAM,
  PARTITION aug VALUES LESS THAN (9) ENGINE = MyISAM,
  PARTITION sep VALUES LESS THAN (10) ENGINE = MyISAM,
  PARTITION oct VALUES LESS THAN (11) ENGINE = MyISAM,
  PARTITION nov VALUES LESS THAN (12) ENGINE = MyISAM,
  PARTITION `dec` VALUES LESS THAN (13) ENGINE = MyISAM
);';
    return $query;
}

function insertIntoMatches($region, $matchid, $creation, $duration, $type, $mode, $queue, $season, $mapid, $version, $ddver, $platform, $mapid, $winner,
                           $id, $displayname, $lane, $championid, $kills, $deaths, $assists, $damage, $gold, $cs, $spell1id, $spell2id,
                           $item0, $item1, $item2, $item3, $item4, $item5, $item6, $wards, $teamid, $keystone,
                           $ban11, $ban12, $ban13, $ban21, $ban22, $ban23) {
    $query = 'INSERT INTO matches_'.$region.' VALUES (
	                    '.$matchid.',
	' .$creation. ', 
	' .$duration. ',
	"' .$type. '",
	"' .$mode. '",
	"' .$queue. '",
	"' .$season. '",
"' .$version. '",
"' .$ddver. '",
' .$mapid. ',
"' .$platform. '",
' .$winner. ', ';

    for($i=0; $i<10; $i++) {
   $query .= $id[$i]. ',
        "' .$displayname[$i]. '",
        "' .$lane[$i]. '",
        ' .$championid[$i]. ',
        ' .$kills[$i]. ',
        ' .$deaths[$i]. ',
        ' .$assists[$i]. ',
        ' .$damage[$i]. ',
        ' .$gold[$i]. ',
        ' .$cs[$i]. ',
        ' .$spell1id[$i]. ',
        ' .$spell2id[$i]. ',
        ' .$item0[$i]. ',
        ' .$item1[$i]. ',
        ' .$item2[$i]. ',
        ' .$item3[$i]. ',
        ' .$item4[$i]. ',
        ' .$item5[$i]. ',
        ' .$item6[$i]. ',
        ' .$wards[$i]. ',
        ' .$teamid[$i]. ',
        ' .$keystone[$i]. ', ';
    }

    $query .= $ban11. ',
    ' .$ban12. ',
    ' .$ban13. ',
    ' .$ban21. ',
    ' .$ban22. ',
    ' .$ban23.',
    :timeline
    );';

    return $query;
}

function getDDVer($matchversion) {
    $mv = explode('.', $matchversion);

    if ($mv[0] == 6) {
        if ($mv[1] == 4) {
            $mv[2] = 2;
        } else {
            $mv[2] = 1;
        }
    } else if ($mv[0] == 5) {
        if ($mv[1] == 22 || $mv[1] == 5) {
            $mv[2] = 3;
        } else if ($mv[1] == 24 || $mv[1] == 7 || $mv[1] == 6 || $mv[1] == 2 || $mv[1] == 1) {
            $mv[2] = 2;
        } else {
            $mv[2] = 1;
        }
    } else if ($mv[0] == 4) {
        if ($mv[1] == 1) {
            $mv[2] = 43;
        } else if ($mv[1] == 3) {
            $mv[2] = 18;
        } else if ($mv[1] == 7) {
            $mv[2] = 16;
        } else if ($mv[1] == 10) {
            $mv[2] = 7;
        } else if ($mv[1] == 2) {
            $mv[2] = 6;
        } else if ($mv[1] == 21) {
            $mv[2] = 5;
        } else if ($mv[1] == 5) {
            $mv[2] = 4;
        } else if ($mv[1] == 19 || $mv[1] == 11 || $mv[1] == 8 || $mv[1] == 6 || $mv[1] == 4) {
            $mv[2] = 3;
        } else if ($mv[1] == 20 || $mv[1] == 14 || $mv[1] == 12) {
            $mv[2] = 2;
        } else {
            $mv[2] = 1;
        }
    } else if ($mv[0] == 3) {
        if ($mv[1] == 14) {
            $mv[2] = 41;
        } else if ($mv[1] == 12) {
            $mv[2] = 37;
        } else if ($mv[1] == 13) {
            $mv[2] = 24;
        } else if ($mv[1] == 14) {
            $mv[2] = 23;
        } else if ($mv[1] == 6) {
            $mv[2] = 15;
        } else if ($mv[1] == 7) {
            $mv[2] = 9;
        } else if ($mv[1] == 9) {
            $mv[2] = 7;
        } else if ($mv[1] == 10) {
            $mv[2] = 6;
        } else if ($mv[1] == 15 || $mv[1] == 8) {
            $mv[2] = 5;
        } else if ($mv[1] == 11) {
            $mv[2] = 4;
        }
    } else if ($mv[0] == 0) {
        if ($mv[1] == 152) {
            $mv[2] = 115;
        } else if ($mv[1] == 151) {
            $mv[2] = 101;
        } else if ($mv[1] == 154) {
            $mv[2] = 3;
        } else if ($mv[1] == 153) {
            $mv[2] = 2;
        }
    }

    $ddver = $mv[0] . '.' . $mv[1] . '.' . $mv[2];

    return $ddver;
}

function getLane($player) {
    $lane = '';
    if ($player['lane'] == 'TOP') {
        $lane = 'Top';
    } else if ($player['lane'] == 'JUNGLE') {
        $lane = 'Jungle';
    } else if ($player['lane'] == 'MID' || $player['lane'] == 'MIDDLE') {
        $lane = 'Mid';
    } else if ($player['lane'] == 'BOTTOM' || $player['lane'] == 'BOT') {
        if ($player['role'] == 'DUO_CARRY' || $player['role'] == 'DUO') {
            $lane = 'ADC';
        } else if ($player['role'] == 'DUO_SUPPORT') {
            $lane = 'Support';
        }
    }
    return $lane;
}

function getChampionIMG($champpic, $champ, $ddver='6.10.1', $width=20, $height=20, $crop=0) {
    $imgerr = "this.src='assets/error.png'";
    if($crop==1) {
        return '<div class="image-cropper" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$champ.'"><img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/champion/'.$champpic.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/></div>';
    } else if($crop==0)  {
        return '<img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/champion/'.$champpic.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$champ.'"/>';
    } else if($crop==2) {
        return '<div class="image-cropper-left" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$champ.'"><img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/champion/'.$champpic.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/></div>';
    } else if($crop==3) {
        return '<div class="image-cropper-right" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$champ.'"><img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/champion/'.$champpic.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/></div>';
    }
}

function getLaneIMG($lane, $width=20, $height=20, $crop=false) {
    $imgerr = "this.src='assets/error.png'";
    if($crop) {
        return '<div class="image-cropper" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$lane.'"><img src="assets/lane_'.$lane.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/></div>';
    } else  {
        return '<img src="assets/lane_'.$lane.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$lane.'"/>';
    }
}

function getSpellIMG($spell, $spellname, $ddver='6.10.1', $width=20, $height=20) {
    $imgerr = "this.src='assets/error.png'";
    return '<img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/spell/'.$spell.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$spellname.'"/>';
}

function getItemIMG($item, $itemname='', $ddver='6.10.1', $width=20, $height=20) {
    $imgerr = "this.src='assets/error.png'";
//    return '<img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/item/'.$item.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '" data-toggle="tooltip" data-placement="top" title="'.$itemname.'"/>';
    return '<a href="items.php?id='.$item.'"><img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/item/'.$item.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$itemname.'"/></a>';
}

function getUiIMG($pic, $width=15, $height=15) {
    $imgerr = "this.src='assets/error.png'";
    //return '<img src="http://ddragon.leagueoflegends.com/cdn/5.5.1/img/ui/'.$pic.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/>';
    return '<img src="assets/'.$pic.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/>';
}

function getTeamIMG($id, $width=20, $height=20) {
    $imgerr = "this.src='assets/error.png'";
    return '<img src="assets/team_'.$id.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '" data-container="body" data-toggle="tooltip" data-placement="top" title="'.($id==100 ? 'Blue Side' : 'Red Side').'"/>';
}

function getMasteryIMG($mastery, $masteryname, $ddver='6.10.1', $width=20, $height=20) {
    $imgerr = "this.src='assets/error.png'";
    return '<img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver.'/img/mastery/'.$mastery.'.png" width="'.$width.'px" height="'.$height.'px" data-container="body" data-toggle="tooltip" data-placement="top" title="'.$masteryname.'" onerror="' . $imgerr . '"/>';
}

function getVSIMG($teamid=100, $width=30, $height=30) {
    $imgerr = "this.src='assets/error.png'";
    return '<img src="assets/vs_'.$teamid.'.png" width="'.$width.'px" height="'.$height.'px" onerror="' . $imgerr . '"/>';
}

function getMapIMG($mapid, $map, $ddver='6.7.1', $width=20, $height=20, $crop=0) {
    $imgerr = "this.src='assets/error.png'";
    if($crop==1) {
        return '<div class="image-cropper" data-toggle="tooltip" data-placement="top" title="' . $map . '"><img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/map/map' . $mapid . '.png" width="' . $width . 'px" height="' . $height . 'px" onerror="' . $imgerr . '"/></div>';
    } else {
        return '<img src="http://ddragon.leagueoflegends.com/cdn/' . $ddver . '/img/map/map' . $mapid . '.png" width="' . $width . 'px" height="' . $height . 'px" onerror="' . $imgerr . '" data-toggle="tooltip" data-placement="top" title="' . $map . '"/>';
    }
}

function getRowColorO($col, $h, $l, $a) {
    if ($col == $h) {
        return ' class = "highest"';
    } else if($col == $l) {
        return' class = "lowest"';
    } else if($col >= $a) {
        return ' id = "aboveavg"';
    } else if($col < $a) {
        return ' id = "belowavg"';
    } else {
        return '';
    }
}

function getRowColor($col, $h, $l, $a) {
    if ($col == $h) {
        return 'highest';
    } else if($col == $l) {
        return'lowest';
    } else if($col >= $a) {
        return 'aboveavg';
    } else if($col < $a) {
        return 'belowavg';
    } else {
        return '';
    }
}

function getRowColorI($col, $h, $l, $a) {
    if ($col == $h) {
        return'lowest';
    } else if($col == $l) {
        return 'highest';
    } else if($col >= $a) {
        return 'belowavg';
    } else if($col < $a) {
        return 'aboveavg';
    } else {
        return '';
    }
}

function getRowColorIO($col, $h, $l, $a) {
    if ($col == $h) {
        return ' class = "lowest"';
    } else if($col == $l) {
        return' class = "highest"';
    } else if($col >= $a) {
        return ' id = "belowavg"';
    } else if($col < $a) {
        return ' id = "aboveavg"';
    } else {
        return '';
    }
}

function getItemsIMG($pos, $i1, $i2, $i3, $i4, $i5, $i6, $in1, $in2, $in3, $in4, $in5, $in6, $ddver='6.5.1', $width=20, $height=20) {
    $items = array();
    $names = array();

    if($i1 != 0) {
        array_push($items, $i1);
        array_push($names, $in1);
    }
    if($i2 != 0) {
        array_push($items, $i2);
        array_push($names, $in2);
    }
    if($i3 != 0) {
        array_push($items, $i3);
        array_push($names, $in3);
    }
    if($i4 != 0) {
        array_push($items, $i4);
        array_push($names, $in4);
    }
    if($i5 != 0) {
        array_push($items, $i5);
        array_push($names, $in5);
    }
    if($i6 != 0) {
        array_push($items, $i6);
        array_push($names, $in6);
    }

    $string = '';

    if($pos == 'top') {
        for($i=0;$i<3;$i++) {
            if($items[$i] != 0) {
                $string .= getItemIMG($items[$i], $names[$i], $ddver, $width, $height);
            }
        }
    } else if($pos == 'bot') {
        for($i=3;$i<6;$i++) {
            if($items[$i] != 0) {
                $string .= getItemIMG($items[$i], $names[$i], $ddver, $width, $height);
            }
        }
    } else if($pos == 'all') {
        for($i=0;$i<6;$i++) {
            if($items[$i] != 0) {
                $string .= getItemIMG($items[$i], $names[$i], $ddver, $width, $height);
            }
        }
    }

    return $string;
}

function addS($num) {
    if($num == 1) {
        return '';
    } else {
        return 's';
    }
}

function getCorrectLane($game, $i, $noinfiniteloop=true) {
    $player = (array)$game['participants'][$i];
    $lane = '';

    if ($player['timeline']['lane'] == 'TOP') { //The player's lane is top, no need to check any further. Scratch that, apparently camping fucks this shit up.
        if($player['timeline']['role'] == 'SOLO') { //Role is solo, everything is fine. They're the toplaner.
            $lane = 'Top';
        } else if($player['timeline']['role'] == 'DUO_CARRY') { //Looks like someone has a tent set up. Carry is gonna be the real toplaner.
            $lane = 'Top';
        } else if($player['timeline']['role'] == 'DUO_SUPPORT') { //Looks like someone has a tent set up. This support of a jungler is a bitch and is getting jungle.
            $lane = 'Jungle';
        }
    } else if ($player['timeline']['lane'] == 'JUNGLE') { //The player's lane is jungle, no need to check any further. Scratch that, afking might cause riot to think you're jungling...
        if($player['spell1Id'] == 11 || $player['spell2Id'] == 11) { //The player took smite, so throw him into the jungle I guess.
            $lane = 'Jungle';
        } else if(($player['stats']['neutralMinionsKilled']*2) > $player['stats']['minionsKilled']) { //If jungler forgot to take smite, but is still the jungler.
            $lane = 'Jungle';
        } else { //If no smite, need to throw him into a free lane/role.
            if($noinfiniteloop) {
                $lane = getUnusedLane($game, $game['participants'][$i]['teamId']);
            } else {
                $lane = 'Jungle';
            }
        }
    } else if ($player['timeline']['lane'] == 'MID' || $player['timeline']['lane'] == 'MIDDLE') { //The player's lane is mid, no need to check any further. Scratch that, apparently camping fucks this shit up.
        if($player['timeline']['role'] == 'SOLO') { //Role is solo, everything is fine. They're the midlaner.
            $lane = 'Mid';
        } else if($player['timeline']['role'] == 'DUO_CARRY') { //Looks like someone has a tent set up. Carry is gonna be the real midlaner.
            $lane = 'Mid';
        } else if($player['timeline']['role'] == 'DUO_SUPPORT') { //Looks like someone has a tent set up. This support of a jungler is a bitch and is getting jungle.
            $lane = 'Jungle';
        }
    } else if ($player['timeline']['lane'] == 'BOTTOM' || $player['timeline']['lane'] == 'BOT') { //The player's lane is bot, now we need to check if they were the adc or support:
        if ($player['timeline']['role'] == 'DUO_CARRY') { //The player's role is the carry, he is the adc.
            $lane = 'ADC';
        } else if ($player['timeline']['role'] == 'DUO_SUPPORT') { //The player's role is the support, he is the support.
            $lane = 'Support';
        } else if ($player['timeline']['role'] == 'DUO') { //The player's role is simply 'DUO'. Could mean that they shared the cs at botlane. Or a legendary botlane combo, Koppa.
            foreach($game['participants'] as $participant) { //Loop through all the participants to find the player's duo.
                if($player['championId'] != $participant['championId'] && $participant['teamId'] == $player['teamId'] && $participant['timeline']['role'] == $player['timeline']['role']) { //Found the duo.

                    //echo $player['championId'].' - CS: '.($player['stats']['minionsKilled']+$player['stats']['minionsKilled']).' | ';
                    //echo $participant['championId'].' - CS: '.($participant['stats']['minionsKilled']+$participant['stats']['minionsKilled']).'<br>';

                    if($player['stats']['minionsKilled']+$player['stats']['minionsKilled'] > $participant['stats']['minionsKilled']+$participant['stats']['minionsKilled']) { //The player has more farm than his duo. Give him the ADC status.
                        $lane = 'ADC';
                        break;
                    } else { //The player has less cs than his duo, give that hoe the support status.
                        $lane = 'Support';
                        break;
                    }
                } else { //No duo.. fuck him, he gets support.
                    $lane = 'Support';
                }
            }
        } else if ($player['timeline']['role'] == 'SOLO') { //So looks like the ADC or Support is afk..
            if(isChampionADC($player['championId'])) { //Gay way to check, but w.e.
                $lane = 'ADC';
            } else {
                $lane = 'Support';
            }
        }
    }  else { //The player's lane is neither TOP, JUNGLE, MID, MIDDLE, or BOTTOM. Need to do some checks to determine the correct lane:
        if($player['spell1Id'] == 11 || $player['spell2Id'] == 11) { //The player took smite, so throw him into the jungle I guess.
            $lane = 'Jungle';
        } else { //Get the lane that the champion is supposed to be in.
            $lane = getChampionLane($player['championId']);
        }
    }

    if($lane!='Top'&&$lane!='Jungle'&&$lane!='Mid'&&$lane!='ADC'&&$lane!='Support') { //If no correct lane was found, assign from db:
        $lane = getChampionLane($player['championId']);
    }

    return $lane;
}

function getUnusedLane($game, $team) {
    $lane = 'TopJungleMidADCSupport';

    for($i=0; $i<count($game['participants']); $i++) { //Loop through all the participants.
        if($team == $game['participants'][$i]['teamId']) { //Only check the player's team.
            if(getCorrectLane($game, $i, false) == 'Top') {
                $lane = str_replace('Top', '', $lane);
            } else if(getCorrectLane($game, $i, false) == 'Jungle') {
                $lane = str_replace('Jungle', '', $lane);
            } else if(getCorrectLane($game, $i, false) == 'Mid') {
                $lane = str_replace('Mid', '', $lane);
            } else if(getCorrectLane($game, $i, false) == 'ADC') {
                $lane = str_replace('ADC', '', $lane);
            } else if(getCorrectLane($game, $i, false) == 'Support') {
                $lane = str_replace('Support', '', $lane);
            }
        }
    }

    return $lane;
}

function getChampionLane($id) {
//    echo 'getting champion lane from id';
    global $password;
    $conn = new PDO('mysql:host=localhost;dbname=7bot', 'root', $password);
    $query = 'SELECT id, lane1 FROM champions WHERE id='.$id;
    $result = $conn->prepare($query);
    $result->execute();
    $lane = $result->fetchAll()[0]['lane1'];
    $conn = null;
    return $lane;
}

function getEnemyChampionID($game, $myid) {
    $enemyid = 0;
    for($i=0; $i<count($game['participants']); $i++) { //Loop through all the participants.
        //echo '<div class="query">'.$i.' Looping...</div>';
        if($myid != $i) { //If the participant isn't me.
        //echo '<div class="query">'.$i.' ID is not me.</div>';
            if($game['participants'][$myid]['teamId'] != $game['participants'][$i]['teamId']) { //If the participant isn't on my team.
            //echo '<div class="query">'.$i.' Participant isnt on my team.</div>';
                if(getCorrectLane($game, $myid) == getCorrectLane($game, $i)) { //Checks if the lane is the same as me.
                //echo '<div class="query">'.$i.' Found correct lane.</div>';
                    $enemyid = $game['participants'][$i]['championId'];
                }
            }
        }
    }
    return $enemyid;
}

//Very gay way to check. Sort of meta relevant. But only gets called in gay situations. So we gucci.
function isChampionADC($id) {
    if($id ==   6 || $id ==  15 || $id ==  15 || $id ==  18 ||
       $id ==  21 || $id ==  22 || $id ==  29 || $id ==  42 ||
       $id ==  51 || $id ==  67 || $id ==  81 || $id ==  82 ||
       $id == 133 || $id == 202 || $id == 203 || $id == 222 ||
       $id == 236 || $id == 429) {
        return true;
    } else {
        return false;
    }
}

function add0($num) {
    if($num < 10) {
        return '&nbsp';
    } else {
        return '';
    }
}

function getWhenNameAvailable($last, $lvl) {
    $then = new DateTime();
    $then->setTimestamp($last/1000);
    if($lvl == 0) {
        return $then;
    } else if($lvl <= 6) {
        $then->add(new DateInterval('P6M'));
    } else {
        $then->add(new DateInterval('P'.$lvl.'M'));
    }
    return $then;
}

function createNamesTableIfNotExists() {
    return 'CREATE TABLE IF NOT EXISTS names (
            region VARCHAR(5),
            name VARCHAR(30),
            stylized VARCHAR(30),
            lastonline INT,
            available INT,
            checked INT,
            timeschecked INT,
            type VARCHAR(2)
        );';
}

function getDiff($t1, $t2='') {
    $now = new DateTime();
    $then = new DateTime();
    if(!empty($now)) {
        $now->setTimestamp($t2);
    }
    $then->setTimestamp($t1);
    $diff = $now->diff($then);
    if($t1 > $t2) {
        return $diff->days.' days, '.$diff->h.' hours';
    } else {
        return '0 days, 0 hours';
    }
}

function createChampionsTableIfNotExists($region, $id) {
    return 'CREATE TABLE IF NOT EXISTS '.$region.'_'.$id.'_champions (
            championid INT,
            championlevel INT,
            championpoints INT,
            lastplay BIGINT,
            championpointssincelastlevel INT,
            championpointsuntilnextlevel INT,
            chestgranted BOOL
        );';
}

function insertIntoChampions($region, $id, $championid, $championlevel, $championpoints, $lastplay, $championpointssincelastlevel, $championpointsuntilnextlevel, $chestgranted) {
    return 'INSERT INTO '.$region.'_'.$id.'_champions VALUES (
            '.$championid.',
            '.$championlevel.',
            '.$championpoints.',
            '.$lastplay.',
            '.$championpointssincelastlevel.',
            '.$championpointsuntilnextlevel.',
            '.($chestgranted ? 1 : 0).'
        );';
}

function updateChampions($region, $id, $championid, $championlevel, $championpoints, $lastplay, $championpointssincelastlevel, $championpointsuntilnextlevel, $chestgranted) {
    return 'UPDATE '.$region.'_'.$id.'_champions SET
            championlevel='.$championlevel.',
            championpoints='.$championpoints.',
            lastplay='.$lastplay.',
            championpointssincelastlevel='.$championpointssincelastlevel.',
            championpointsuntilnextlevel='.$championpointsuntilnextlevel.',
            chestgranted='.($chestgranted ? 1 : 0).'
            WHERE championid='.$championid.'
        ;';
}

function createLast10TableIfNotExists($region, $id) {
    return 'CREATE TABLE IF NOT EXISTS '.$region.'_'.$id.'_last10 (
            matchid BIGINT,
            gamemode VARCHAR(30),
            gametype VARCHAR(30),
            subtype VARCHAR(30),
            mapid INT,
            championid INT,
            spell1 INT,
            spell2 INT,
            ip INT,
            creation BIGINT,
            lane VARCHAR(20),
            level INT,
            kills INT,
            deaths INT,
            assists INT,
            cs INT,
            gold INT,
            damage INT,
            team VARCHAR(4),
            item0 INT,
            item1 INT,
            item2 INT,
            item3 INT,
            item4 INT,
            item5 INT,
            item6 INT,
            length INT,
            outcome VARCHAR(5)
        );';
}

function insertIntoLast10($region, $id, $matchid, $gamemode, $gametype, $subtype, $mapid, $championid, $spell1, $spell2, $ip, $creation, $lane, $level, $kills, $deaths, $assists,
                          $cs, $gold, $damage, $team, $item0, $item1, $item2, $item3, $item4, $item5, $item6, $length, $outcome) {
    return 'INSERT INTO '.$region.'_'.$id.'_last10 VALUES (
            '.set0IfNull($matchid).',
            "'.$gamemode.'",
            "'.$gametype.'",
            "'.$subtype.'",
            '.set0IfNull($mapid).',
            '.set0IfNull($championid).',
            '.set0IfNull($spell1).',
            '.set0IfNull($spell2).',
            '.set0IfNull($ip).',
            '.set0IfNull($creation).',
            "'.set0IfNull($lane).'",
            '.set0IfNull($level).',
            '.set0IfNull($kills).',
            '.set0IfNull($deaths).',
            '.set0IfNull($assists).',
            '.set0IfNull($cs).',
            '.set0IfNull($gold).',
            '.set0IfNull($damage).',
            "'.$team.'",
            '.set0IfNull($item0).',
            '.set0IfNull($item1).',
            '.set0IfNull($item2).',
            '.set0IfNull($item3).',
            '.set0IfNull($item4).',
            '.set0IfNull($item5).',
            '.set0IfNull($item6).',
            '.set0IfNull($length).',
            "'.$outcome.'"
        );';
}

function getLaneForLast10($pos, $role) {
    $lane = '';
    if($pos == 1) {
        $lane = 'Top';
    } else if($pos == 2) {
        $lane = 'Mid';
    } else if($pos == 3) {
        $lane = 'Jungle';
    } else if($pos == 4) {
        if($role == 1) {
            $lane = 'ADC';
        } else if($role == 2) {
            $lane = 'Support';
        } else if($role == 3) {
            $lane = 'ADC';
        } else if($role == 4) {
            $lane = 'ADC';
        }
    }
    return $lane;
}

function getTeam($id) {
    $team = '';
    if($id == 100) {
        $team = 'Blue';
    } else if($id == 200) {
        $team = 'Red';
    }
    return $team;
}

function getOutcome($bool) {
    $outcome = '';
    if($bool) {
        $outcome = 'Win';
    } else {
        $outcome = 'Loss';
    }
    return $outcome;
}

function set0IfNull($var) {
    if(isset($var)) {
        return $var;
    } else {
        return 0;
    }
}

function createAccountsTableIfNotExists($region) {
    return 'CREATE TABLE IF NOT EXISTS accounts_'.$region.' (
                id INT PRIMARY KEY,
                username VARCHAR(16),
                displayname VARCHAR(16),
                profileicon INT,
                level INT,
                revision BIGINT,
                tier VARCHAR(10),
                division VARCHAR(3),
                lp INT,
                leaguename VARCHAR(36),
                wins INT,
                losses INT,
                lastupdated BIGINT,
                queues VARCHAR(20),
                rank INT
            ) COLLATE utf8_general_ci;';
}

function accountidEquals($accountid) {
    return "CAST(json_extract(data, '$.participantIdentities[0].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[1].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[2].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[3].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[4].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[5].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[6].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[7].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[8].player.summonerId') as CHAR)=$accountid OR
        CAST(json_extract(data, '$.participantIdentities[9].player.summonerId') as CHAR)=$accountid";
}

function udate($format, $time = null) {
    if (!$time) {
        $time = microtime(true);
    }
    // Avoid missing dot on full seconds: (string)42 and (string)42.000000 give '42'
    $time = number_format($time, 6, '.', '');
    return DateTime::createFromFormat('U.u', $time)->format($format);
}

function getQueueString($queue) {
    $queueString = $queue;
    if($queue == 'CUSTOM') {
        $queueString = 'Custom Game';
    } else if($queue == 'NORMAL_5x5_BLIND') {
        $queueString = 'Normal 5v5 (Blind Pick)';
    } else if($queue == 'RANKED_SOLO_5x5') {
        $queueString = 'Ranked Solo 5v5';
    } else if($queue == 'RANKED_PREMADE_5x5') {
        $queueString = 'Ranked Team 5v5';
    } else if($queue == 'BOT_5x5') {
        $queueString = 'Bot Game 5v5';
    } else if($queue == 'NORMAL_3x3') {
        $queueString = 'Normal 3v3 (Blind Pick)';
    } else if($queue == 'RANKED_PREMADE_3x3') {
        $queueString = 'Ranked Team 3v3';
    } else if($queue == 'NORMAL_5x5_DRAFT') {
        $queueString = 'Normal 5v5 (Draft Pick)';
    } else if($queue == 'ODIN_5x5_BLIND') {
        $queueString = 'Odin 5v5 (Blind Pick)';
    } else if($queue == 'ODIN_5x5_DRAFT') {
        $queueString = 'Odin 5v5 (Draft Pick)';
    } else if($queue == 'BOT_ODIN_5x5') {
        $queueString = 'Odin Bot 5v5';
    } else if($queue == 'BOT_5x5_INTRO') {
        $queueString = 'Bot Game 5v5 (Intro)';
    } else if($queue == 'BOT_5x5_BEGINNER') {
        $queueString = 'Bot Game 5v5 (Beginner)';
    } else if($queue == 'BOT_5x5_INTERMEDIATE') {
        $queueString = 'Bot Game 5v5 (Intermediate)';
    } else if($queue == 'RANKED_TEAM_3x3') {
        $queueString = 'Ranked Team 3v3';
    } else if($queue == 'RANKED_TEAM_5x5') {
        $queueString = 'Ranked Team 5v5';
    } else if($queue == 'BOT_TT_3x3') {
        $queueString = 'Bot Game 3v3';
    } else if($queue == 'GROUP_FINDER_5x5') {
        $queueString = 'Team Builder 5v5';
    } else if($queue == 'ARAM_5x5') {
        $queueString = 'Aram';
    } else if($queue == 'ONEFORALL_5x5') {
        $queueString = 'One For All 5v5';
    } else if($queue == 'FIRSTBLOOD_1x1') {
        $queueString = 'Firstblood 1v1';
    } else if($queue == 'FIRSTBLOOD_2x2') {
        $queueString = 'Firstblood 2v2';
    } else if($queue == 'SR_6x6') {
        $queueString = 'Normal 6v6';
    } else if($queue == 'URF_5x5') {
        $queueString = 'URF 5v5';
    } else if($queue == 'ONEFORALL_MIRRORMODE_5x5') {
        $queueString = 'One For All Mirrormode 5v5';
    } else if($queue == 'BOT_URF_5x5') {
        $queueString = 'Bot Urf 5v5';
    } else if($queue == 'NIGHTMARE_BOT_5x5_RANK1') {
        $queueString = 'Nightmare Bots 5v5 (Rank 1)';
    } else if($queue == 'NIGHTMARE_BOT_5x5_RANK2') {
        $queueString = 'Nightmare Bots 5v5 (Rank 2)';
    } else if($queue == 'NIGHTMARE_BOT_5x5_RANK5') {
        $queueString = 'Nightmare Bots 5v5 (Rank 5)';
    } else if($queue == 'ASCENSION_5x5') {
        $queueString = 'Ascension 5v5';
    } else if($queue == 'HEXAKILL') {
        $queueString = 'Hexakill';
    } else if($queue == 'BILGEWATER_ARAM_5x5') {
        $queueString = 'Aram (Bilgewater)';
    } else if($queue == 'KING_PORO_5x5') {
        $queueString = 'King Poro';
    } else if($queue == 'COUNTER_PICK') {
        $queueString = 'Counter Pick';
    } else if($queue == 'BILGEWATER_5x5') {
        $queueString = 'Bilgewater 5v5';
    } else if($queue == 'TEAM_BUILDER_DRAFT_UNRANKED_5x5') {
        $queueString = 'Dynamic Normal 5v5';
    } else if($queue == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
        $queueString = 'Dynamic Ranked 5v5';
    }
    return $queueString;
}

function getSeasonString($season) {
    $seasonString = $season;
    if($season == 'PRESEASON3') {
        $seasonString = 'Pre-Season 3';
    } else if($season == 'SEASON3') {
        $seasonString = 'Season 3';
    } else if($season == 'PRESEASON2014') {
        $seasonString = 'Pre-Season 4';
    } else if($season == 'SEASON2014') {
        $seasonString = 'Season 4';
    } else if($season == 'PRESEASON2015') {
        $seasonString = 'Pre-Season 5';
    } else if($season == 'SEASON2014') {
        $seasonString = 'Season 5';
    } else if($season == 'PRESEASON2016') {
        $seasonString = 'Pre-Season 6';
    } else if($season == 'SEASON2016') {
        $seasonString = 'Season 6';
    }
    return $seasonString;
}

function getOrdinal($num) {
    $str = (string)$num;
    $one = (int)substr($str, strlen($str)-1);
    $ord = '';

    if($one == 1) {
        $ord = 'st';
    } else if($one == 2) {
        $ord = 'nd';
    } else if($one == 3) {
        $ord = 'rd';
    } else {
        $ord = 'th';
    }

    return $ord;
}

function get7BS($lane, $k, $d, $a, $dmg, $gold, $cs, $wardp, $wardd, $pink, $cc) {
    $score = 0;

    $score += ($lane=='Support' ? $k*300 : $k*50);
    $score -= ($d*50);
    $score += ($a*30);
    $score += ($dmg*0.5);
    $score += ($gold*1);
    $score += ($lane=='Support' || $lane=='Jungle' ? $cs*300 : $cs*50);
    $score += ($wardp*50);
    $score += ($wardd*20);
    $score += ($pink*100);
    $score += ($cc*0.10);

    return round($score, 0);
}

function getCorrectTier($tier) {
    return $tier=='Platinum'?'Emerald':$tier;
}

function getQueueCode($queue) {
    $code = $queue;
    if($queue == 'RANKED_SOLO_5x5') {
        $code = 'S';
    } else if($queue == 'RANKED_PREMADE_5x5') {
        $code = 'T5';
    } else if($queue == 'RANKED_PREMADE_3x3') {
        $code = 'T3';
    } else if($queue == 'RANKED_TEAM_3x3') {
        $code = 'T3';
    } else if($queue == 'RANKED_TEAM_5x5') {
        $code = 'T5';
    } else if($queue == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
        $code = 'D';
    }
    return $code;
}

function getQueueCode2($queue) {
    $code = $queue;
    if($queue == 'RANKED_SOLO_5x5') {
        $code = 'Solo/Duo';
    } else if($queue == 'RANKED_PREMADE_5x5') {
        $code = 'Team 5s';
    } else if($queue == 'RANKED_PREMADE_3x3') {
        $code = 'Team 3s';
    } else if($queue == 'RANKED_TEAM_3x3') {
        $code = 'Team 3s';
    } else if($queue == 'RANKED_TEAM_5x5') {
        $code = 'Team 5s';
    } else if($queue == 'TEAM_BUILDER_DRAFT_RANKED_5x5') {
        $code = 'Dynamic';
    }
    return $code;
}

function getSeasonCode($season) {
    $code = $season;
    if($season == 'PRESEASON3') {
        $code = 'P3';
    } else if($season == 'SEASON3') {
        $code = '3';
    } else if($season == 'PRESEASON2014') {
        $code = 'P4';
    } else if($season == 'SEASON2014') {
        $code = '4';
    } else if($season == 'PRESEASON2015') {
        $code = 'P5';
    } else if($season == 'SEASON2015') {
        $code = '5';
    } else if($season == 'PRESEASON2016') {
        $code = 'P6';
    } else if($season == 'SEASON2016') {
        $code = '6';
    }
    return $code;
}

function var_dump_pre($array) {
    foreach ($array as $text) {
        echo '<pre>';
        var_dump($text);
        echo '</pre>';
    }
}

function print_r_pre($text) {
//    foreach ($array as $text) {
        echo '<pre>';
        echo $text;
        echo '</pre>';
//    }
}

function isVowel($c) {
    return $c=='E'||$c=='U'||$c=='I'||$c=='O'||$c=='A'||$c=='e'||$c=='u'||$c=='i'||$c=='o'||$c=='a';
}

function getOose($name) {
    $oose = '';
    $chars = str_split($name);

    foreach($chars as $char) {
        if(isVowel($char)) {
            $oose .= $char;
        } else {
            $oose .= $char;
            break;
        }
    }

    $oose .= 'oose';
    return $oose;
}

function fixP($p) {
    $p = number_format($p, 2);
    $final = $p;
    if($p<10) {
        $final = ''.$p;
    }
    return $final;
}

function getFullMasteryIMG($masteries, $ddver='6.10.1', $width=20, $height=20) {
    $full = '';
    for($i=0; $i<count($masteries); $i++) {
        $full .= getMasteryIMG($masteries[$i]['masteryId'], $masteries[$i]['masteryId'], $ddver);
    }
    return $full;
}

?>