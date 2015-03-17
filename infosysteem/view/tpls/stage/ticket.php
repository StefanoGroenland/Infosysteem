<!DOCTYPE html>
<html>
    <head>
        <title>Tickets</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <h1>Ticket</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
                                <thead>
                                <th class="hidden-xs " style="color:white;">Ticket</th>
                                <th class="hidden-xs " style="color:white;">Tijdstip</th>
                                <th class="hidden-xs " style="color:white;">Status</th>
                                <th class="hidden-xs " style="color:white;">Aanmaak datum</th>
                                <th class="hidden-xs " style="color:white;">Afspraak datum</th>
                                <th class="hidden-xs " style="color:white;">Bezoek datum</th>
                                <th class="hidden-xs " style="color:white;">Sluit datum</th>
                                <th class="hidden-xs " style="color:white;">Gemaakt door</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $ticket->geefId(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ticket->geefTijdstip(); ?>
                                        </td>

                                        <td>
                                            <?php echo $ticket->geefStatus(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ticket->geefAanmaak_datum(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ticket->geefAfspraak_datum(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ticket->geefBezoek_datum(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ticket->geefSluit_datum(); ?>
                                        </td>

                                        <!--GEBRUIKER-->
                                        <?php foreach ($gebruikers as $gebruiker): ?>
                                            <?php if ($ticket->geefAangemaakt_gebruiker_id() === $gebruiker->geefId()): ?>
                                                <td>
                                                    <?php echo $gebruiker->geefNaam(); ?>
                                                </td>
                                            <?php endif; ?>
                                            
                                        <?php endforeach; ?>
                                        <!--EINDE GEBRUIKER-->
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <br/>
                            <a href="./?control=stage&action=ticketWijzigen&ticket_id=<?php echo $ticket->geefId() ?>&klant_id=<?php echo $klant->geefId(); ?>">
                                Wijzig de Ticket
                            </a>
                            <br/><br/>
                            <h1>Klant</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs " style="color:white;">Naam</th>
                                        <th class="hidden-xs " style="color:white;">Adres</th>
                                        <th class="hidden-xs " style="color:white;">Postcode</th>
                                        <th class="hidden-xs " style="color:white;">Woonplaats</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                    </tr>
                                </tbody>
                            </table>
                            <a href="./?control=stage&action=klant&klant_id=<?php echo $klant->geefId(); ?>">
                                Ga naar de klant
                            </a>
                            <br/><br/>
                            <h1>Rapport</h1>    
                            <?php if ($ticket->geefStatus() === 'open'): ?>
                                <h5><a href="./?control=stage&action=rapportToevoegen&ticket_id=<?php echo $ticket->geefId(); ?>">
                                        Ticket sluiten en Rapport maken</a></h5>
                            <?php endif; ?>
                            <?php if ($ticket->geefStatus() === 'gesloten'): ?>
                                <table class="table table-bordered table-striped" id="dataTable1">
                                    <thead>
                                        <tr>
                                            <th class="hidden-xs " style="color:white;">Nummer</th>
                                            <th class="hidden-xs " style="color:white;">Oplossing</th>
                                            <th class="hidden-xs " style="color:white;">Datum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $ticket->geefId(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefRapport(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefRapport_datum(); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="./?control=stage&action=rapportWijzigen&ticket_id=<?php echo $ticket->geefId() ?>">
                                    Wijzig de Rapport
                                </a>
                            <?php endif; ?>
                            <br/><br/>
                            <h1>Escalatie</h1>
                            <?php $escalatie = $ticket->geefEscalatie() ?>
                            <?php if (!empty($escalatie)): ?>
                                <table class="table table-bordered table-striped" id="dataTable1">
                                    <thead>
                                        <tr>
                                            <th class="hidden-xs " style="color:white;">Escalatie</th>
                                            <th class="hidden-xs " style="color:white;">Antwoord</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $ticket->geefEscalatie(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $i = $ticket->geefAntwoord_escalatie();
                                                if (empty($i)):
                                                    ?>
                                                    <?php if ($ticket->geefGebruiker_id() === $_SESSION['gebruiker']->geefId()): ?>
                                                        Er is geen antwoord gegeven<br/>
                                                        <a href="./?control=stage&action=escalatieAntwoordToevoegen&ticket_id=<?php echo $ticket->geefId() ?>"> <img src="./img/toevoegen.png"/>Vul een antwoord in</a>
                                                    <?php endif; ?>
                                                    <?php if ($ticket->geefGebruiker_id() !== $_SESSION['gebruiker']->geefId()): ?>
                                                        Er is geen antwoord gegeven
                                                    <?php endif; ?>
                                                    <?php
                                                endif;
                                                if (!empty($i)) {
                                                    echo $i;
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <?php if (empty($escalatie)): ?>
                                Geen escalatie gevonden<br/>
                                <a href="./?control=stage&action=escalatieToevoegen&ticket_id=<?php echo $ticket->geefId() ?>">
                                    Escalatie aanmaken
                                </a>
                            <?php endif; ?>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
