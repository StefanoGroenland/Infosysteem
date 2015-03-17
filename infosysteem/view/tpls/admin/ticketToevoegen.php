<!DOCTYPE html>
<html>
    <head>
        <title>Ticket toevoegen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">

                        <h1>Ticket Toevoegen</h1>
                        <form action="." method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
                            <input type='hidden' name="action" value="ticketToevoegen"/>
                            <input type='hidden' name="control" value="admin"/>
                            <input type='hidden' name="klant_id" value="<?php echo $klant_id; ?>"/>
                            <fieldset>
                                <div class="pure-control-group">
                                    <label>Aankomst</label>
                                    <input id="aankomst" type="time" name="aankomst" style="width:100px;">
                                </div>
                                <div class="pure-control-group">
                                    <label>Vertrek</label>
                                    <input type="time" name="vertrek" style="width:100px;">
                                </div>

                                <div class="pure-control-group">
                                    <label>Aanmaak datum</label>
                                    <label style="text-align: left; margin-left:5px;" > <?php echo date('d-m-Y'); ?></label>
                                    <input type='hidden' name='aanmaak_datum' value='<?php echo date('Y-m-d'); ?>' />
                                    <input type='hidden' name='weeknummer' value='<?php echo date('W'); ?>' />
                                </div>
                                <div class="pure-control-group">
                                    <label>Afspraak datum</label>
                                    <input type="date" name="afspraak_datum">
                                </div>
                                <div class="pure-control-group" >
                                    <label>Bezoek datum</label>
                                    <input type="date" name="bezoek_datum" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Opmerking</label>
                                    <textarea name="opmerking" placeholder="vul in"></textarea>
                                </div>
                                <div class="pure-control-group">
                                    <label>Sluit datum</label>
                                    <input type="date" name="sluit_datum">
                                </div>

                                <div class="pure-control-group">
                                    <label>Status</label>
                                    <span>Open</span>
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Ticket aanmaken</button>
                                </div>
                            </fieldset>
                        </form>
                        <br/>
                        <a href="./?control=admin&action=klant&klant_id=<?php echo $klant_id; ?>">Terug</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>