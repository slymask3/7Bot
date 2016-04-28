<?php

$cRegion = 'na';
if(!empty($_GET['r'])) {
    $cRegion = $_GET['r'];
}

$cName = '';
if(!empty($_GET['name'])) {
    $cName = strtolower(str_replace(' ', '', str_replace('+', '', str_replace('%20', '', $_GET['name']))));
}

if(!empty($cName)) {
    $cookies_conn = new PDO('mysql:host=localhost;dbname=7bot', 'root', $password);

    $query = 'SELECT username FROM accounts_'.$cRegion.' WHERE username="'.$cName.'"';
    $result = $cookies_conn->prepare($query);
    $result->execute();
    if($result->rowCount() > 0) {
        if (isset($_COOKIE['recent-searches-' . $cRegion])) {
            $current = explode('-', $_COOKIE['recent-searches-' . $cRegion]);

            $i = 0;
            foreach ($current as $name) {
                $name = strtolower(str_replace(' ', '', str_replace('+', '', str_replace('%20', '', $name))));
                if ($name == $cName) {
                    unset($current[$i]);
                }

                $i++;
            }

            $new = $cName;

            foreach ($current as $name) {
                $name = strtolower(str_replace(' ', '', str_replace('+', '', str_replace('%20', '', $name))));
                $new .= '-' . $name;
            }


            setcookie('recent-searches-' . $cRegion, $new, time() + (86400 * 365), '/');
        } else {
            setcookie('recent-searches-' . $cRegion, $cName, time() + (86400 * 365), '/');
        }
        $cookies_conn = null;
    }
}

?>