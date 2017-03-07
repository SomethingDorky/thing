<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="/somethingdorky/css/reset.css" rel="stylesheet">
        <link href="/somethingdorky/css/style.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>     
        <![endif]-->
        
        <link rel="apple-touch-icon" sizes="180x180" href="/somethingdorky/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/somethingdorky/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/somethingdorky/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/somethingdorky/favicon/manifest.json">
        <link rel="mask-icon" href="/somethingdorky/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinysort/2.3.6/tinysort.min.js"></script>
        
        <?php if (isset($dorkID)) { ?>
            <script>var $dorkID = "<?php echo $dorkID; ?>"</script>
        <?php } ?>
        
        <script src="/somethingdorky/js/dorkyscript.js"></script>
        
        <title>Something Dorky</title>
    </head>