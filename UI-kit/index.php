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

    <div class="main-titel">
        <h1>EenmaalAndermaal</h1>
        <!-- <a href="#"><img src="media/logo.png" alt=logo width=100em></a> -->
    </div>

    <!-- navigatiebalk -->
    <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
        <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">

            <!-- linker gedeelte -->
            <div class="uk-navbar-left">
                <div class="uk-navbar-nav">
                    <a class=" uk-logo uk-navbar-item " href="#"><img src="media\logo.png" alt="logo" width=100em></a>
                    <div class="uk-navbar-item ">
                        <form action="javascript:void(0)">
                            <input class="uk-input uk-form-width-small" type="text" placeholder="Zoeken...">
                            <input class="uk-button uk-button-default" type="Submit" value="Zoeken">
                        </form>
                    </div>
                </div>
            </div>

            <!-- rechter gedeelte -->
            <div class="uk-navbar-right ">
            <div class=" uk-navbar-item ">
            <button class="uk-button uk-button-primary uk-margin-right">inloggen</button>
            <button class="uk-button uk-button-primary uk-margin-right">registreren</button>
            <div>
            </div>


        </nav>
    </div>





    <!-- presentatie ding -->
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">

<ul class="uk-slider-items uk-grid">
    <li class="uk-width-4-4">
        <div class="uk-panel">
            <img src="https://via.placeholder.com/150" alt="">
            <div class="uk-position-center uk-panel"><h1>1</h1></div>
        </div>
    </li>
    <li class="uk-width-4-4">
        <div class="uk-panel">
            <img src="https://via.placeholder.com/150" alt="">
            <div class="uk-position-center uk-panel"><h1>2</h1></div>
        </div>
    </li>
    <li class="uk-width-4-4">
        <div class="uk-panel">
            <img src="https://via.placeholder.com/150" alt="">
            <div class="uk-position-center uk-panel"><h1>3</h1></div>
        </div>
    </li>
    <li class="uk-width-4-4">
        <div class="uk-panel">
            <img src="https://via.placeholder.com/150" alt="">
            <div class="uk-position-center uk-panel"><h1>4</h1></div>
        </div>
    </li>
    <li class="uk-width-4-4">
        <div class="uk-panel">
            <img src="https://via.placeholder.com/150" alt="">
            <div class="uk-position-center uk-panel"><h1>5</h1></div>
        </div>
    </li>
</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
        </div>

        <div class="imagePrevieuw uk-flex uk-flex-center " >
<img  src="https://via.placeholder.com/150"   alt="D" onclick="UIkit.slider('.uk-slider').show(0);">
<img  src="https://via.placeholder.com/150"   alt="D" onclick="UIkit.slider('.uk-slider').show(1);">
<img src="https://via.placeholder.com/150"  alt="D" onclick="UIkit.slider('.uk-slider').show(2);">
<img  src="https://via.placeholder.com/150"  alt="D" onclick="UIkit.slider('.uk-slider').show(3);">

</div>
 
    </div>
<script> UIkit.slider('.uk-slider').show(2) </script>
    
    <div class="footer">
        <p>Footer</p>
    </div>

</body>

</html>