<?php ob_start();
$page = 'index';
$pagename = 'Updating Summoner';
require_once 'header.php';

include_once 'updateaccount.php';
header('Location: '.$_GET['page'].'.php?r='.$_GET['r'].'&name='.$_GET['name']);

require_once 'footer.php';
ob_flush(); ?>