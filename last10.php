<?php
$page = 'last10';
$pagename = 'Last 10 Games';
require_once 'header.php';
?>
<?php

$region = 'na';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}
$username = '';
if(!empty($_GET['name'])) {
    $username = $_GET['name'];
}

//updatelast10
require_once 'updatelast10.php';

$query = 'SELECT * FROM accounts WHERE username LIKE "' . strtolower(str_replace(' ', '', $username)).'"';
$accres = $conn->prepare($query);
$accres->execute();
$account = $accres->fetchAll()[0];

$displayname = $account['displayname'];
$icon = $account['icon'];
$tier = $account['tier'];
$rank = $account['tier'].' '.$account['division'].' '.$account['lp'].'LP';
$userid = $account['id'];

$s6g = $account['s6'];
$s5g = $account['s5'];
$s4g = $account['s4'];
$s3g = $account['s3'];

$s6dynamic = $account['s6dynamic'];
$s6solo = $account['s6solo'];
$s6team5 = $account['s6team5'];
$s6team3 = $account['s6team3'];

$s5dynamic = $account['s5dynamic'];
$s5solo = $account['s5solo'];
$s5team5 = $account['s5team5'];
$s5team3 = $account['s5team3'];

$s4dynamic = $account['s4dynamic'];
$s4solo = $account['s4solo'];
$s4team5 = $account['s4team5'];
$s4team3 = $account['s4team3'];

$s3dynamic = $account['s3dynamic'];
$s3solo = $account['s3solo'];
$s3team5 = $account['s3team5'];
$s3team3 = $account['s3team3'];

$dbtable = strtoupper($region) . '_' . $account['id'] . '_LAST10';

$id = $account['id'];

if(empty($username)) {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="last10.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '<button type="button" class="btn btn-danger" disabled data-toggle="tooltip" data-placement="top" title="Coming Soon"><i class="fa fa-arrow-circle-o-up"></i> Update</button>';
    echo '</form>';
    echo '</div>';
} else {
    if($accres->rowCount() == 0) {
        echo '<div class="topinfo">';
        echo "No data found for the account '".$username."'. Please click the update button to add this account to the database.";
        echo '</div>';
    }

    $updatetext = 'Update';
    $updatevalue = 'confirm';
    $updatecolor = 'warning';
    if($updatephase == 'confirm') {
        $updatetext = 'Confirm';
        $updatevalue = 'yes';
        $updatecolor = 'danger';
    }

    echo '<div class="updatebutton">';
    echo '<form action="last10.php?r='.$region.'&name='.$username.'" method="post">';
    echo '<input type="hidden" name="update" value="'.$updatevalue.'" />';
    echo '<button type="submit" class="btn btn-'.$updatecolor.'"><i class="fa fa-arrow-circle-o-up"></i> '.$updatetext.'</button>';
    echo '</form></div>';

    if($accres->rowCount() > 0) {
        include 'summonerinfo.php';
    }

    echo '<div class="search-summoner">';
    echo '<form action="last10.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" value="'.$username.'" placeholder="Enter a Summoner\'s Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '<button type="button" class="btn btn-danger" disabled data-toggle="tooltip" data-placement="top" title="Coming Soon"><i class="fa fa-arrow-circle-o-up"></i> Update</button>';
    echo '</form>';
    echo '</div>';

//    echo '<div class="about" style="text-align: center;">';
//    var_dump($table);
//    echo '</div>';

//    $query = "SELECT * FROM ".$dbtable;
//    $result = $conn->prepare($query);
//    $result->execute();
//    $table = $result->fetchAll();
//
//    echo '<table class="table table-striped" id="tablenames">';
//    echo '<tbody>';
//    echo '<tr>';
//    for($i=0; $i<$result->columnCount(); $i++) {
//        echo '<td>'.$result->getColumnMeta($i)['name'].'</td>';
//    }
//    echo '</tr>';
//    foreach($table as $row) {
//        echo '<tr>';
//        for($i=0; $i<$result->columnCount(); $i++) {
//            echo '<td>'.$row[$i].'</td>';
//        }
//        echo '</tr>';
//    }
//    echo '</tbody>';
//    echo '</table>';

    include 'last10table.php';
}


?>
<?php require_once 'footer.php'; ?>