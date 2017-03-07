<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/somethingdorky/include/connect.inc.php';

require_once '/somethingdorky/include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $dorkID = $_POST['dork_id'];
    
    $stmt = $db->prepare("DELETE FROM favorite_things WHERE dork_id = ?");
    $stmt->bind_param('i', $dorkID);
    $stmt->execute();
    $stmt->close();
    
    $stmt = $db->prepare("DELETE FROM dorks WHERE dork_id = ?");
    $stmt->bind_param('i', $dorkID);
    $stmt->execute();
    $stmt->close();
}

?>