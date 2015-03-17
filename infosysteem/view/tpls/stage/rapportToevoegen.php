<!DOCTYPE html>
<html>
    <head>
        <title>Rapport toevoegen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <h1>Rapport Toevoegen</h1>

                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="rapportToevoegen"/>
                                <input type='hidden' name="control" value="stage"/>
                                <input type='hidden' name="ticket_id" value="<?php echo $ticket->geefId() ?>"/>
                                <input type='hidden' name="klant_id" value="<?php echo $ticket->geefKlant_id() ?>"/>
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Rapport</label>
                                        <textarea name="rapport" placeholder="vul in" required="required"></textarea>
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Datum</label>
                                        <input type="text" id="datepicker" name="datum" >
                                    </div>
                                    <script>
                                        $(function() {
                                            //$( "#datepicker" ).datepicker();
                                            $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                        });
                                    </script>
                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Maak Rapport aan</button>
                                    </div>
                                </fieldset>
                            </form>
                            <br/>
                            <a href="./?control=stage&action=ticket&ticket_id=<?php echo $ticket->geefId() ?>&klant_id=<?php echo $ticket->geefKlant_id() ?>">
                                Ga terug naar de ticket.
                            </a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>