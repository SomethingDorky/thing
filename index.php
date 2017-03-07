<?php

set_include_path('./include' . PATH_SEPARATOR . './functions' );
                 
// Functions
require_once 'get.dork.fn.php';
require_once 'get.thing.fn.php';
require_once 'get.fav.fn.php';
require_once 'show.dorks.fn.php';
require_once 'show.things.fn.php';

// Include
require_once 'connect.inc.php';
require_once 'get.variables.inc.php';
require_once 'head.inc.php';
require_once 'header.inc.php';
require_once 'navigation.inc.php';

if (isset($page)) {
    switch ($page) {
        case "dorks":
            require_once 'admin.dorks.inc.php'; 
            break;
        case "things":
            require_once 'admin.things.inc.php';
            break;
    }
} else {
    require_once 'main.inc.php';
}

require_once 'footer.inc.php';

?>
        
        