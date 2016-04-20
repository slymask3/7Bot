<style>
    .summonerinfo {
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
    }
    .summonerinfo-Unranked {
        border: 2px #3b3b3b solid;
        background-color: #4f4f4f;
    }
    .summonerinfo-Bronze {
        border: 2px #703900 solid;
        background-color: #9d5300;
    }
    .summonerinfo-Silver {
        border: 2px #797979 solid;
        background-color: #949494;
    }
    .summonerinfo-Gold {
        border: 2px #7a6019 solid;
        background-color: #bc9526;
    }
    .summonerinfo-Platinum {
        border: 2px #386f38 solid;
        background-color: #519451;
    }
    .summonerinfo-Diamond {
        border: 2px #3f7979 solid;
        background-color: #87aeb7;
    }
    .summonerinfo-Master {
        border: 2px #797979 solid;
        background-color: #949494;
    }
    .summonerinfo-Challenger {
        border: 2px #277679 solid;
        background-color: #bc9526;
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
?>