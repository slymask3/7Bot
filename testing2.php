<?php
$page = 'index';
$pagename = 'Testing';
require_once 'header.php';

echo '<div class="about">';

//$api = new riotapi('na');
$apic = new riotapi('na', new FileSystemCache('cache/'));

$username = 'chilaquiles';

//$id = $api->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))]['id'];
$idc = $apic->getSummonerByName(strtolower(str_replace(' ', '', $username)))[strtolower(str_replace(' ', '', $username))]['id'];
//$game = $api->getMatch($r['matches'][0]['matchId']);
//fucked matches: 2092408242 2101450716 2116476535 1786216420 2084844730 1514926339
//$r = $api->getSummoner($id);
$rc = $apic->getSummoner($idc);

//var_dump_pre($r);
var_dump_pre($rc);

echo '</div>';

require_once 'footer.php';
?>