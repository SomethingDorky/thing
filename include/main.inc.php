<?php
$greeting = showDorks('get_name');
$favThings = showThings('favs');
$nonfavThings = showThings('non_favs');
$getThing = getThing();
$getFav = getFav();

$welcome = "Here are some things you might like.<br>";
$welcome .= "Click on the heart icon to add them to your Favorites.";
$favsTitle = "Favorite Things";
$trashClass = "";
$openTag = "<ul class='non_favs'>";
$welcomeClass = "";

if ($favThings == "") {
    $welcome = "You don't have any Favorite Things yet, so here are some things you might like.<br>";
    $welcome .= "Click on the heart icon to add them to your Favorites.";
    $favsTitle = "No Favorite Things";
    $trashClass = "hidden";
}

if ($nonfavThings=="") {
    $welcome = "You Love Everything!<br>";
    $welcome .= "Drag items on the left to the trash can to remove them from Favorites.";
    $welcomeClass = "no_border_bottom";
}

switch($getThing) {
    case "invalid_thing_id":
        $output .= "<section class='thing_list'>";
        $output .= $greeting;
        $output .= "<p class='welcome'>";
        $output .= "You Dun Goofed!";
        $output .= "</p>";
        $output .= "<ul>";
        $output .= "<li>";
        $output .= "<figure>";
        $output .= "<a href='index.php'><img class='thumbnail' alt='Ooooops' src='images/dorky_thumb.png'>";
        $output .= "</a>";
        $output .= "<figcaption>";
        $output .= "<h3>";
        $output .= "<a href='index.php'>HUH</a>";
        $output .= "<h3>";
        $output .= "<div class='description'>Where Is That Thing?</div>";
        $output .= "</figcaption>";
        $output .= "</figure>";
        $output .= "</li>";
        $output .= "</ul>";
        $output .= "</section>";
        break;
    case "no_thing_id":
        $greeting = showDorks('get_name');
        $output .= "<section class='thing_list'>";
        $output .= $greeting;
        $output .= "<p class='welcome $welcomeClass'>";
        $output .= $welcome;
        $output .= "</p>";
        $output .= "<ul class='non_favs'>";
        $output .= $nonfavThings; 
        $output .= "</ul>";
        $output .= "</section>";
        $output .= "<div class='loader_large hidden'></div>";
        break;
    case "thing_id_set":
        $singleThing = showThings('single');
        $output .= "<section class='thing_single'>";
        $output .= $greeting;
        $output .= "<p class='welcom'>";
        $output .= "Check this thing out!";
        $output .= "</p>";
        $output .= $singleThing;
        $output .= "</section>";
        $output .= "<div class='loader_large hidden'></div>";
        break;
    case "no_data":
        echo "<div class='message alert'>";
        echo "<h2>No Things Present in Database: Add Things Below</h2>";
        echo "</div>";
        include 'admin.things.inc.php';
        include 'footer.inc.php';
        exit;
        break;
    
}

    echo "<nav class='favs_list'>";
    echo "<h2>$favsTitle</h2>";
    echo "<ul class='favs'>";
    echo $favThings;
    echo "</ul>";
    echo "<div class='trash $trashClass'></div>";
    echo "</nav>";

echo $output; ?>