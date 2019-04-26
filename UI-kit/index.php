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
                    <form action="index.php">

                        <div class="uk-inline">
                            <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                            <input class="uk-input" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                        </div>
                    </form>
                </div>
            </div>


           

        </nav>
    </div>


    


    <!-- presentatie ding -->
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">

        <ul class="uk-slider-items uk-grid">
            <li class="uk-width-4-4">
                <div class="uk-panel">
                    <img src="https://via.placeholder.com/150" alt="">
                    <div class="uk-position-center uk-panel">
                        <h1>1</h1>
                    </div>
                </div>
            </li>
            <li class="uk-width-4-4">
                <div class="uk-panel">
                    <img src="https://via.placeholder.com/150" alt="">
                    <div class="uk-position-center uk-panel">
                        <h1>2</h1>
                    </div>
                </div>
            </li>
            <li class="uk-width-4-4">
                <div class="uk-panel">
                    <img src="https://via.placeholder.com/150" alt="">
                    <div class="uk-position-center uk-panel">
                        <h1>3</h1>
                    </div>
                </div>
            </li>
            <li class="uk-width-4-4">
                <div class="uk-panel">
                    <img src="https://via.placeholder.com/150" alt="">
                    <div class="uk-position-center uk-panel">
                        <h1>4</h1>
                    </div>
                </div>
            </li>
            <li class="uk-width-4-4">
                <div class="uk-panel">
                    <img src="https://via.placeholder.com/150" alt="">
                    <div class="uk-position-center uk-panel">
                        <h1>5</h1>
                    </div>
                </div>
            </li>
        </ul>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
    </div>

    <div class="imagePrevieuw uk-flex uk-flex-center ">
        <img src="https://via.placeholder.com/150" alt="D" onclick="UIkit.slider('.uk-slider').show(0);">
        <img src="https://via.placeholder.com/150" alt="D" onclick="UIkit.slider('.uk-slider').show(1);">
        <img src="https://via.placeholder.com/150" alt="D" onclick="UIkit.slider('.uk-slider').show(2);">
        <img src="https://via.placeholder.com/150" alt="D" onclick="UIkit.slider('.uk-slider').show(3);">

    </div>

    </div>
    <script>
        
        UIkit.slider('.uk-slider').show(2)
    </script>

<div  class="scrollbox">
Efficient honorificabilitudinitatibus 
cross-media information without floccinaucinihilipilification cross-media value. Quickly maximize timely deliverables for real-time schemas plenipotentiary.
Efficient honorificabilitudinitatibus 
cross-media information without floccinaucinihilipilification cross-media value. Quickly maximize timely deliverables for real-time schemas plenipotentiary.
Efficient honorificabilitudinitatibus 
cross-media information without floccinaucinihilipilification cross-media value. Quickly maximize timely deliverables for real-time schemas plenipotentiary.
</div>

    <div class="footer">
        <p>Footer</p>
    </div>

</body>

</html>