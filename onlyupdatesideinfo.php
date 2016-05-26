<?php ob_start();
$page = 'index';
$pagename = 'Updating Stats';
require_once 'header.php';

$region = 'na';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}
$username = '';
if(!empty($_GET['name'])) {
    $username = $_GET['name'];
}
$season = '6';
if(!empty($_GET['s'])) {
    $season = $_GET['s'];
}
$queue = 'dynamic';
if(!empty($_GET['q'])) {
    $queue = $_GET['q'];
}
$accountid = 0;
if(!empty($_GET['accountid'])) {
    $accountid = $_GET['accountid'];
}

$queueCode = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
if($queue == 'dynamic') {
    $queueCode = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
} else if($queue == 'solo') {
    $queueCode = 'RANKED_SOLO_5x5';
} else if($queue == 'team5') {
    $queueCode = 'RANKED_TEAM_5x5';
} else if($queue == 'team3') {
    $queueCode = 'RANKED_TEAM_3x3';
}

$seasonCode = 'SEASON2016';
$preseasonCode = 'PRESEASON2017';
$seasonTable = '2016';
if($season == '6') {
    $seasonCode = 'SEASON2016';
    $preseasonCode = 'PRESEASON2017';
    $seasonTable = '2016';
} else if($season == '5') {
    $seasonCode = 'SEASON2015';
    $preseasonCode = 'PRESEASON2016';
    $seasonTable = '2015';
} else if($season == '4') {
    $seasonCode = 'SEASON2014';
    $preseasonCode = 'PRESEASON2015';
    $seasonTable = '2014';
} else if($season == '3') {
    $seasonCode = 'SEASON3';
    $preseasonCode = 'PRESEASON2014';
    $seasonTable = '2013';
} else if($season == 'merged') {
    $seasonCode = 'MERGED';
}

var_dump($region, $username, $season, $queue, $seasonCode);

include_once 'updatesideinfo.php';
header('Location: '.$_GET['page'].'.php?r='.$_GET['r'].'&name='.$_GET['name']);

require_once 'footer.php';
ob_flush(); ?>