<?php

require_once '../include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $dorkID = $_POST['dork_id'];
    $thisField = $_POST['this_field'];
    $newName = $_POST['new_name'];
    
    $stmt = $db->prepare("UPDATE dorks SET $thisField = ? WHERE dork_id = ?");
    $stmt->bind_param('si', $newName, $dorkID);
    $stmt->execute();
    $stmt->close();
}
?>