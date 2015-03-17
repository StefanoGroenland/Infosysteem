<!DOCTYPE html>
<html>
    <head>
        <title>Klant</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <ol class="breadcrumb">

                                <li><a href="./?control=stage&action=klanten">Klanten</a></li>
                                <li class="active"><?php echo $klant->geefVoornaam()." "; echo $klant->geefTussenvoegsel()." "; echo $klant->geefAchternaam(); ?></li>

                            </ol>
                            <h1>Klant</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs " style="color:white;">Naam</th>
                                        <th class="hidden-xs " style="color:white;">Adres</th>
                                        <th class="hidden-xs " style="color:white;">Postcode</th>
                                        <th class="hidden-xs " style="color:white;">Woonplaats</th>
                                        <th class="hidden-xs " style="color:white;">Bedrijf</th>
                                        <th class="hidden-xs " style="color:white;">Email</th>
                                        <th class="hidden-xs " style="color:white;">Telefoon</th>
                                        <th class="hidden-xs " style="color:white;">Mobiel</th>
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
                                        <td>
                                            <?php echo $klant->geefBedrijf(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefEmail(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefTelefoon(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefMobiel(); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <br/>
                            <a href="./?control=stage&action=klantWijzigen&klant_id=<?php echo $klant->geefId() ?>">
                                Wijzig klant gegevens
                            </a>

                            <br/><br/>
                            <h1>Tickets</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
                                <thead>
                                <th class="hidden-xs " style="color:white;">Ticket</th>
                                <th class="hidden-xs " style="color:white;">Tijdstip</th>
                                <th class="hidden-xs " style="color:white;">Status</th>
                                <th class="hidden-xs " style="color:white;">Aanmaak datum</th>
                                <th class="hidden-xs " style="color:white;">Afspraak datum</th>
                                <th class="hidden-xs " style="color:white;">Bezoek datum</th>
                                <th class="hidden-xs " style="color:white;">Sluit datum</th>
                                <th class="hidden-xs " style="color:white;">Wijzigen</th>
                                <th class="hidden-xs " style="color:white;">Verwijderen</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($tickets) && !empty($tickets)): ?>
                                        <?php foreach ($tickets as $ticket): ?>
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
                                                <td class="eind_cel">
                                                    <a href="./?control=stage&action=ticketWijzigen&ticket_id=<?php echo $ticket->geefId() ?>&klant_id=<?php echo $klant->geefId(); ?>">
                                                        Wijzigen
                                                    </a>
                                                </td>
                                                <td class="eind_cel">
                                                    <a href="./?control=stage&action=ticketVerwijderen&ticket_id=<?php echo $ticket->geefId() ?>&klant_id=<?php echo $klant->geefId(); ?>" onclick="return confirm('Weet je het zeker?')">
                                                        Verwijderen
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php if (empty($tickets)): ?>  
                                <h3>Geen tickers gevonden</h3>
                            <?php endif; ?>
                            <a href="./?control=stage&action=ticketToevoegen&klant_id=<?php echo $klant->geefId(); ?>">
                                Voeg een nieuw ticket toe
                            </a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>