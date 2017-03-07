<?php

require_once '../include/connect.inc.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
    $dorkFirst = $_POST['dork_first_name'];
    $dorkLast = $_POST['dork_last_name'];
    $dorkDork = $_POST['dork_dork_name'];
    
    $stmt = $db->prepare("INSERT INTO dorks (dork_first_name, dork_last_name, dork_dork_name) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $dorkFirst, $dorkLast, $dorkDork);
    $stmt->execute();
    $stmt->close();
    
    $maxIDResult = $db->query("SELECT MAX(dork_id) as dork_id FROM dorks");
    $maxIDNumRows = $maxIDResult->num_rows;
    
    while ($row = $maxIDResult->fetch_object()) {
        $dorkID = $row->dork_id;
        $result = $dorkID;
    }
    
    echo $result;
}

?>