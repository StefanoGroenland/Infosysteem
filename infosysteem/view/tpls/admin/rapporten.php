<!DOCTYPE html>
<html>
    <head>
        <title>Rapporten</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <!--ZOEK FUNCTIE-->
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        
                        <form action="." method="post" class="pure-form zoek" style="float:right;">
                            <input type='hidden' name="action" value="rapporten">
                            <input type='hidden' name="control" value="admin">

                            <label>Rapport nummer</label>
                            <input type="number" class="pure-input-rounded" name="nummer" style="width: 60px;" placeholder="Vul in">
                            <label>| Datum</label>
                            <input type="text"  id="datepicker" class="pure-input-rounded" name="datum"  placeholder="Selecteer datum">

                            <script>
                                $(function() {
                                    //$( "#datepicker" ).datepicker();
                                    $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                });
                            </script>

                            <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </form>
                        <div class="container">

                            <h1>Rapporten</h1>

                            <h3>
                                <?php
                                //maakt de dagen aan in nl woorden
                                $dagen = array("Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag");
                                //echo $dagen[date( "w", strtotime(2014-3-11))];
                                if (isset($datum)) {
                                    echo $dagen[date("w", strtotime($datum))] . ' ';
                                    echo $datum;
                                }
                                ?>
                            </h3>
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                <th class="hidden-xs " style="color:white;">Nr.</th>
                                <th class="hidden-xs " style="color:white;">Oplossing</th>
                                <th class="hidden-xs " style="color:white;">Datum</th>
                                <th class="hidden-xs " style="color:white;">Klant</th>
                                <th class="hidden-xs " style="color:white;">Adres</th>
                                <th class="hidden-xs " style="color:white;">Postcode</th>
                                <th class="hidden-xs " style="color:white;">Woonplaats</th>
                                <th class="hidden-xs " style="color:white;">Expert</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($tickets) && !empty($tickets)): ?>
                                        <?php foreach ($tickets as $ticket): ?>     
                                            <tr class="klikbaar">
                                                <td>
                                                    <a href="./?control=admin&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>"></a>

                                                    <?php echo $ticket->geefId(); ?>
                                                </td>
                                                <td style="width: 40%;">
                                                    <?php echo $ticket->geefRapport(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $ticket->geefRapport_datum(); ?>
                                                </td>
                                                <!--KLANT INFORMATIE-->
                                                <?php foreach ($klanten as $klant): ?>
                                                    <?php if ($ticket->geefKlant_id() === $klant->geefId())://kijkt of het de juiste klant is?>
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
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!--EINDE KLANT INFORMATIE-->
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
                                $('.klikbaar').click(function() {
                                    window.location = $(this).find('a').attr('href');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>