<!-- navigatiebalk Desktop -->
<?php session_start(); ?>
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
<?php
if(!isset($_SESSION['userId'])){
    echo' <div class="uk-inline">
    <button class="uk-button uk-button-primary " type="button">Inloggen</button>
    <div uk-dropdown="mode: click">
        <form method="post" action="includes/login.inc.php">

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input" name="gebruikersnaam" type="text">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                    <input class="uk-input" name="wachtwoord" type="password">
                </div>
            </div>
            <button class="loginknop uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button>
        </form>
        <a class="uk-link-muted" href="index.php">Wachtwoord vergeten?</a>';
      
        if (isset($_GET["errorLogin"])) {
            if($_GET["errorLogin"] == "leeg" ){
                echo"<br> er is een veld leeg";
            }
            if($_GET["errorLogin"] == "GebruikerBestaatNiet" ){
                echo"<br> deze gebruiker bestaat niet";
            }
            if($_GET["errorLogin"] == "verkeerdwachtwoord" ){
                echo"<br> verkeerde wachtwoord probeer opnieuw";
            }
            if($_GET["errorLogin"] == "sql" ){
                echo"<br> er ging iets mis probeer opnieuw";
            }
        }
    echo'
    </div>
</div>';
}else{
    echo'<button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button>';
}
?>
                   
                </div>
                <div class="uk-navbar-right">
                    <div class="uk-navbar-nav">
                        <div class=" uk-navbar-item ">

                            <div class=" uk-navbar-item "> <button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href='email-Bevestiging.php'">registreren</button>
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
            <?php
if(!isset($_SESSION['userId'])){
    echo' <div class="uk-inline">
    <button class="uk-button uk-button-primary " type="button">Inloggen</button>
    <div uk-dropdown="mode: click">
        <form method="post" action="includes/login.inc.php">

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input" name="gebruikersnaam" type="text">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                    <input class="uk-input" name="wachtwoord" type="password">
                </div>
            </div>
            <button class="loginknop uk-width-1-1 uk-button uk-button-default " name="login-submit" type="submit">Login</button>
        </form>
        <a class="uk-link-muted" href="index.php">Wachtwoord vergeten?</a>';
      
        if (isset($_GET["errorLogin"])) {
            if($_GET["errorLogin"] == "leeg" ){
                echo"<br> er is een veld leeg";
            }
            if($_GET["errorLogin"] == "GebruikerBestaatNiet" ){
                echo"<br> deze gebruiker bestaat niet";
            }
            if($_GET["errorLogin"] == "verkeerdwachtwoord" ){
                echo"<br> verkeerde wachtwoord probeer opnieuw";
            }
            if($_GET["errorLogin"] == "sql" ){
                echo"<br> er ging iets mis probeer opnieuw";
            }
        }
    echo'
    </div>
</div>';
}else{
    echo'<button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button>';
}
?>
            </div>
            <div class=" uk-navbar-item "><button class="uk-button uk-button-primary uk-margin-right">registreren</button>
            </div>
        </div>

    </nav>

</div>


</nav>