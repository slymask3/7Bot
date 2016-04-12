<?php
$page = 'namechecker';
$pagename = 'Name Checker';
require_once 'header.php';

//<!--<div class="about">-->
//<!--    <h4>Under Construction</h4>-->
//<!--</div>-->

$region = 'na';
if(!empty($_GET['r'])) {
    $region = strtolower($_GET['r']);
}
$name = '';
if(!empty($_GET['name'])) {
    $name = $_GET['name'];
}

$api = new riotapi($region, new FileSystemCache('cache/'));

if(empty($name)) {
    echo '<div class="search-summoner no-summoner">';
    echo '<form action="namechecker.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" placeholder="Enter a Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';

    echo '<div class="div-table-names">';
} else {
    echo '<div class="search-summoner">';
    echo '<form action="namechecker.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key == "r") {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo '<input type="text" class="form-control" name="name" value="'.$username.'" placeholder="Enter a Name.." required />';
    echo '<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>';
    echo '</form>';
    echo '</div>';

    $type = '';
    $typetext = '';

    try {
        $type = 'NC';
        $typetext = 'Requires purchasing a name change to get this name.';
        $id = $api->getSummonerByName(strtolower(str_replace(' ', '', $name)))[strtolower(str_replace(' ', '', $name))]['id'];
        $summoner = $api->getSummoner($id)[$id];
    } catch (Exception $e){
        $type = 'NA';
        $typetext = 'This name has never been taken or recently transfered regions, so it could be taken by creating a new account or purchasing a name change.';
        $summoner['revisionDate'] = ((new DateTime())->getTimestamp())*1000;
        $summoner['name'] = strtolower(str_replace(' ', '', $name));
        $summoner['summonerLevel'] = 0;
    }
//    $now = new DateTime();
//    $then = new DateTime();
//    $then->setTimestamp($summoner['revisionDate']/1000);
//    $ago = $now->diff($then);
//    $days = $ago->days;
//    $hours = $ago->h;

    $diff_lastonline = getDiff($summoner['revisionDate']/1000);
    $diff_available = getDiff(getWhenNameAvailable($summoner['revisionDate'], $summoner['summonerLevel'])->getTimestamp());

    $divnameclass = '';
    if($diff_available == '0 days, 0 hours') {
        $divnameclass = 'id="name-available"';
    } else {
        $divnameclass = 'id="name-taken"';
    }

    echo '<div class="div-name" '.$divnameclass.'>';
    echo '<table>';
    echo '<tr><td>Name: </td><td>'.$summoner['name'].'</td></tr>';
    echo '<tr><td>Current Date:&nbsp;</td><td>'.date('Y/m/d H:i:s').'</td></tr>';
    echo '<tr><td>Last Online: </td><td>'.date('Y/m/d H:i:s', $summoner['revisionDate'] / 1000).' ('.$diff_lastonline.' ago)</td></tr>';
//    $now = new DateTime();
//    $then = getWhenNameAvailable($summoner['revisionDate'], $summoner['summonerLevel']);
//    $ago = $then->diff($now);
    echo '<tr><td>Available on: </td><td>'.date('Y/m/d H:i:s', getWhenNameAvailable($summoner['revisionDate'], $summoner['summonerLevel'])->getTimestamp()).' (in '.$diff_available.')</td></tr>';
    echo '<tr><td>Type: </td><td>'.$type.' ('.$typetext.')</td></tr>';
    echo '</table>';
    echo '</div>';

    echo '<div class="div-table-names">';
    $query = createNamesTableIfNotExists();
    $result = $conn->prepare($query);
    $result->execute();

    $query = 'SELECT * FROM names WHERE region="'.$region.'" AND name="'.strtolower(str_replace(' ', '', $name)).'"';
    $result = $conn->prepare($query);
    $result->execute();
    $timeschecked = $result->fetchAll()[0]['timeschecked'];
    //var_dump_pre($query);

    if($result->rowCount() == 0) {
        $query = 'INSERT INTO names VALUES("'.$region.'", "'.strtolower(str_replace(' ', '', $name)).'", "'.$summoner['name'].'", '.($summoner['revisionDate']/1000).', '.getWhenNameAvailable($summoner['revisionDate'], $summoner['summonerLevel'])->getTimestamp().', '.((new DateTime())->getTimestamp()).', 1, "'.$type.'")';
        $result = $conn->prepare($query);
        $result->execute();
        //var_dump_pre($query);
    } else {
        $query = 'UPDATE names SET lastonline='.($summoner['revisionDate']/1000).', available='.getWhenNameAvailable($summoner['revisionDate'], $summoner['summonerLevel'])->getTimestamp().', checked='.((new DateTime())->getTimestamp()).', timeschecked='.($timeschecked+1).', type="'.$type.'" WHERE region="'.$region.'" AND name="'.strtolower(str_replace(' ', '', $name)).'"';
        $result = $conn->prepare($query);
        $result->execute();
        //var_dump_pre($query);
    }
}

