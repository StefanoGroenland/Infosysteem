<!DOCTYPE html>
<html>
    <head>
        <title>Rapporten</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <!--ZOEK FUNCTIE-->
                            <form action="." method="post" class="pure-form" style="float:right;">
                                <input type='hidden' name="action" value="rapporten">
                                <input type='hidden' name="control" value="stage">

                                <label>Rapport nummer</label>
                                <input type="text" class="pure-input-rounded" name="nummer" style="width: 60px;">
                                <label>| Datum</label>
                                <input type="text"  id="datepicker" class="pure-input-rounded" name="datum">

                                <script>
                                    $(function() {
                                        //$( "#datepicker" ).datepicker();
                                        $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                    });
                                </script>

                                <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </form>

                            <h1>Rapporten</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
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
                                                    <a href="./?control=stage&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>"></a>

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
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>