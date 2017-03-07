<?php

function getFav() {
    global $db, $dorkID, $thingID;
    
    $stmt = $db->prepare("SELECT * FROM `favorite_things` WHERE `dork_id` = ? and thing_id = ?");
    $stmt->bind_param('ii', $dorkID, $thingID);
    $stmt->execute();
    $stmt->store_result();
    $numrows = $stmt->num_rows;
    $stmt->close();
    
    if ($numrows < 1) {
        $output = "Add To Favorites";
    } else {
        $output = "Remove From Favorites";
    }
    
    return($output);
}

?>