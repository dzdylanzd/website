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
        <div class="uk-width-1-3 Card-Empty">
            <!-- presentatie ding -->
            <div class="uk-position-relative uk-visible-toggle uk-light  uk-width-4-4	uk-margin-bottom" tabindex="-1" uk-slideshow>

                <ul class="uk-slideshow-items ">
                    <li class="Image-Border">
                        <img src="https://via.placeholder.com/150" alt="" uk-cover>
                    </li>
                    <li class="Image-Border">
                        <img  src="https://via.placeholder.com/350" alt="" uk-cover>
                    </li>
                    <li class="Image-Border">
                        <img src="https://via.placeholder.com/450" alt="" uk-cover>
                    </li>
                    <li class="Image-Border">
                        <img src="https://via.placeholder.com/950" alt="" uk-cover>
                    </li>
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

            </div>

            <div class="imagePrevieuw uk-flex">
                <img src="https://via.placeholder.com/150" class="uk-width-1-4 " alt="D" onclick="UIkit.slideshow('.uk-slideshow').show(0);">
                <img src="https://via.placeholder.com/350" class="uk-width-1-4 " alt="D" onclick="UIkit.slideshow('.uk-slideshow').show(1);">
                <img src="https://via.placeholder.com/450" class="uk-width-1-4 " alt="D" onclick="UIkit.slideshow('.uk-slideshow').show(2);">
                <img src="https://via.placeholder.com/950" class="uk-width-1-4 " alt="D" onclick="UIkit.slideshow('.uk-slideshow').show(3);">

            </div>
        </div>
        <div class="Vertical_Line"></div>
        <div class="uk-width-2-3 Card-Empty">
            <div class="uk-flex Bieding">
                <div class="uk-width-1-2">
                    <h1>tekstjes</h1>
                </div>
                <div class="uk-width-1-2">
                    <h1>tekstjejhkgs</h1>
                </div>
            </div>
        </div>

</body>

</html>