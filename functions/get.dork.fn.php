<?php

// Called in navigation.php

function getDork() {
    global $db, $dorkID;
    
    $sql = "SELECT * from `dorks`";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    
    if ($numrows < 1) {
        return("no_data");
    }
    
    if (!isset($dorkID)) {
        return("no_dork_id");
    }
    
    if (!is_numeric($dorkID)) {
        return("invalid_dork_id");
    }
    
    $stmt = $db->prepare("SELECT * FROM `dorks` WHERE `dork_id` = ?");
    $stmt->bind_param('i', $dorkID);
    $stmt->execute();
    $stmt->store_result();
    $numrows = $stmt->num_rows;
    $stmt->close();
    
    if ($numrows<1) {
        return("invalid_dork_id");
    } else {
        return("dork_id_set");
    }
}
?>