<?php

require_once 'include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $dorkID = $_POST['dork_id'];
    $thingID = $_POST['thing_id'];
    
    $stmt = $db->prepare("INSERT INTO favorite_things (dork_id, thing_id) VALUES (?, ?)");
    $stmt->bind_param('ii', $dorkID, $thingID);
    $stmt->execute();
    $stmt->close();
}

?>