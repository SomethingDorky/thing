<?php

// Called in main.inc.php

function getThing() {
    global $db, $thingID;
    
    $sql = "SELECT * FROM `things`";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    
    if ($numrows < 1) {
        return("no_data");
    }

    if (!isset($thingID)) {
        return("no_thing_id");
    }
    
    if (!is_numeric($thingID)) {
        return("invalid_thing_id");
    }
    
    $stmt = $db->prepare("SELECT * FROM `things` WHERE `thing_id` = ?");
    $stmt->bind_param('i', $thingID);
    $stmt->execute();
    $stmt->store_result();
    $numrows = $stmt->num_rows;
    $stmt->close();
    
    if ($numrows<1) {
        return("invalid_thing_id");
    } else {
        return("thing_id_set");
    }
}
?>