$query = "SELECT * FROM regions WHERE region='".$region."'";
$result = $conn->prepare($query);
$result->execute();
$regionName = $result->fetchAll()[0]['name'];

echo '<h4>Names in '.$regionName.':</h4>';

////////

$order = 5;
if(!empty($_GET['order'])) {
    $order = $_GET['order'];
}
$dir = 'asc';
if(!empty($_GET['dir'])) {
    $dir = $_GET['dir'];
}

$query = 'SELECT COUNT(*) FROM names WHERE region="'.$region.'"';
$result = $conn->prepare($query);
$result->execute();
//var_dump_pre($query);
$numberofgameswithselection = $result->fetchAll()[0][0];

$query = 'SELECT * FROM names WHERE region="'.$region.'" ORDER BY '.$order.' '.$dir;
$result = $conn->prepare($query);
$result->bindParam(':ord', $order, PDO::PARAM_INT);
//$result->bindParam(':dir', $dir, PDO::PARAM_STR, 4);
$result->execute();
//var_dump_pre($query);
$table1 = $result->fetchAll();

$limit = 50;
if(!empty($_GET['limit'])) {
    $limit = $_GET['limit'];
}
$page = 1;
if(!empty($_GET['page'])) {
    $page = $_GET['page'];
}
$limitoffset = '';
if($limit != 0) {
    $limitoffset = ' LIMIT '.$limit.' OFFSET '.($limit*($page-1));
}

$querylimit = $query.$limitoffset;
$resultlimit = $conn->prepare($querylimit);
$resultlimit->execute();
$table = $resultlimit->fetchAll();

/////

echo '<div class="div-names-order-limit">';

echo '<form action="namechecker.php" method="get"> ';
foreach ($_GET as $key => $value) {
    if ($key != "order" && $key != "dir" && $key != 'name') {
        echo "<input type='hidden' name='$key' value='$value'/>";
    }
}
echo '<label for="order">Order By:</label> ';
echo '<select name="order" style="height: 26px;"> ';
echo '<option value="2" '.($order==2 ? 'selected' : '').'>Name</option>';
echo '<option value="4" '.($order==4 ? 'selected' : '').'>Last Online</option>';
echo '<option value="5" '.($order==5 ? 'selected' : '').'>Available</option>';
echo '<option value="6" '.($order==6 ? 'selected' : '').'>Checked</option>';
echo '<option value="7" '.($order==7 ? 'selected' : '').'>Times Checked</option>';
echo '<option value="8" '.($order==8 ? 'selected' : '').'>Type</option>';
echo '</select> ';
echo '<label for="dir">Direction:</label> ';
echo '<select name="dir" style="height: 26px;"> ';
echo '<option value="asc" '.($dir=='asc' ? 'selected' : '').'>Ascending</option>';
echo '<option value="desc" '.($dir=='desc' ? 'selected' : '').'>Descending</option>';
echo '</select> ';
echo '<input type="submit" value="Go" class="btn btn-primary" />';
echo '</form>';

echo '<form action="namechecker.php" method="get" style="float: right;">';
foreach ($_GET as $key => $value) {
    if ($key != "limit" && $key != "page" && $key != 'name') {
        echo "<input type='hidden' name='$key' value='$value'/>";
    }
}
echo '<label for="limit">Limit per Page:</label> ';
echo '<input type="number" name="limit" value="' . $limit . '" style="height: 26px; width:50px" /> ';
echo '<label for="page">Page:</label> ';
echo '<select name="page" style="height: 26px; width:50px">';
$totalpages = ceil($numberofgameswithselection / $limit);
for ($i = 1; $i <= $totalpages; $i++) {
    if ($page == $i) {
        echo '<option value="' . $i . '" selected>' . $i . '</option>';
    } else {
        echo '<option value="' . $i . '">' . $i . '</option>';
    }
}
echo '</select> ';
//echo '<input type="submit" value="Go" style="height: 26px; width:50px" />';
echo '<input type="submit" value="Go" class="btn btn-primary" />';
echo '</form>';

echo '</div>';

//////


