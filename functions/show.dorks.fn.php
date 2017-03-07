<?php

// Called in navigation.inc.php
// Called in main.inc.php

function showDorks($data) {
    global $db, $dorkID;
    
    switch($data) {
        case "all":
            $stmt = $db->prepare("SELECT * FROM `dorks` ORDER BY `dork_dork_name`");
            $tag = "li";
            break;
        case "current":
            $stmt = $db->prepare("SELECT * FROM `dorks` WHERE `dork_id` = ?");
            $stmt->bind_param('i', $dorkID);
            $tag = "h2";
            break;
        case "others":
            $stmt = $db->prepare("SELECT * FROM `dorks` WHERE `dork_id` != ? ORDER BY dork_dork_name");
            $stmt->bind_param('i', $dorkID);
            $tag = "li";
            break;
        case "get_name":
            $stmt = $db->prepare("SELECT * FROM `dorks` WHERE `dork_id` = ?");
            $stmt->bind_param('i', $dorkID);
            $tag = "h2";
            break;
        case "admin":
            $stmt = $db->prepare("SELECT * FROM `dorks`");
            $tag = "";
            break;
    }
    
    
    $stmt->bind_result($dork_id, $dork_first_name, $dork_last_name, $dork_dork_name);
    $stmt->execute();
    
    $output = "";
    
    if ($tag == "li") {
        $output .= "<ul class='dorks_menu hidden'>";
    }
    
    while ($stmt->fetch()) {
        $dork_id = htmlentities($dork_id, ENT_QUOTES, "UTF-8");
        $dork_first = htmlentities($dork_first_name, ENT_QUOTES, "UTF-8");
        $dork_last = htmlentities($dork_last_name, ENT_QUOTES, "UTF-8");
        $dork_name = htmlentities($dork_dork_name, ENT_QUOTES, "UTF-8");
        
        switch ($data) {
            case "get_name":
                $output .= "<$tag>";
                $output .= "Hello, $dork_name";
                $output .= "</$tag>";
                break;
            case "all"; case "current"; case "others":
                $output .= "<$tag id='dorklist_$dork_id'>";
                $output .= "<a href='index.php?dork=$dork_id'>$dork_name</a>";
                $output .= "</$tag>";
                break;
            case "admin":
                $output .= "<tr id='dork_$dork_id' class='datarow'>";
                $output .= "<td><input class='data' type='text' name='dork_first_name' value='$dork_first'></td>";
                $output .= "<td><input class='data' type='text' name='dork_last_name' value='$dork_last'></td>";
                $output .= "<td><input class='data' type='text' name='dork_dork_name' value='$dork_name'></td>";
                $output .= "<td class='deletecell'><div class='delete hidden'></div></td>";
                $output .= "</tr>";
                break;
        }    
    }
    
    if ($data == "others") {
        $output .= "<$tag class='logout'>";
        $output .= "<a href='index.php'>logout</a>";
        $output .= "</$tag>";   
    }
    
    if ($tag == "li") {
        $output .= "</ul>";
    }
    
    $stmt->close();
    
    return($output);
}

?>