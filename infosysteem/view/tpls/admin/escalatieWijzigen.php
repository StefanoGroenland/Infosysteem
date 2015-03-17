<!DOCTYPE html>
<html>
    <head>
        <title>Escalatie wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php");?>
        
            <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                         <h1>Escalatie Wijzigen</h1>
            <form action="." method="post" class="pure-form pure-form-aligned">
                <input type='hidden' name="action" value="escalatieWijzigen"/>
                <input type='hidden' name="control" value="admin"/>
                <input type='hidden' name="ticket_id" value="<?php echo $ticket->geefId()?>"/>
                <input type='hidden' name="klant_id" value="<?php echo $ticket->geefKlant_id()?>"/>
                <fieldset>
                    <div class="pure-control-group">
                        <label>Escalatie</label>
                        <textarea name="escalatie" required="required"><?php echo $ticket->geefEscalatie();?></textarea>
                    </div>
                    <div class="pure-control-group">
                        <label>Antwoord</label>
                        <textarea name="antwoord_escalatie" required="required"><?php echo $ticket->geefAntwoord_escalatie();?></textarea>
                    </div>
                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Wijzig Escalatie</button>
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