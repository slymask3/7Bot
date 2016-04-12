<?php
$page = 'about';
$pagename = 'About';
require_once 'header.php';
?>

<!--<div class="container">-->
    <div class="about">
        <h4>Introduction</h4>
        <p>
            Welcome to <?php echo $websitename ?>. Here you can find more statistics and information on your ranked games.
            Using the <a href="https://developer.riotgames.com/" target="_blank">Riot API</a> we store your ranked games into our system, so they could be grabbed out quickly when needed.
            We use <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a> for most of our site's styling.
            We use <a href="http://fontawesome.io/" target="_blank">Font Awesome</a> for some of the icons on the site.
            Our logo as well as some of the graphics were created by <a href="http://7bot.lol/index.php?r=&name=zexzah" target="_blank">Zexzah</a>.
            I would also like to give credit to <a href="http://kittyconqueso.deviantart.com/" target="_blank">KittyConQueso</a> for the ward icons used in our match display
            (<a href="http://kittyconqueso.deviantart.com/art/Pink-Ward-Emote-455473659" target="_blank"><img src="assets/ward_pink.png" height="20", width="20"></a>).
            7 Bot started in January of 2016 as a <a href="assets/old_ranked.png" target="_blank">personal local website</a> where I manually added information on my ranked games.
            Then I thought I should try using the Riot API to automatically add information from my ranked games that it could grab, and add my grade, rank, and lp manually.
            The name 7 Bot is an inside joke with my friends; we usually say '7bot' in chat when we get ganked in the bot lane, meaning 7 people are ganking bot.
            The reason I chose the name 7 Bot for the website is because I wanted a unique feel for the name, not being something generic as 'Ranked Games'/'Ranked Lookup'.
            7 Bot isn't endorsed by Riot Games and doesn't reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
        </p>
        <br>
        <h4>Ranked Games</h4>
        <p  style="display: inline;">
            This page is responsible for grabbing a summoner's ranked games and spitting them back out in a neat organizable table with some statistics per game.
            The first row in the table is the average of the contents in the table.
            <div id="aboveavg" style="display: inline;">Green</div> represents that the value is above average in it's column.
            <div id="belowavg" style="display: inline;">Red</div> represents that the value is below average in it's column.
            <div class="highest" style="display: inline;">Bolded Dark Green</div> represents that the value is the highest in it's column.
            <div class="lowest" style="display: inline;">Bolded Dark Red</div> represents that the value is the lowest in it's column.
        </p>
        <br>
        <h4>Statistics</h4>
        <p>
            This page is responsible for displaying certain statistics for a summoner's ranked games.
            Here you will find bar graphs and pie graphs for things such as most played champion, most bought item, most used keystone etc.
        </p>
        <br>
        <h4>Current Game</h4>
        <p>
            todo
        </p>
        <br>
        <h4>Champions</h4>
        <p>
            This page is responsible for grabbing a summoner's champion mastery progress and displaying it accordingly.
            You are able to search for specific champions by name, as well as ordering the champions by points earned, date last played, etc.
        </p>
        <br>
        <h4>Last 10 Games</h4>
        <p>
            todo
        </p>
        <br>
        <h4>Match</h4>
        <p>
            todo
        </p>
        <br>
        <h4>Top List</h4>
        <p>
            todo
        </p>
        <br>
        <h4>Name Checker</h4>
        <p>
            This is page is responsible for collecting information on summoner names. All names searched are added to the system, and are able to be viewed in a table form organized by the name availability date.
        </p>
        <br>
        <h4>Have Some Feedback For Us?</h4>
        <form action="sendfeedback.php" method="post">
            <fieldset>
                <!--<legend>Send Questions</legend>-->
                <div class="form-group">
                    <label for="name">Name (Optional):</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="email">Email (Optional):</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                </div>
                <div class="form-group">
                    <label for="topic">Topic:</label>
                    <select class="form-control" name="topic" id="topic" required>
                    <option value="Question">Question</option>
                    <option value="Issue">Issue</option>
                    <option value="Suggestion">Suggestion</option>
                    <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="question">Message:</label>
                    <textarea class="form-control" name="question" id="question" style="resize: vertical;" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </fieldset>
        </form>
    </div>
<!--</div>-->

<?php require_once 'footer.php'; ?>