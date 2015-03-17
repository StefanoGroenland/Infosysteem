<!DOCTYPE html>
<html>
    <head>
        <title>Ticket wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <h1>Ticket wijzigen</h1>
                            <form action="." method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="ticketWijzigen"/>
                                <input type='hidden' name="control" value="stage"/>
                                <input type="hidden" name="klant_id" value="<?php echo $ticket->geefKlant_id(); ?>"/>
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Id</label>
                                        <input type="text" name="ticket_id" value="<?php echo $ticket->geefId(); ?>" disabled="disabled">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Aankomst</label>
                                        <input type="text" name="aankomst" value="<?php echo $ticket->geefAankomst(); ?>" style="width:100px;">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Vertrek</label>
                                        <input type="text" name="vertrek" value="<?php echo $ticket->geefVertrek(); ?>" style="width:100px;">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Klant id</label>
                                        <input type="text" name="klant_id" value="<?php echo $ticket->geefKlant_id(); ?>" disabled="disabled">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Opmerking</label>
                                        <textarea name="opmerking" value="<?php echo $ticket->geefOpmerking(); ?>"><?php echo $ticket->geefOpmerking(); ?></textarea>
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Aanmaak datum</label>
                                        <input type="text" class="datepicker" name="aanmaak_datum" value="<?php echo $ticket->geefAanmaak_datum(); ?>">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Afspraak datum</label>
                                        <input type="text" class="datepicker" name="afspraak_datum" value="<?php echo $ticket->geefAfspraak_datum(); ?>">
                                    </div>
                                    <div class="pure-control-group" >
                                        <label>Bezoek datum</label>
                                        <input type="text" class="datepicker" name="bezoek_datum" value="<?php echo $ticket->geefBezoek_datum(); ?>">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Sluit datum</label>
                                        <input type="text" class="datepicker" name="sluit_datum" value="<?php echo $ticket->geefSluit_datum(); ?>">
                                    </div>
                                    <script>
                                        $(function() {
                                            //$( "#datepicker" ).datepicker();
                                            $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                        });
                                    </script>
                                    <div class="pure-control-group">
                                        <label>Status</label>

                                        <select name="status">
                                            <option value="open" <?php
                                            if ($ticket->geefStatus() == 'open') {
                                                echo 'selected';
                                            }
                                            ?>>open</option>
                                            <option value="gesloten" <?php
                                            if ($ticket->geefStatus() == 'gesloten') {
                                                echo 'selected';
                                            }
                                            ?>>gesloten</option>
                                        </select>
                                    </div>
                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Opslaan</button>
                                        <button type="reset" class="pure-button pure-button-primary">Herstel</button>
                                    </div>
                                </fieldset>
                            </form>
                            <br/>
                            <a href="./?control=stage&action=ticket&ticket_id=<?php echo $ticket->geefId() ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>">
                                Ga terug naar de ticket.
                            </a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>