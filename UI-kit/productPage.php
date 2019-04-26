<!DOCTYPE html>
<html>

<head>
        <title>EenmaalAndermaal</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
</head>

<body>
<?php include 'includes\nav-L-M.php'; ?>


<div class="uk-hidden@s">
<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
    <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
       

            <ul class="uk-navbar-nav">
        
                <li><a href="index.php" uk-icon="icon: triangle-left; ratio: 3"></a></li>
                
            </ul>

       
    </nav>
</div>
</div>

<div class="uk-flex">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-4">Item 1</div>
    <div class="streepje"></div>
    <div class="uk-card uk-card-default uk-card-body uk-width-3-4">Item 2</div>
</div>

</body>

</html>