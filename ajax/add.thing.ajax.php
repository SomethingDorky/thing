<?php

require_once '../include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $thingName = $_POST['thing_name'];
    $thingDescription = $_POST['thing_description'];
    
    $stmt = $db->prepare("INSERT INTO things (thing_name, thing_description) VALUES (?, ?)");
    $stmt->bind_param('ss', $thingName, $thingDescription);
    $stmt->execute();
    $stmt->close();
    
    $maxIDResult = $db->query("SELECT MAX(thing_id) as thing_id FROM things");
    $maxIDNumRows = $maxIDResult->num_rows;
    
    while ($row = $maxIDResult->fetch_object()) {
        $thingID = $row->thing_id;
        $result = $thingID;
    }
    
    echo $result;
}

?>