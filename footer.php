<?php $conn = null; ?>
<div class="ad">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px;"
     data-ad-client="ca-pub-1352931870485086"
     data-ad-slot="7593101253"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<?php
if($container) {
    echo '</div>';
}
?>

<footer class="footer">
  <div class="container">
    <p class="text-muted">
        <?php
        echo ($page!='index'?'<a href="index.php?r='.$region.'">Games</a>':'<b>Games</b>').' | ';
        echo ($page!='stats'?'<a href="stats.php?r='.$region.'">Stats</a>':'<b>Stats</b>').' | ';
        echo ($page!='current'?'<a href="current.php?r='.$region.'">Current</a>':'<b>Current</b>').' | ';
        echo ($page!='champions'?'<a href="champions.php?r='.$region.'">Champions</a>':'<b>Champions</b>').' | ';
        echo ($page!='last10'?'<a href="last10.php?r='.$region.'">Last 10</a>':'<b>Last 10</b>').' | ';
        echo ($page!='match'?'<a href="match.php?r='.$region.'">Match</a>':'<b>Match</b>').' | ';
        echo ($page!='toplist'?'<a href="toplist.php?r='.$region.'">Top List</a>':'<b>Top List</b>').' | ';
        echo ($page!='namechecker'?'<a href="namechecker.php?r='.$region.'">Name Checker</a>':'<b>Name Checker</b>').' | ';
        echo ($page!='about'?'<a href="about.php?r='.$region.'">About</a>':'About');
        ?>
    </p>
    <p class="text-muted">
        &copy; 2016 | 7 Bot | All Rights Reserved
    </p>
  </div>
</footer>

<button id="scrollarrow" class="btn btn-info" onclick="window.scrollTo(0,0)"><i class="fa fa-arrow-up"></i></button>

</body>
</html>