<!-- navigatiebalk Desktop -->

<div class="uk-visible@m sticky ">


    <nav class="uk-navbar-container marginRemove" uk-navbar>
        <div class="uk-navbar-left">
            <div class="uk-navbar-nav">
                <a class=" uk-logo uk-navbar-item logo " href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>

            </div>
        </div>
        <div class="uk-navbar-center">
            <div class="uk-navbar-nav">
                <div class="uk-navbar-item ">
                    <form action="productpage.php">

                        <div class="uk-inline">
                            <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                            <input class="uk-input uk-form-width-large " type="text" name="search" placeholder="Waar bent u naar op zoek?">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="uk-navbar-right">
            <div class="uk-navbar-nav">
                <div class=" uk-navbar-item ">

                    <div class="uk-inline">
                        <button class="uk-button uk-button-primary inlogknop" type="button">Inloggen</button>
                        <div uk-dropdown="mode: click">
                            <form>

                                <div class="uk-margin">
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                        <input class="uk-input" type="text">
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-inline">
                                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                        <input class="uk-input" type="password">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>



                    <div class=" uk-navbar-item "><a href="registreren.php"> <button class="uk-button uk-button-primary uk-margin-right">registreren</button><a>
                    </div>
                </div>
            </div>
    </nav>

</div>
<!-- navigatiebalk Mobile -->
<div class="uk-visible@s uk-hidden@m sticky ">


    <nav class="uk-navbar-container" uk-navbar>

        <div class="uk-navbar-nav">

            <a class=" uk-logo uk-navbar-item logo" href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>

        </div>


        <div class="uk-navbar-nav">
            <div class="uk-navbar-item ">
                <form action="productpage.php">

                    <div class="uk-inline">
                        <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                        <input class="uk-input uk-form-width-medium" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                    </div>
                </form>
            </div>
        </div>


        <div class="uk-navbar-nav">
            <div class=" uk-navbar-item ">
                <button class="uk-button uk-button-primary ">inloggen</button></div>
            <div class=" uk-navbar-item "><button class="uk-button uk-button-primary uk-margin-right">registreren</button>
            </div>
        </div>

    </nav>

</div>


</nav>