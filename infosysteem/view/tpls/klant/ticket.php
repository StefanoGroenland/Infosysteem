<!DOCTYPE html>
<html>
    <head>
        <title>Tickets</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <?php include_once("includes/topNavigatie.php"); ?>
                        <main>
                            <h1>Ticket</h1>
                            <div class="informatie">
                                <h2>
                                    Ticket informatie
                                </h2>
                                <table class="table table-bordered table-striped" id="dataTable1">
                                    <tr>
                                        <td>
                                            Aanmaak datum</td>
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
                                            Sluit datum
                                        </td>
                                        <td>
                                            <?php echo $ticket->geefSluit_datum(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Opmerking
                                        </td>
                                        <td>
                                            <textarea disabled=""><?php echo $ticket->geefOpmerking(); ?>
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ticket nummer</td>
                                        <td>
                                            <?php echo $ticket->geefId(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>tijdstip</td>
                                        <td>
                                            <?php echo $ticket->geefTijdstip(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>status</td>
                                        <td>
                                            <?php echo $ticket->geefStatus(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Aanmaak datum</td>
                                        <td>
                                            <?php echo $ticket->geefAanmaak_datum(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Afspraak datum</td>
                                        <td>
                                            <?php echo $ticket->geefAfspraak_datum(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bezoek datum</td>
                                        <td>
                                            <?php echo $ticket->geefBezoek_datum(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sluit datum</td>
                                        <td>
                                            <?php echo $ticket->geefSluit_datum(); ?>
                                        </td>
                                    </tr>
                                    <!--GEBRUIKER-->
                                    <?php foreach ($gebruikers as $gebruiker): ?>
                                        <?php if ($ticket->geefAangemaakt_gebruiker_id() === $gebruiker->geefId()): ?>
                                            <tr>
                                                <td>Maker</td>
                                                <td>
                                                    <?php echo $gebruiker->geefNaam(); ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                            <tr>    
                                                <td>Expert</td>
                                                <td>
                                                    <?php echo $gebruiker->geefNaam(); ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <!--EINDE GEBRUIKER-->
                                </table>
                                <br>
                            </div>

                            <div class="informatie">
                                <h2>
                                    Klant informatie
                                </h2>
                                <table class="table table-bordered table-striped" id="dataTable1">
                                    <tr>
                                        <td>klant nummer</td>
                                        <td>
                                            <?php echo $klant->geefId(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Voornaam</td>
                                        <td>
                                            <?php echo $klant->geefVoornaam(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tussenvoegsel</td>
                                        <td>
                                            <?php echo $klant->geefTussenvoegsel(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Achternaam</td>
                                        <td>
                                            <?php echo $klant->geefAchternaam(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Straat</td>
                                        <td>
                                            <?php echo $klant->geefStraatnaam(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>huisnummer</td>
                                        <td>
                                            <?php echo $klant->geefHuisnummer(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Postcode</td>
                                        <td>
                                            <?php echo $klant->geefPostcode(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Woonplaats</td>
                                        <td>
                                            <?php echo $klant->geefWoonplaats(); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="break" style="border-bottom: 1px solid #e4e4e4;"></div>

                            <div class="informatie">
                                <h2>
                                    Rapport informatie
                                </h2>
                                <?php if ($ticket->geefStatus() === 'open'): ?>
                                    <h5><a href="./?control=admin&action=rapportToevoegen&ticket_id=<?php echo $ticket->geefId(); ?>">
                                            <img src="./img/toevoegen.png"/>Ticket sluiten en Rapport maken</a></h5>
                                <?php endif; ?>
                                <?php if ($ticket->geefStatus() === 'gesloten'): ?>
                                    <table class="table table-bordered table-striped" id="dataTable1">
                                        <tbody>
                                            <tr>
                                                <td>Nummer</td>
                                                <td>
                                                    <?php echo $ticket->geefId(); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oplossing</td>
                                                <td>
                                                    <textarea disabled=""><?php echo $ticket->geefRapport(); ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Datum</d>
                                                <td>
                                                    <?php echo $ticket->geefRapport_datum(); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                <?php endif; ?>
                            </div>
                            <div class="informatie">
                                <h2>Escalatie</h2>
                                <?php $escalatie = $ticket->geefEscalatie() ?>
                                <?php if (!empty($escalatie)): ?>
                                    <table class="table table-bordered table-striped" id="dataTable1">
                                        <tbody>
                                            <tr>
                                                <td>Escalatie</td>
                                                <td>
                                                    <?php echo $ticket->geefEscalatie(); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Antwoord</td>
                                                <td>
                                                    <?php $i = $ticket->geefAntwoord_escalatie();
                                                    if (empty($i)):
                                                        ?>
                                                        <?php if ($ticket->geefGebruiker_id() === $_SESSION['gebruiker']->geefId()): ?>
                                                            Er is geen antwoord gegeven<br/>
                                                        <?php endif; ?>
                                                        <?php if ($ticket->geefGebruiker_id() !== $_SESSION['gebruiker']->geefId()): ?>
                                                            Er is geen antwoord gegeven
                                                        <?php endif; ?>
    <?php endif;
    if (!empty($i)) {
        echo $i;
    } ?>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
<?php endif; ?>
<?php if (empty($escalatie)): ?>
                                   <br/>
<?php endif; ?>
                            </div>
                            <div class="break"></div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
