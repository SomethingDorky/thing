<?php

require_once 'include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $dorkID = $_POST['dork_id'];
    $thingID = $_POST['thing_id'];
    
    $stmt = $db->prepare("DELETE FROM favorite_things WHERE thing_id = ? && dork_id = ?");
    $stmt->bind_param('ii', $thingID, $dorkID);
    $stmt->execute();
    $stmt->close();
}
?>