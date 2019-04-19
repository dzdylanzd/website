<!DOCTYPE html>
<html>
    <head>
        <title>Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
    </head>
    <body>
    
    <div uk-slider="center: true">

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

    <ul class="uk-slider-items uk-child-width-1-2@s uk-grid">
        <li>
            <div class="uk-card uk-card-default">
                <div class="uk-card-media-top">
                    <img src="images/photo.jpg" alt="">
                </div>
                <div class=" uk-background-secondary uk-card-body">
               jan
               
                </div>
            </div>
        </li>
        <li>
            <div class="uk-card uk-card-default">
                <div class="uk-card-media-top">
                    <img src="images/dark.jpg" alt="">
                </div>
                <div class="uk-background-secondary uk-card-body ">
                    <h3 class="uk-card-title">Headline</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="uk-card uk-card-default">
                <div class="uk-card-media-top">
                    <img src="images/light.jpg" alt="">
                </div>
                <div class=" uk-background-secondary uk-card-body">
                    <h3 class="uk-card-title">Headline</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="uk-card uk-card-default">
                <div class="uk-card-media-top">
                    <img src="images/photo2.jpg" alt="">
                </div>
                <div class="uk-background-secondary uk-card-body">
                    <h3 class="uk-card-title">Headline</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="uk-card uk-card-default">
                <div class="uk-card-media-top">
                    <img src="images/photo3.jpg" alt="">
                </div>
                <div class="uk-background-secondary uk-card-body">
                <button class="uk-button uk-button-default uk-margin" type="button" uk-toggle="target: +">Toggle HTML5 Video</button>

<video controls playsinline hidden uk-video>
    <source src="https://quirksmode.org/html5/videos/big_buck_bunny.mp4" type="video/mp4">
    <source src="https://quirksmode.org/html5/videos/big_buck_bunny.ogv" type="video/ogg">
</video>
                </div>
            </div>
        </li>
    </ul>

    <a class="uk-position-center-left uk-dark uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-light uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

</div>



    </body>
</html>