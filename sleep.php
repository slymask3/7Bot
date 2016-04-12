<?php
$page = 'sleep';
$pagename = 'Sleep Test';
require_once 'header.php';

echo '<div class="about">';

for($i=0 ;$i<10; $i++) {
    echo $i.'<br>';
    sleep(1);
}

echo '</div>';

require_once 'footer.php';
?>