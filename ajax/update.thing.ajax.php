<?php

require_once '../include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $thingID = $_POST['thing_id'];
    $thisField = $_POST['this_field'];
    $newData = $_POST['new_data'];
    
    $stmt = $db->prepare("UPDATE things SET $thisField = ? WHERE thing_id = ?");
    $stmt->bind_param('si', $newData, $thingID);
    $stmt->execute();
    $stmt->close();
}

?>