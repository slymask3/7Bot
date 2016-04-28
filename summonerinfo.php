<style>
    .summonerinfo {
        /*width: 532px;*/
        /*height: 79px;*/
        /*background-image: url("assets/borderGold2.png");*/
        /*margin: 0 auto;*/

        display: none;

        position: absolute;
        top: 5px;
        left: 15px;
        padding: 5px;
        border-radius: 15px;
        /*background-image: url('assets/Bronze.png');*/
        /*background-repeat: no-repeat;*/
        /*background: center;*/
        /*opacity: 0.8;*/
        font-size: larger;
        font-family: 'Righteous';
        height: 64px;
        width: 320px;
        /*opacity: 0.9;*/
        /*color: #dddddd;*/
        color: white;
        text-shadow: -1px 0 #1b1b1b, 0 1px #1b1b1b, 1px 0 #1b1b1b, 0 -1px #1b1b1b,
                     -1px -1px #1b1b1b, -1px 1px #1b1b1b, 1px -1px #1b1b1b, 1px 1px #1b1b1b;
                     /*-2px 0 #ff2c2c, 0 2px #ff2c2c, 2px 0 #ff2c2c, 0 -2px #ff2c2c,*/
                     /*-2px -2px #ff2c2c, -2px 2px #ff2c2c, 2px -2px #ff2c2c, 2px 2px #ff2c2c;*/
    }
    .summonerinfo-Unranked {
        background: #4f4f4f;
        background: -webkit-linear-gradient(left top, #333333, #4f4f4f); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #333333, #4f4f4f); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #333333, #4f4f4f); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #333333, #4f4f4f); /* Standard syntax */
        border: 2px #3b3b3b solid;
    }
    .summonerinfo-Bronze {
        background: #9d5300;
        background: -webkit-linear-gradient(left top, #743a00, #be6d00); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #743a00, #be6d00); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #743a00, #be6d00); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #743a00, #be6d00); /* Standard syntax */
        border: 2px #5f2f00 solid;
    }
    .summonerinfo-Silver {
        background: #949494;
        background: -webkit-linear-gradient(left top, #6f6f6f, #a4a4a4); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #6f6f6f, #a4a4a4); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #6f6f6f, #a4a4a4); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #6f6f6f, #a4a4a4); /* Standard syntax */
        border: 2px #585858 solid;
    }
    .summonerinfo-Gold {
        background: #bc9526;
        background: -webkit-linear-gradient(left top, #886d1a, #cfa727); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #886d1a, #cfa727); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #886d1a, #cfa727); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #886d1a, #cfa727); /* Standard syntax */
        border: 2px #7a6019 solid;
    }
    .summonerinfo-Platinum {
        background: #519451;
        background: -webkit-linear-gradient(left top, #376a37, #64ad64); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #376a37, #64ad64); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #376a37, #64ad64); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #376a37, #64ad64); /* Standard syntax */
        border: 2px #2d5b2d solid;
    }
    .summonerinfo-Diamond {
        background: #87aeb7;
        background: -webkit-linear-gradient(left top, #68848d, #9ac7d0); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #68848d, #9ac7d0); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #68848d, #9ac7d0); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #68848d, #9ac7d0); /* Standard syntax */
        border: 2px #424f58 solid;
    }
    .summonerinfo-Master {
        background: #949494;
        background: -webkit-linear-gradient(left top, #6f6d62, #a49f8e); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #6f6d62, #a49f8e); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #6f6d62, #a49f8e); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #6f6d62, #a49f8e); /* Standard syntax */
        border: 2px #5c5a50 solid;
    }
    .summonerinfo-Challenger {
        background: #bc9526;
        background: -webkit-linear-gradient(left top, #2c8386, #bc9526); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #2c8386, #bc9526); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #2c8386, #bc9526); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #2c8386, #bc9526); /* Standard syntax */
        border: 2px #277679 solid;
    }
    /*.summonerinfo:before {*/
        /*position: absolute;*/
        /*!*z-index: -1;*!*/
        /*!*display: block;*!*/
        /*border-radius: 20px;*/
        /*border: 2px #703900 solid;*/
        /*background-color: #9d5300;*/
        /*background-image: url('assets/Bronze.png');*/
        /*background-repeat: no-repeat;*/
        /*opacity: 0.3;*/
    /*}*/
    .summonerinfo-icon {
        position: absolute;
        left: 5px;
        top: 5px;
        /*border-radius: 15px;*/
    }
    .summonerinfo-name {
        position: absolute;
        left: 60px;
        top: 8px;
    }
    .summonerinfo-tier {
        position: absolute;
        left: 60px;
        top: 28px;
    }
    .summonerinfo-lp {
        position: absolute;
        left: 60px;
        top: 45px;
    }
    .image-cropper-icon {
        position: relative;
        overflow: hidden;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        -ms-border-radius: 15px;
        -o-border-radius: 15px;
        border-radius: 15px;
        /*border: 2px #703900 solid;*/
    }
    .image-cropper-icon img {
        display: inline;
        margin: 0 auto;
    }
    .summonerinfo-tiericon {
        position: absolute;
        right: 5px;
        top: 0px;
    }
    .summonerinfo-update {
        position: absolute;
        right: 5px;
        bottom: 5px;
    }
    .summonerinfo-update button {
        height: 25px;
        width: 30px;
        padding: 0;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        -ms-border-radius: 15px;
        -o-border-radius: 15px;
        border-radius: 15px;
    }
    .summonerinfo-progress {
        position: absolute;
        right: 5px;
        bottom: 40px;
    }
    /*.summonerinfo-update:after {*/
        /*content: '';*/
    /*}*/
    .summoner2-border {
        width: 532px;
        height: 79px;
        /*background: url("assets/borderGold2.png");*/
        margin: 0 auto;
        padding: 10px;
        /*z-index: -1;*/
        /*position: absolute;*/
        position: relative;
    }
    .summoner2-border:before {
        /*padding: 10px;*/
        width: 512px;
        height: 59px;
        background: #bc9526;
        position: absolute;
    }
    .summoner2-inside {
        /*width: 512px;*/
        /*height: 59px;*/
        /*!*background: #bc9526;*!*/
        /*z-index: -1;*/
        /*!*position: relative;*!*/
    }

    .summoner2 {
        margin: 0 auto;
        /*width: 532px;*/
        /*height: 79px;*/
        width: 543px;
        height: 84px;

        font-size: larger;
        font-family: 'Righteous';
        color: white;
        text-shadow: -1px 0 #1b1b1b, 0 1px #1b1b1b, 1px 0 #1b1b1b, 0 -1px #1b1b1b,
                     -1px -1px #1b1b1b, -1px 1px #1b1b1b, 1px -1px #1b1b1b, 1px 1px #1b1b1b;
                     /*-2px 0 #ff2c2c, 0 2px #ff2c2c, 2px 0 #ff2c2c, 0 -2px #ff2c2c,*/
                     /*-2px -2px #ff2c2c, -2px 2px #ff2c2c, 2px -2px #ff2c2c, 2px 2px #ff2c2c;*/
    }
    .summoner2 .summoner2-img-bg {
        position: absolute;
        width: 543px;
        height: 84px;
    }
    .summoner2-text {
        position relative;
        width: 543px;
        height: 84px;
        /*padding-top: 12px;*/
        /*padding-bottom: 10px;*/
        /*padding-right: 12px;*/
        /*padding-left: 11px;*/
        padding-top: 12px;
        padding-bottom: 9px;
        padding-right: 12px;
        padding-left: 11px;
    }
    .summoner2-inside {
        width: 521px;
        height: 62px;
        /*background: #bc9526;*/
    }
    .summoner2-inside-absolute {
        width: 521px;
        height: 62px;
        padding: 5px;
        position: absolute;
    }
    .summoner2-Unranked {
        background: #4f4f4f;
        background: -webkit-linear-gradient(left top, #333333, #4f4f4f); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #333333, #4f4f4f); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #333333, #4f4f4f); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #333333, #4f4f4f); /* Standard syntax */
    }
    .summoner2-Bronze {
        background: #9d5300;
        background: -webkit-linear-gradient(left top, #743a00, #be6d00); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #743a00, #be6d00); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #743a00, #be6d00); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #743a00, #be6d00); /* Standard syntax */
    }
    .summoner2-Silver {
        background: #949494;
        background: -webkit-linear-gradient(left top, #6f6f6f, #a4a4a4); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #6f6f6f, #a4a4a4); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #6f6f6f, #a4a4a4); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #6f6f6f, #a4a4a4); /* Standard syntax */
    }
    .summoner2-Gold {
        background: #bc9526;
        background: -webkit-linear-gradient(left top, #886d1a, #cfa727); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #886d1a, #cfa727); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #886d1a, #cfa727); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #886d1a, #cfa727); /* Standard syntax */
    }
    .summoner2-Platinum {
        background: #519451;
        background: -webkit-linear-gradient(left top, #376a37, #64ad64); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #376a37, #64ad64); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #376a37, #64ad64); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #376a37, #64ad64); /* Standard syntax */
    }
    .summoner2-Diamond {
        background: #87aeb7;
        background: -webkit-linear-gradient(left top, #68848d, #9ac7d0); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #68848d, #9ac7d0); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #68848d, #9ac7d0); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #68848d, #9ac7d0); /* Standard syntax */
    }
    .summoner2-Master {
        background: #949494;
        background: -webkit-linear-gradient(left top, #6f6d62, #8aa4a4); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #6f6d62, #8aa4a4); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #6f6d62, #8aa4a4); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #6f6d62, #8aa4a4); /* Standard syntax */
    }
    .summoner2-Challenger {
        background: #bc9526;
        background: -webkit-linear-gradient(left top, #2c8386, #bc9526); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(bottom right, #2c8386, #bc9526); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(bottom right, #2c8386, #bc9526); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to bottom right, #2c8386, #bc9526); /* Standard syntax */
    }
    .summoner2-icon {
        position: absolute;
        left: 8px;
        top: 6px;
        /*border-radius: 15px;*/
    }
    .summoner2-all {
        position: absolute;
        left: 62px;
        top: 13px;
        font-size: x-large;
    }
    /*.summoner2-name {*/
        /*position: absolute;*/
        /*left: 62px;*/
        /*top: 9px;*/
    /*}*/
    /*.summoner2-tier {*/
        /*position: absolute;*/
        /*left: 62px;*/
        /*top: 29px;*/
    /*}*/
    .summoner2-name {
        position: absolute;
        left: 62px;
        top: 3px;
        font-size: x-large;
    }
    .summoner2-tier {
        position: absolute;
        left: 62px;
        top: 25px;
        font-size: x-large;
    }
    .summoner2-lp {
        position: absolute;
        left: 60px;
        top: 45px;
    }
    .image-cropper-icon {
        position: relative;
        overflow: hidden;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        -ms-border-radius: 15px;
        -o-border-radius: 15px;
        border-radius: 15px;
        /*border: 2px #703900 solid;*/
    }
    .image-cropper-icon img {
        display: inline;
        margin: 0 auto;
    }
    .summoner2-tiericon {
        position: absolute;
        right: 5px;
        top: 0px;
    }
    .summoner2-update {
        position: absolute;
        top: 11px;
        right: 10px;
    }
    .summoner2-update button {
        height: 30px;
        width: 30px;
        padding: 0;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        -ms-border-radius: 15px;
        -o-border-radius: 15px;
        border-radius: 15px;
    }
    .summoner2-level {
        position: absolute;
        z-index: 1;
        bottom: 5px;
        left: 40px;
        font-size: small;
    }
    .summoner2-lastupdated {
        position: absolute;
        bottom: 5px;
        right: 10px;
        font-size: x-small;
    }
    .summoner2-wl {
        position: absolute;
        top: 22px;
        right: 45px;
        font-size: small;
    }
    #summoner2-wins {
        color: #008000;
    }
    #summoner2-losses {
        color: #d50000;
    }
    .summoner2-rank {
        position: absolute;
        top: 5px;
        right: 45px;
        font-size: small;
    }
</style>
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