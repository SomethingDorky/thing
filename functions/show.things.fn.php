<?php

// Called in main.inc.php

function showThings($data) {
    global $db, $dorkID, $thingID, $getFav;
    
    switch($data) {
        case "favs":
            $stmt = $db->prepare("SELECT * FROM `things` WHERE `thing_id` IN (SELECT `thing_id` FROM `favorite_things` WHERE `favorite_things`.`dork_id` = ?) ORDER BY `thing_id`");
            $stmt->bind_param('i', $dorkID);
            break;
        case "non_favs":
            $stmt = $db->prepare("SELECT * FROM `things` WHERE `thing_id` NOT IN (SELECT `thing_id` FROM `favorite_things` WHERE `favorite_things`.`dork_id` = ?) ORDER BY `thing_id`");
            $stmt->bind_param('i', $dorkID);
            break;
        case "single":
            $stmt = $db->prepare("SELECT * FROM `things` WHERE `thing_id`  = ?");
            $stmt->bind_param('i', $thingID);
            break;
        case "admin":
            $stmt = $db->prepare("SELECT * FROM `things`");
            break;
    }
    
    
    $stmt->bind_result($thing_id, $thing_name, $thing_description);
    $stmt->execute();
    
    $output = "";
    
    while ($stmt->fetch()) {
        $thing_id = htmlentities($thing_id, ENT_QUOTES, "UTF-8");
        $thing_name = htmlentities($thing_name, ENT_QUOTES, "UTF-8");
        $thing_description = htmlentities($thing_description, ENT_QUOTES, "UTF-8");
        
        switch ($data) {
            case "favs":
                $output .= "<li title='$thing_description' id='fav_$thing_id'>";
                $output .= "<a href='index.php?dork=$dorkID&amp;thing=$thing_id'>$thing_name</a>";
                $output .= "</li>";
                break;
            case "non_favs":
                if (file_exists("images/dorkypics/dork$thing_id.jpg")) {
                    $image = "images/dorkypics/dork$thing_id.jpg";
                } else {
                    $image = "images/dorky_thumb.png";
                }
                $output .= "<li id='nonfav_$thing_id'>";
                $output .= "<figure>";
                $output .= "<a href='index.php?dork=$dorkID&amp;thing=$thing_id'>";
                $output .= "<img class='thumbnail' alt='$thing_name' src='$image'>";
                $output .= "</a>";
                $output .= "<figcaption>";
                $output .= "<h3><a href='index.php?dork=$dorkID&amp;thing=$thing_id'>$thing_name</a></h3>";
                $output .= "<div class='description'><p>$thing_description</p></div>";
                $output .= "<div class='add'></div>";
                $output .= "</figcaption>";
                $output .= "</figure>";
                $output .= "</li>";
                break;
            case "single":
                if (file_exists("images/dorkypics/dork$thing_id.jpg")) {
                    $image = "images/dorkypics/dork$thing_id.jpg";
                } else {
                    $image = "images/something_dorky_logo.png";
                }
                
                if ($getFav == "Add To Favorites") {
                    $action = "add";   
                }
                if ($getFav == "Remove From Favorites") {
                    $action = "remove";
                }
                $output .= "<img class='thing_player' alt='$thing_name' src='$image'>";
                $output .= "<h3 class='name'>$thing_name<h3>";
                $output .= "<div class='actions'>";
                $output .= "<div id='single_$thing_id' class='add'>";
                $output .= "<p>$getFav</p>";
                $output .= "</div>";
                $output .= "</div>";
                $output .= "<div class='description'><p>$thing_description</p></div>";
                break;            
            case "admin":
                $output .= "<tr id='thing_$thing_id' class='datarow'>";
                $output .= "<td><input class='data' type='text' name='thing_name' value='$thing_name'></td>";
                $output .= "<td><input class='data description' type='text' name='thing_description' value='$thing_description'></td>";
                $output .= "<td class='deletecell'><div class='delete hidden'></div></td>";
                $output .= "</tr>";
                break;
        }
    }
    
    $stmt->close();
    return($output);
}

?>