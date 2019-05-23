<div class="uk-hidden@s">
                <nav class="uk-navbar-container uk-flex-center uk-flex-column" uk-navbar>
                    <div class="uk-navbar-nav  uk-flex-center">
                        <a class=" uk-logo uk-navbar-item " href="index.php"><img src="media\logo.png" alt="logo" width=100em></a>
                    </div>
                    <div class="uk-navbar-nav  uk-flex-center">
                        <div class="uk-navbar-item ">
                            <form action="productpage.php">
                                <div class="uk-inline">
                                    <button class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search" type="Submit"></button>
                                    <input class="uk-input" type="text" name="search" placeholder="Waar bent u naar op zoek?">
                                </div>
                            </form>
                            <?php
                            if(!isset( $_SESSION['userId'])){
                           echo' <a class="uk-margin-left" href="inloggen-Mobile.php" uk-icon="icon: user"></a>';
                            }else{
                                echo '<div class="uk-inline">
                                <button class="uk-button uk-button-default" type="button"><span uk-icon="user"></span> </button>
                                <div uk-dropdown="mode: click"><button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-gegevens.php\'">Mijn gegevens</button>
                                <button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-Biedingen.php\'">Mijn biedingen</button>
                                <button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'mijn-Veilingen.php\'">Mijn veilingen</button>
                                <button class="uk-button uk-button-primary uk-margin-right" onclick="window.location.href=\'includes/logout.php\'">uitloggen</button>
                                </div>                                
                                </div>';
                                
                            }
?>
                        </div>
                    </div>
                </nav>
            </div>