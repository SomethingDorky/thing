<?php
$getDork = getDork();

switch ($getDork) {
    case "no_dork_id":
        $dorkList = showDorks('all');
        $heading = "<h2><a>Dorky Guest</a></h2>";
        $loggedState = "logged_out";
        break;
    case "invalid_dork_id":
        $dorkList = showDorks('all');
        $heading = "<h2><a>Dorky Guest</a></h2>";
        $loggedState = "logged_out";
        break;
    case "dork_id_set":
        $dorkList = showDorks('others');
        $heading = showDorks('current');
        $loggedState = "logged_in";
        break;
    case "no_data":
        $dorkList = "";
        $heading = "<h2><a href='admin.php?page=dorks'>Add Dorks</a></h2>";
        $loggedState = "logged_out";
        break;
}
?>

<nav class="navigation">
    <div class="select_dorks">
        <?php echo $heading ?>
    </div>
    
    <div class="profile <?php echo $loggedState; ?>"></div>
    <div class=" admin_button"></div>
    
    <?php echo $dorkList ?>
        
    <ul class="admin_menu hidden">
        <li><a href="index.php?page=dorks">Manage Dorks</a></li>
        <li><a href="index.php?page=things">Manage Things</a></li>
    </ul>
</nav>

<?php

$output = "";

if ($getDork=="no_dork_id") {
    if (!isset($page)) {
        $output .= "<section class='thing_single'>";
        $output .= "<p class='welcome'>";
        $output .= "Welcome Guest!";
        $output .= "</p>";
        $output .= "<img class='thing_player' alt='Oooooops' src='images/something_dorky_logo.png'>";
        $output .= "<h3>Hi there!<h3>";
        $output .= "<div class='description'>";
        $output .= "This is a test site. Funny things happen around here.";
        $output .= "</div>";    
        $output .= "</section>";
        
        echo $output;
        
        include 'footer.inc.php';
        exit;
    }

    if ($page=="") {
        $output .= "<section class='thing_single'>";
        $output .= "<p class='welcome'>";
        $output .= "Welcome Guest!";
        $output .= "</p>";
        $output .= "<img class='thing_player' alt='Oooooops' src='images/something_dorky_logo.png'>";
        $output .= "<h3>Hello, World!<h3>";
        $output .= "<div class='description'>";
        $output .= "Move Along... Nothing To See Here...<br><br>Click A User To The Right";
        $output .= "</div>";    
        $output .= "</section>";
        
        echo $output;
        
        include 'footer.inc.php';
        exit;
    }
}

if ($getDork=="invalid_dork_id") {
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
    $output .= "<a href='index.php'>WOOF</a>";
    $output .= "<h3>";
    $output .= "<div class='description'>Click A User To The Right</div>";
    $output .= "</figcaption>";
    $output .= "</figure>";
    $output .= "</li>";
    $output .= "</ul>";
    $output .= "</section>";
    
    echo $output;
    
    include 'footer.inc.php';
    exit;
}

if ($getDork=="no_data") {
    echo "<div class='message alert'>";
    echo "<h2>No Dorks in database: Add Dorks Below</h2>";
    echo "</div>";
    include 'admin.dorks.inc.php';
    include 'footer.inc.php';
    exit;
}

?>