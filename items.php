<?php
$page = 'items';
$pagename = 'Items';
require_once 'header.php';

$id = 0;
if(!empty($_GET['id'])) {
    $id = $_GET['id'];
}

$query = 'SELECT * FROM versions';
$result = $conn->prepare($query);
$result->execute();
$versions = $result->fetchAll();
//var_dump($query);

$query = 'SELECT * FROM items_'.$versions[0][1].'_'.$versions[0][2].'_'.$versions[0][3].' WHERE id='.$id;
$result = $conn->prepare($query);
$result->execute();
$item = $result->fetchAll()[0];
//var_dump($query);

echo '<div class="about">';

//if($result->rowCount() > 0) {
    echo getItemIMG($item['id'], $item['name'], $versions[0][1].'.'.$versions[0][2].'.'.$versions[0][3], 100, 100);
    echo '<br>';
    echo '<b>Name:</b><br> '.$item['name'];
    echo '<br>';
    echo '<br>';
    echo '<b>Description:</b><br> '.$item['description'];
    echo '<br>';
    echo '<br>';
    echo '<b>Plain Text:</b><br> '.$item['plaintext'];
    echo '<br>';
    foreach($versions as $version) {
        echo getItemIMG($id, $item['name'], $version[1].'.'.$version[2].'.'.$version[3], 20, 20);
    }
//} else {
//    echo 'Item with id \''.$id.'\' was not found.';
//}

echo '</div>'; //about

?>



<?php require_once 'footer.php'; ?>