<!DOCTYPE html>
<html>
    <head>
        <title>Rapport wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php");?>
        
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
            <h1>Rapport Wijzigen</h1>
            
            <form action="." method="post" class="pure-form pure-form-aligned">
                <input type='hidden' name="action" value="rapportWijzigen"/>
                <input type='hidden' name="control" value="admin"/>
                <input type='hidden' name="ticket_id" value="<?php echo $ticket->geefId()?>"/>
                <input type='hidden' name="klant_id" value="<?php echo $ticket->geefKlant_id()?>"/>
                <fieldset>
                    <div class="pure-control-group">
                        <label>Rapport</label>
                        <textarea name="rapport" value="<?php echo $ticket->geefRapport();?>" required="required"><?php echo $ticket->geefRapport();?></textarea>
                    </div>
                    <div class="pure-control-group">
                        <label>Datum</label>
                        <input type="text" value="<?php echo $ticket->geefRapport_datum();?>" id="datepicker" name="datum" required="required">
                    </div>
                    <script>
                        $(function() {
                            //$( "#datepicker" ).datepicker();
                            $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
                        });
                    </script>
                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Opslaan</button>
                        <button type="reset" class="pure-button pure-button-primary">Herstel</button>
                    </div>
                </fieldset>
            </form>
            <br/>
            <a href="./?control=admin&action=ticket&ticket_id=<?php echo $ticket->geefId()?>&klant_id=<?php echo $ticket->geefKlant_id()?>">
                Ga terug naar het ticket.
            </a>
                    </div>
                </div>
            </div>
            </div>
    </body>
</html>