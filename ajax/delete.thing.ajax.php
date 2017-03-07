<?php

require_once '../include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $thingID = $_POST['thing_id'];
    
    $stmt = $db->prepare("DELETE FROM favorite_things WHERE thing_id = ?");
    $stmt->bind_param('i', $thingID);
    $stmt->execute();
    $stmt->close();
    
    $stmt = $db->prepare("DELETE FROM things WHERE thing_id = ?");
    $stmt->bind_param('i', $thingID);
    $stmt->execute();
    $stmt->close();
}

?>