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



    <!-- navigatie balk S -->
    <div class="uk-hidden@s">
        <nav class="uk-navbar-container uk-flex-center uk-flex-column" uk-navbar>

            <div class="uk-navbar-nav  uk-flex-center">
                <a class=" uk-logo uk-navbar-item " href="#"><img src="media\logo.png" alt="logo" width=100em></a>

            </div>


            <div class="uk-navbar-nav  uk-flex-center">
                <div class="uk-navbar-item ">
                    <form action="productpage.php">

                        <div class="uk-inline">
                            <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                            <input class="uk-input" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                        </div>
                    </form>
                    <a class="uk-margin-left" href="index.php" uk-icon="icon: user" ></a>
                </div>
                
            </div>




        </nav>
    </div>

    <div class="uk-flex">
    <div class="uk-width-1-5"> <div class="scrollbox">
        Efficient honorificabilitudinitatibus
        cross-media information without floccinaucinihilipilification cross-media value. Quickly maximize timely deliverables for real-time schemas plenipotentiary.
        Efficient honorificabilitudinitatibus
        cross-media information without floccinaucinihilipilification cross-media value. Quickly maximize timely deliverables for real-time schemas plenipotentiary.
        Efficient honorificabilitudinitatibus
        cross-media information without floccinaucinihilipilification cross-media value. Quickly maximize timely deliverables for real-time schemas plenipotentiary.
    </div>


    <?php require_once('includes\catogorie_nav.php'); ?>

</div>
    <div class="uk-width-4-5">Item 2</div>

</div>



   

    <div class="footer">
        <p>Footer</p>
    </div>

</body>

</html>