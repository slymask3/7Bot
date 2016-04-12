<?php
echo '<div class="div text-center" id="header" style="margin: 0 80px 0 0px;">';
echo '<h2><img src="http://ddragon.leagueoflegends.com/cdn/6.6.1/img/profileicon/' . $icon . '.png" height="40px" width="40px" class="profileicon" /></h2>&nbsp;&nbsp;';
echo '<h2 style="margin: 0px" data-text="'.$displayname.' - ">'.$displayname.'</h2>&nbsp;&nbsp;&nbsp;';
echo '<h2><img src="assets/' . $tier . '.png" height="40px" width="40px" /></h2>';
echo '<h2 style="margin: 0px" data-text="'.$rank.'">'.$rank.'</h2>';
echo '</div>';
echo '<div class="div text-center" id="header" style="padding-bottom: 5px; display:none">';
echo '<h2>'.$dbtable.'</h2>';
echo '</div>';

//echo '<link rel="stylesheet" type="text/css" href="mainCSS2.css">';

$query39 = "SELECT matchid, c.pic FROM matches_".$region."_".$seasonCode." LEFT JOIN champions c ON getPInt($accountid, data, '.championId')=c.id
WHERE ".accountidEquals($accountid)." ORDER BY 1 DESC LIMIT 1;";
$result39 = $conn->prepare($query39);
$result39->execute();
$recentchamppic = $result39->fetchAll()[0][1];

//        echo '<pre>';
//        print_r($query39);
//        echo '</pre>';

//        $query40 = "SELECT count(*), c.pic FROM matches_'.$region.' LEFT JOIN champions c ON championid=c.id
//        WHERE
//        CAST(json_extract(data, '$.participantIdentities[0].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[1].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[2].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[3].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[4].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[5].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[6].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[7].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[8].player.summonerId') as CHAR)=$accountid OR
//        CAST(json_extract(data, '$.participantIdentities[9].player.summonerId') as CHAR)=$accountid
//        ORDER BY 1 DESC LIMIT 1;";
//        $result40 = $conn->prepare($query40);
//        $result40->execute();
//        $favchamppic = $result40->fetchAll()[0][1];

if($result39->rowCount() > 0) {
    echo '
    <style>
    #maincontainer:before {
        background-image: url(http://ddragon.leagueoflegends.com/cdn/img/champion/splash/'.$recentchamppic.'_0.jpg);
    }
    </style>';
}
?>