echo '<table class="table table-striped" id="tablenames">';
echo '<tbody>';
echo '<tr>
        <td>Name</td>
        <td>Stylized As</td>
        <td>Last Online</td>
        <td>Avaliable On</td>
        <td>Last Checked On</td>
        <td>Times Updated</td>
        <td>Type</td>
        <td>Update</td>
      </tr>';

foreach($table as $row) {
    $trclass = '';
    if($row['name'] == strtolower(str_replace(' ', '', $name))) {
        $trclass = ' class="current-name"';
    }

    echo '<tr'.$trclass.'>';
    echo '<td>'.$row['name'].'</td>';
    echo '<td>'.$row['stylized'].'</td>';
    echo '<td>'.date('Y/m/d H:i:s', $row['lastonline']).'<br>('.getDiff($row['lastonline']).' ago)</td>';
    echo '<td>'.date('Y/m/d H:i:s', $row['available']).'<br>(in '.getDiff($row['available'], $row['checked']).')</td>';
    echo '<td>'.date('Y/m/d H:i:s', $row['checked']).'<br>('.getDiff($row['checked']).' ago)</td>';
    echo '<td>'.$row['timeschecked'].'</td>';
    echo '<td>'.$row['type'].'</td>';
    echo '<td>';
    echo '<form action="namechecker.php" method="get">';
    echo '<input type="hidden" name="r" value="'.$row['region'].'" />';
    echo '<input type="hidden" name="name" value="'.$row['name'].'" />';
    echo '<button type="submit" class="btn btn-success">Update<i class="fa fa-level-up"></i></button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '</div>';

echo '<div class="pages">';
echo '<div class="pageleft">';

if ($page != 1) {
    //echo '<a href="#" class="btn btn-info" role="button"><< First Page</a> ';
    echo '<form action="/namechecker.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key != "page" && $key != 'name') {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo "<input type='hidden' name='page' value='".(1)."'/>";
    echo '<input type="submit" value="<< First Page" class="btn btn-info" />';
    echo '</form> ';
} else {
    echo '<a href="#" class="btn btn-danger disabled" role="button"><< First Page</a> ';
}

if ($page > 1) {
    //echo '<a href="#" class="btn btn-info" role="button">< Previous Page</a>';
    echo '<form action="/namechecker.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key != "page" && $key != 'name') {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo "<input type='hidden' name='page' value='".($page-1)."'/>";
    echo '<input type="submit" value="< Previous Page" class="btn btn-info" />';
    echo '</form>';
} else {
    echo '<a href="#" class="btn btn-danger disabled" role="button">< Previous Page</a>';
}

echo '</div>';
echo '<div class="pageright">';

if ($page != $totalpages) {
    //echo '<a href="#" class="btn btn-info" role="button">Next Page ></a> ';
    echo '<form action="/namechecker.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key != "page" && $key != 'name') {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo "<input type='hidden' name='page' value='".($page+1)."'/>";
    echo '<input type="submit" value="Next Page >" class="btn btn-info" />';
    echo '</form> ';
} else {
    echo '<a href="#" class="btn btn-danger disabled" role="button">Next Page ></a> ';
}

if ($page != $totalpages) {
    //echo '<a href="javascript:gotoPage('.$totalpages.')" class="btn btn-info" role="button">Last Page >></a>';
    echo '<form action="/namechecker.php" method="get">';
    foreach ($_GET as $key => $value) {
        if ($key != "page" && $key != 'name') {
            echo "<input type='hidden' name='$key' value='$value'/>";
        }
    }
    echo "<input type='hidden' name='page' value='$totalpages'/>";
    echo '<input type="submit" value="Last Page >>" class="btn btn-info" />';
    echo '</form>';
} else {
    echo '<a href="" class="btn btn-danger disabled" role="button">Last Page >></a>';
}
//echo '<a href="#" class="btn btn-info" role="button">Link Button</a>';

echo '</div>';
echo '<div class="pagecenter">';

for($i=1; $i<=$totalpages; $i++) {
    if ($i != $page) {
        echo '<form action="/namechecker.php" method="get">';
        foreach ($_GET as $key => $value) {
            if ($key != "page" && $key != 'name') {
                echo "<input type='hidden' name='$key' value='$value'/>";
            }
        }
        echo "<input type='hidden' name='page' value='".($i)."'/>";
        echo '<input type="submit" value="'.$i.'" class="btn btn-info" />';
        echo '</form> ';
    } else {
        echo '<a href="" class="btn btn-danger disabled" role="button">'.$i.'</a> ';
    }
}

echo '</div>';
echo '</div>';

?>

<?php require_once 'footer.php'; ?>