
                    <?php

                    $sql12 = "select * from Voorwerp where LooptijdEinde < getdate() and IsVeilingGesloten = 0";
                    if ($sth12 = $dbh->prepare($sql12)) {
                        if ($sth12->execute(array())) {
                            if ($alles = $sth12->fetch()) {
                                $sth12->execute(array());
                                while ($alles = $sth12->fetch()) {
                                    $voorwerpNummer = $alles['VoorwerpNummer'];
                                    $_SESSION['PID'] = $voorwerpNummer;
                                    echo '<div class="uk-hidden">'; 
                                    include('includes/timer.php');
                                    echo'</div>';
                                }
                            }
                        }
                    }

                    ?>

                  