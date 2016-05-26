<?php
//echo '<div class="div text-center" id="header" style="margin: 0 80px 0 0px;">';
//echo '<h2><img src="http://ddragon.leagueoflegends.com/cdn/6.6.1/img/profileicon/' . $icon . '.png" height="40px" width="40px" class="profileicon" /></h2>&nbsp;&nbsp;';
//echo '<h2 style="margin: 0px" data-text="'.$displayname.' - ">'.$displayname.'</h2>&nbsp;&nbsp;&nbsp;';
//echo '<h2><img src="assets/' . $tier . '.png" height="40px" width="40px" /></h2>';
//echo '<h2 style="margin: 0px" data-text="'.$rank.'">'.$rank.'</h2>';
//echo '</div>';
//echo '<div class="div text-center" id="header" style="padding-bottom: 5px; display:none">';
//echo '<h2>'.$dbtable.'</h2>';
//echo '</div>';

echo '<div class="summonerinfo summonerinfo-'.$account['tier'].'">';
echo '<div class="summonerinfo-icon">';
echo '<div class="image-cropper-icon">';
echo '<img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver_latest.'/img/profileicon/'.$icon.'.png" height="50px" width="50px" />';
echo '</div>';
echo '</div>';
echo '<div class="summonerinfo-name">';
echo $displayname;
echo '</div>';
echo '<div class="summonerinfo-tier">';
echo getCorrectTier($account['tier']).' '.$account['division'].' ('.$account['lp'].' LP)';
echo '</div>';;
//echo '<div class="summonerinfo-progress">';
//echo '<div class="progress">';
//echo '<div class="progress-bar" style="width: '.$account['lp'].'%">';
//echo $account['lp'].' LP';
//echo '</div>';
//echo '</div>';
//echo '</div>';
//echo '<div class="summonerinfo-lp">';
//echo $account['lp'].' LP';
//echo '</div>';
echo '<div class="summonerinfo-tiericon">';
echo '<img src="assets/'.$account['tier'].'.png" height="30px" width="30px" data-toggle="tooltip" data-placement="right" title="'.$rank.'" />';
echo '</div>';
echo '<div class="summonerinfo-update">';
echo '<button class="btn btn-warning" data-toggle="tooltip" data-placement="right" title="Update Summoner Info"><i class="fa fa-arrow-circle-o-up"></i></button>';
echo '</div>';
echo '</div>';

$query39 = "SELECT CAST(json_extract(data, '$.matchCreation') as CHAR), getPInt($accountid, data, '.championId') FROM matches_".$region."_".$seasonCode."
WHERE ".accountidEquals($accountid)." ORDER BY 1 DESC LIMIT 1;";
$result39 = $conn->prepare($query39);
$result39->execute();
$recentchampid = $result39->fetchAll()[0][1];

$query39 = "SELECT id, pic, CAST(skins as CHAR) FROM champions WHERE id=".$recentchampid;
$result39 = $conn->prepare($query39);
$result39->execute();
$table39 = $result39->fetchAll();
$recentchamppic = $table39[0][1];
$skins = json_decode($table39[0][2], true);

$skinid = mt_rand(0, count($skins)-1);

if($result39->rowCount() > 0) {
    echo '
    <style>
    #maincontainer:before {
        background-image: url(http://ddragon.leagueoflegends.com/cdn/img/champion/splash/'.$recentchamppic.'_'.$skins[$skinid]['num'].'.jpg);
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    </style>';
}

echo '<div class="summoner2">';
echo '<img class="summoner2-img-bg" src="assets/border'.$account['tier'].'Full2.png" />';
echo '<div class="summoner2-text">';
echo '<div class="summoner2-inside summoner2-'.$account['tier'].'">';

echo '<div class="summoner2-inside-absolute">';

echo '<div class="summoner2-icon">';
echo '<div class="image-cropper-icon">';
echo '<img src="http://ddragon.leagueoflegends.com/cdn/'.$ddver_latest.'/img/profileicon/'.$icon.'.png" height="50px" width="50px" />';
echo '</div>';
echo '</div>';
//echo '<div class="summoner2-all">';
//echo $displayname.' - ';
//echo getCorrectTier($account['tier']).' '.$account['division'].' ('.$account['lp'].' LP)';
//echo '</div>';
echo '<div class="summoner2-name">';
echo $displayname;
echo '</div>';
echo '<div class="summoner2-tier">';
echo getCorrectTier($account['tier']).' '.$account['division'].' ('.$account['lp'].' LP)';
echo '</div>';
//echo '<div class="summoner2-tiericon">';
//echo '<img src="assets/'.$account['tier'].'.png" height="30px" width="30px" data-toggle="tooltip" data-placement="right" title="'.$rank.'" />';
//echo '</div>';
echo '<div class="summoner2-update">';
echo '<form action="onlyupdateaccount.php" method="get">';
echo '<input type="hidden" name="page" value="'.$page.'" />';
echo '<input type="hidden" name="r" value="'.$region.'" />';
echo '<input type="hidden" name="name" value="'.$account['username'].'" />';
echo '<button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="right" title="Update Summoner Info"><i class="fa fa-arrow-circle-o-up"></i></button>';
echo '</form>';
echo '</div>';

echo '<div class="summoner2-level" data-toggle="tooltip" data-placement="right" title="Level '.$account['level'].'">';
echo $account['level'];
echo '</div>';

$now = new DateTime();
$then = new DateTime();
$then->setTimestamp($account['lastupdated']);
$ago = $now->diff($then);
$days = $ago->days;
$hours = $ago->h;
$min = $ago->i;

echo '<div class="summoner2-lastupdated">';
echo 'Updated '.$days.' day'.addS($days).', '.$hours.' hour'.addS($hours).' and '.$min.' min'.addS($min).' ago';
echo '</div>';

echo '<div class="summoner2-wl">';
echo '<span id="summoner2-wins">'.$account['wins'].'W</span> / <span id="summoner2-losses">'.$account['losses'].'L</span>';//&nbsp;&nbsp;&nbsp;
echo '</div>';

echo '<div class="summoner2-rank" data-toggle="tooltip" data-placement="right" title="Ranking Based on Tier, Division and LP">#'.$account['rank'].'</div>';

echo '</div>';

echo '</div>';
echo '</div>';
echo '</div>';
?>