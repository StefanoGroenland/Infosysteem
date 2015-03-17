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
                        <main>
                            <h1>Ticket Toevoegen</h1>
                            <form action="." method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="ticketToevoegen"/>
                                <input type='hidden' name="control" value="stage"/>
                                <input type='hidden' name="klant_id" value="<?php echo $klant_id; ?>"/>
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Aankomst</label>
                                        <input type="text" name="aankomst" style="width:100px;">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Vertrek</label>
                                        <input type="text" name="vertrek" style="width:100px;">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Opmerking</label>
                                        <textarea name="opmerking" placeholder="vul in"></textarea>
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Aanmaak datum</label>
                                        <input type="text" class="datepicker" name="aanmaak_datum" required="required">
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Afspraak datum</label>
                                        <input type="text" class="datepicker" name="afspraak_datum">
                                    </div>
                                    <div class="pure-control-group" >
                                        <label>Bezoek datum</label>
                                        <input type="text" class="datepicker" name="bezoek_datum" >
                                    </div>
                                    <div class="pure-control-group">
                                        <label>Sluit datum</label>
                                        <input type="text" class="datepicker" name="sluit_datum">
                                    </div>
                                    <script>
                                        $(function() {
                                            //$( "#datepicker" ).datepicker();
                                            $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                        });
                                    </script>

                                    <div class="pure-control-group">
                                        <label>Status</label>
                                        <span>Open</span>
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Expert</label>
                                        <select name="gebruiker_id">
                                            <?php foreach ($gebruikers as $gebruiker): ?>
                                                <option value="<?php echo $gebruiker->geefId() ?>"><?php echo $gebruiker->geefNaam() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Ticket aanmaken</button>
                                    </div>
                                </fieldset>
                            </form>
                            <br/>
                            <a href="./?control=stage&action=klant&klant_id=<?php echo $klant_id; ?>">
                                Ga terug naar de klant.
                            </a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>