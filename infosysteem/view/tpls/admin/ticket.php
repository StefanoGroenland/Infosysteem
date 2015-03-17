<!DOCTYPE html>
<html>
    <head>
        <title>
            AIS - Ticket
        </title>
        <?php include_once("includes/link.php"); ?>

    </head>
    <body class="page-header-fixed bg-1">
    <main>
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height clearfix">

                <div class="widget-content padded clearfix">
                    <main>
                        <ol class="breadcrumb">

                            <li><a href="./?control=admin&action=tickets">Tickets</a></li>
                            <li class="active">Ticket</li>
                            <li><a href="./?control=admin&action=ticketbzk&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>">Bezoek rapport / Escalatie</a></li>


                        </ol>
                        <div class="col-lg-6">

                            <div class="heading bgcolor1">
                                <i class="fa fa-table"></i>Ticket informatie
                            </div>

                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <td>
                                                Ticket nummer
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefId(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Aanmaakdatum
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefAanmaak_datum(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Afspraak datum
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefAfspraak_datum(); ?>



                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                Bezoek datum
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefBezoek_datum(); ?>



                                            </td>

                                        </tr>


                                        <tr>
                                            <td>
                                               Werkzaamheden/Toelichting
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefOpmerking(); ?>



                                            </td>   

                                        </tr>

                                        <tr>
                                            <td>Expert :</td>
                                            
                                                <?php foreach ($gebruikers as $gebruiker): ?>
                                                    <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                                    <td>
                                                        <?php echo $gebruiker->geefNaam(); ?>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="heading bgcolor2">
                                <i class="fa fa-table"></i>Klant informatie
                            </div>

                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <td>
                                                AIS klantnummer
                                            </td>
                                            <td>
                                                <?php echo $klant->geefId(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Naam
                                            </td>
                                            <td>
                                                <?php echo $klant->geefVoornaam(); ?>
                                                <?php echo $klant->geefTussenvoegsel(); ?>
                                                <?php echo $klant->geefAchternaam(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Adres
                                            </td>
                                            <td>
                                                <?php echo $klant->geefStraatnaam(); ?>
                                                <?php echo $klant->geefHuisnummer(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Postcode
                                            </td>
                                            <td>
                                                <?php echo $klant->geefPostcode(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Woonplaats
                                            </td>
                                            <td>
                                                <?php echo $klant->geefWoonplaats(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Telefoonnummer
                                            </td>
                                            <td>
                                                <?php echo $klant->geeftelefoon(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Mobiel
                                            </td>
                                            <td>
                                                <?php echo $klant->geefmobiel(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                E-mail
                                            </td>
                                            <td>
                                                <?php echo $klant->geefEmail(); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!--
                         <div class="col-lg-6">
                            <div class="heading bgcolor2">
                                <i class="fa fa-table"></i>Escalatie Aanmaken
                            </div>

                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <td>
                                              Escalatie :   
                                            </td>
                                            <td>
                                                aangemaakt!
                                            </td>
                                            <td>
                                                knop
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>-->
                </div>
            </div>

        </div>

    </main>

</body>
</html>
