<?php
$page = 'todo';
$pagename = 'TODO';
require_once 'header.php';
?>

<div class="about">
    <ul>
        <li class="todo-done">name: create original name for the site (7Bot) (Easy Stats) (Easy Ranked Stats) (LolLookup)</li>
        <li class="todo-todo">limit: limit ammounts of games added per ip address?</li>
        <li class="todo-todo">top list: take all info from database to create top list (for each region?)</li>
        <li class="todo-done">new stat: time played ranked</li>
        <li class="todo-done">time estimate: estimated time to add games</li>
        <li class="todo-done">confirm button: confirm to add games</li>
        <li class="todo-done">all seasons tab: merge all tables</li>
        <li class="todo-done">match.php: matches table?</li>
        <li class="todo-done">a way to fix riot api's fuckups with correct lane (add a checker for some things, i.e. no doubles of lanes. if player has smite, then theyre more likely the jungler, etc.)</li>
        <li class="todo-done">pages: limit amount of rows seen at once, customizable by the user</li>
        <li class="todo-done">bring back the stats. on seperate page? more indepth?</li>
        <li class="todo-done">games: update the games table to be skinnier to look better on smaller resolutions.</li>
        <li class="todo-todo">fix the matches and games with 3v3 twisted treeline games.</li>
        <li class="todo-done">add keystones into the games and matches.</li>
        <li class="todo-done">re-add a way to change the user ordering for the table.</li>
        <li class="todo-canc">add a confirm button to match.php</li>
        <li class="todo-todo">convert match.php to grab and set player's info from their own table instead of storing everyones info in the matches table.</li>
        <li class="todo-done">change all the calls to the static riot api to get champion names from their ids. instead use our local champions table. (should speed a lot of shit up) (Update: Sped it up indeed, except had to add manual sleep() or we will exceed the api limit.)</li>
        <li class="todo-done">name checker: check when names will be available. table to store names.</li>
        <li class="todo-todo">fix keystones for previous seasons.</li>
        <li class="todo-todo">current game: add current game page.</li>
        <li class="todo-done">champions: add page for a player's champions, will show champion mastery, etc.</li>
        <li class="todo-todo">add prevention from sql injection</li>
        <li class="todo-done">last10: add a page to track the last 10 games played, any gamemode.</li>
        <li class="todo-done">new matches: instead of adding game data for each summoner and then for the whole match itself, add data to a matches table, then grab a summoner's games by searching with some funky query.</li>
        <li class="todo-todo">clean up all the instances for the new matches.</li>
        <li class="todo-todo">recreate the design for the game div.</li>
    </ul>
</div>

<?php require_once 'footer.php'; ?>