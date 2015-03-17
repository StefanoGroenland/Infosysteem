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
                    <li>
                        <a href="./?control=admin&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>">Ticket</a>
                    </li>
                    <li class="active">Bezoek rapport / Escalatie</li>


                </ol>
                <div class="col-lg-6">

                    <div class="heading bgcolor3">
                        <i class="fa fa-table"></i>Kantoor
                    </div>
                    <?php if ($ticket->geefStatus() === 'open'): ?>
                        <h5>
                            <a href="./?control=admin&action=rapportToevoegen&ticket_id=<?php echo $ticket->geefId(); ?>">
                                <!--<img src="./img/toevoegen.png"/>-->Ticket sluiten en Rapport maken</a></h5>
                    <?php endif; ?>
                    <?php if ($ticket->geefStatus() === 'gesloten'): ?>

                        <div class="table-responsive">
                            <table class="table">

                                <tbody>
                                <tr>
                                    <td>
                                        Ticket Nummer
                                    </td>
                                    <td>
                                        <?php echo $ticket->geefId(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Datum/Tijd</h5>
                                        <?php echo $ticket->geefDatum_veranderd() . ' ' . $ticket->geefTijd_veranderd(); ?>
                                    </td>
                                    <td>
                                        <textarea style="height:100px; width:250px; resize: vertical;"
                                                  disabled=""><?php echo $ticket->geefEscalatie(); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Datum
                                    </td>
                                    <td>
                                        <?php echo $ticket->geefAanmaak_datum(); ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <br/>

                        <button class="btn btn-primary" data-toggle="modal" data-target="#contact">
                            Vul hier uw escalatie in.
                        </button>




                        <!--<a href="./?control=admin&action=rapportWijzigen&ticket_id=<?php //echo $ticket->geefId() ?>">
                                                <!--<img src="./img/wijzig.png"/>Wijzig het Rapport-->
                        <!--</a>-->
                    <?php endif; ?>

                </div>
                <div class="col-lg-6">
                    <div class="heading bgcolor4">
                        <i class="fa fa-table"></i>Expert
                    </div>

                    <?php if ($ticket->geefStatus() === 'open'): ?>
                        <h5>
                            <a href="./?control=admin&action=rapportToevoegen&ticket_id=<?php echo $ticket->geefId(); ?>">
                                <!--<img src="./img/toevoegen.png"/>-->Ticket sluiten en Rapport maken</a></h5>
                    <?php endif; ?>
                    <?php if ($ticket->geefStatus() === 'gesloten'): ?>

                    <div class="table-responsive">
                        <table class="table">

                            <tbody>
                            <tr>
                                <td>
                                    Ticket Nummer
                                </td>
                                <td><?php echo $ticket->geefId(); ?></td>

                            </tr>
                            <tr>

                                <td>
                                    <h5>Datum/Tijd</h5>
                                    <?php echo $ticket->geefDatum_antwoordveranderd() . ' ' . $ticket->geefTijd_antwoordveranderd(); ?>
                                </td>
                                <td>

                                    <textarea style="height:100px; width:250px; resize: vertical;"
                                              disabled=""><?php echo $ticket->geefAntwoord_escalatie(); ?></textarea>

                                </td>

                            </tr>

                            <tr>
                                <td>
                                    Datum
                                </td>
                                <td>
                                    <?php echo $ticket->geefAanmaak_datum(); ?>
                                </td>
                            </tr>



                            </tbody>
                        </table>

                        <br/>

                        <button class="btn btn-primary" data-toggle="modal" data-target="#contactEx">
                            vul hier uw escalatie in.
                        </button>
                        <!--<a href="./?control=admin&action=rapportWijzigen&ticket_id=<?php //echo $ticket->geefId() ?>">
                                                <!--<img src="./img/wijzig.png"/>Wijzig het Rapport-->
                        <!--</a>-->
                        <?php endif; ?>
                    </div>

                </div>
        </div>
    </div>

</div>
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="contact">Kantoor</h4>
            </div>
            <div class="modal-body row">

                <div class="container">

                    <div class="col-lg-6">
                        <strong>Hieronder het verslag namens: </strong>
                        <small><?php echo $klant->geefVoornaam(); ?></small>
                        <form method="post" action=".">
                            <input type="hidden" name="ticket_id" value="<?php echo $ticket->geefId(); ?>">
                            <input type="hidden" name="action" value="ticketbzk">
                            <input type="hidden" name="control" value="admin">
                            <textarea <?php echo $ticket->geefKlantDisabled(); ?>
                                style="width:250px;height:250px; resize: none;" required="required"
                                name="escalatie"><?php echo $ticket->geefEscalatie(); ?></textarea>


                    </div>
                    <div class="col-lg-6">
                        <table class="table-bordered">
                            <tr>
                                <td>Klant :</td>
                                <td><?php echo $klant->geefVoornaam() . ' ' . $klant->geefAchternaam(); ?></td>
                            </tr>
                            <tr>
                                <td>Klant Nr. :</td>
                                <td><?php echo $klant->geefId(); ?></td>
                            </tr>
                            <tr>
                                <td>Ticket Nr. :</td>
                                <td><?php echo $ticket->geefId(); ?></td>
                            </tr>
                            <tr>
                                <td>Datum afspraak:</td>
                                <td><?php echo $ticket->geefAfspraak_datum(); ?></td>
                            </tr>
                            <tr>
                                <td>Datum escalatie:</td>
                                <td><?php echo $ticket->geefAanmaak_datum(); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Datum gewijzigd:
                                </td>
                                <td>
                                    <?php echo $ticket->geefDatum_veranderd(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tijd gewijzigd:
                                </td>
                                <td>
                                    <?php echo $ticket->geefTijd_veranderd(); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?php
                    $ticket->geefSubmitKantoor();
                ?>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="contactEx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="contactEx">Expert</h4>
            </div>
            <div class="modal-body row">
                <div class="container">

                    <div class="col-lg-6">
                        <strong>Hieronder het verslag van </strong>
                        <small><?php foreach ($gebruikers as $gebruiker): ?>
                                <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                    <td>
                                        <?php echo $gebruiker->geefNaam(); ?>
                                    </td>
                                <?php endif; ?>
                            <?php endforeach; ?></small>

                        <form method="post" action=".">
                            <input type="hidden" name="ticket_id" value="<?php echo $ticket->geefId(); ?>">
                            <input type="hidden" name="action" value="ticketbzk">
                            <input type="hidden" name="control" value="admin">
                            <textarea  <?php echo $ticket->geefExpertDisabled() ?>
                                style="width:250px;height:250px;resize: none;" name="antwoord_escalatie"
                                required="required"><?php echo $ticket->geefAntwoord_escalatie(); ?></textarea>

                    </div>
                    <div class="col-lg-6">
                        <table class="table-bordered">
                            <tr>
                                <td>Expert :</td>


                                <?php foreach ($gebruikers as $gebruiker): ?>
                                    <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                        <td>
                                            <?php echo $gebruiker->geefVoornaam() . ' ' . $gebruiker->geefAchternaam(); ?>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Ticket Nr. :</td>
                                <td><?php echo $ticket->geefId(); ?></td>
                            </tr>
                            <tr>
                                <td>Datum afspraak :</td>
                                <td><?php echo $ticket->geefAfspraak_datum(); ?></td>
                            </tr>
                            <tr>
                                <td>Datum escalatie :</td>
                                <td><?php echo $ticket->geefAanmaak_datum(); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Datum gewijzigd:
                                </td>
                                <td>
                                    <?php echo $ticket->geefDatum_antwoordveranderd(); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tijd gewijzigd:
                                </td>
                                <td>
                                    <?php echo $ticket->geefTijd_antwoordveranderd(); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?php
                    $ticket->geefSubmitExpert();
                ?>

            </div>

            </form>
        </div>
    </div>
</div>
</main>

</body>
</html>
