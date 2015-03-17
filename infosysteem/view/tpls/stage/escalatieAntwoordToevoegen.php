<!DOCTYPE html>
<html>
    <head>
        <title>Escalatie Antwoord</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <h1>Escalatie Antwoord</h1>

                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="escalatieAntwoordToevoegen"/>
                                <input type='hidden' name="control" value="stage"/>
                                <input type='hidden' name="ticket_id" value="<?php echo $ticket->geefId() ?>"/>
                                <input type='hidden' name="klant_id" value="<?php echo $ticket->geefKlant_id() ?>"/>
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Escalatie</label>
                                        <textarea style="height: 150px; width: 300px;" disabled><?php echo $ticket->geefEscalatie(); ?></textarea>
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Antwoord</label>
                                        <textarea name="$antwoord_escalatie" style="height: 150px; width: 300px;"></textarea>
                                    </div>
                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Maak Escalatie aan</button>
                                    </div>
                                </fieldset>
                            </form>
                            <br/>
                            <a href="./?control=stage&action=ticket&ticket_id=<?php echo $ticket->geefId() ?>&klant_id=<?php echo $ticket->geefKlant_id() ?>">
                                <img src="./img/vorige.png"/>Ga terug naar de ticket.
                            </a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>