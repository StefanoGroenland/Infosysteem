<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Navigation -->
        <?php include_once("includes/topNavigatie.php"); ?>
        <!-- End Navigation -->
        <!--ZOEK FUNCTIE-->
        <div class="container">
            
                        <div class="row">
                <div class="col-md-6">
                    <div class="widget-container fluid-height">
                        <div class="heading bgcolor1">
                            <i class="fa fa-list-ul"></i>Nieuws
                        </div>
                        <div class="widget-content padded">
                            <ul>
                                <li>
                                    Lorem ipsum dolor sit amet, consectetuer.
                                </li>
                                <li>
                                    Aliquam tincidunt mauris eu risus.
                                </li>
                                <li>
                                    Vestibulum auctor dapibus neque.
                                </li>
                                <li>
                                    Nunc dignissim risus id metus.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-container fluid-height">
                        <div class="heading bgcolor2">
                            <i class="fa fa-list-ol"></i>Links
                        </div>
                        <div class="widget-content padded">
                            <ol>
                                <li>
                                    Lorem ipsum dolor sit amet, consectetuer.
                                </li>
                                <li>
                                    Aliquam tincidunt mauris eu risus.
                                </li>
                                <li>
                                    Vestibulum auctor dapibus neque.
                                </li>
                                <li>
                                    Nunc dignissim risus id metus.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
            </div>
            <br>
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        
                        <form action="." method="post" class="pure-form" style="float:right;">
                            <input type='hidden' name="action" value="default">
                            <input type='hidden' name="control" value="klant">
                            <label>Datum</label>
                            <input type="text"  id="datepicker" class="pure-input-rounded" name="datum">
                            <script>
                                $(function() {
                                    //$( "#datepicker" ).datepicker();
                                    $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                });
                            </script>
                            <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </form>
                        
                        <h1>Dashboard</h1>
                       
                        <?php
                        //maakt de dagen aan in nl woorden
                        $dagen = array("Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag");
                        //echo $dagen[date( "w", strtotime(2014-3-11))];
                        ?>
                        <h3>
                            <?php echo $dagen[date("w", strtotime($datum))]; ?>
                            <?php echo $datum; ?>
                        </h3>
                        <table class="table table-bordered table-striped" id="dataTable1">
                            <thead>

                            <th class="hidden-xs " style="color:white;">
                                <a href="#"></a>Nr.
                            </th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Tijdstip</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Klant</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Adres</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Postcode</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Woonplaats</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Status</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Aanmaak datum</th>
                            <th class="hidden-xs sorting_disabled" style="color:white;">Afspraak datum</th>
                            <!--<th class="hidden-xs sorting_disabled" style="color:white;">expert</th>-->
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($tickets) && !empty($tickets)): ?>
                                    <?php foreach ($tickets as $ticket): ?>
                                        <tr class="klikbaar">
                                            <td>
                                                <a href="./?control=klant&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>"></a>
                                                <?php echo $ticket->geefId(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefTijdstip(); ?>
                                            </td>
                                            <!--KLANT INFORMATIE-->
                                            <td>
                                                <?php echo $klant->geefVoornaam(); ?>
                                                <?php echo $klant->geefTussenvoegsel(); ?>
                                                <?php echo $klant->geefAchternaam(); ?>
                                            </td>
                                            <td>
                                                <?php echo $klant->geefStraatnaam(); ?>
                                                <?php echo $klant->geefHuisnummer(); ?>
                                            </td>
                                            <td>
                                                <?php echo $klant->geefPostcode(); ?>
                                            </td>
                                            <td>
                                                <?php echo $klant->geefWoonplaats(); ?>
                                            </td>
                                            <!--EIND KLANT INFORMATIE-->
                                            <td>
                                                <?php echo $ticket->geefStatus(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefAanmaak_datum(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefAfspraak_datum(); ?>
                                            </td>
                                            <!--GEBRUIKER-->
                                            <?php foreach ($gebruikers as $gebruiker): ?>
                                                <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                                    <td>
                                                        <?php echo $gebruiker->geefNaam(); ?>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <!--EINDE GEBRUIKER-->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <script>
                            $('tr').click(function() {
                                window.location = $(this).find('a').attr('href');
                            });
                        </script>

                        <?php if (empty($tickets)): ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </main>
</body>
</html>