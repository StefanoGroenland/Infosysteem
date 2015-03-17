<!DOCTYPE html>
<html>
    <head>
        <title>Server toevoegen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">

                        <h1>Wijzigen</h1>
                        <form action="." method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
                            <input type='hidden' name="action" value="serverWijzigen"/>
                            <input type='hidden' name="control" value="admin"/>
                            <input type='hidden' name="server_id" value="<?php echo $server->geefId() ?>"/>
                            <input type='hidden' name="klant_id" value="<?php echo $server->geefKlant_id() ?>"/>
                            <fieldset>
                                <div class="pure-control-group">
                                    <label>naam</label>
                                    <input type="text" name="naam" value="<?php echo $server->geefNaam() ?>" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Ip adres</label>
                                    <input type="text" name="ip" value="<?php echo $server->geefIp() ?>" required="required">
                                </div>

                                <div class="pure-control-group">
                                    <label>Inlognaam</label>
                                    <input type="text" name="inlognaam" value="<?php echo $server->geefInlognaam() ?>" required="required">
                                </div>

                                <div class="pure-control-group">
                                    <label>Wachtwoord</label>
                                    <input type="text" name="wachtwoord" value="<?php echo $server->geefWachtwoord() ?>" required="required">
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Wijzigen</button>
                                </div>
                            </fieldset>
                        </form>
                        <br/>
                        <a href="./?control=admin&action=klant&klant_id=<?php echo $server->geefKlant_id() ?>">
                            <img src="./img/vorige.png"/>Ga terug naar de klant.
                        </a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>