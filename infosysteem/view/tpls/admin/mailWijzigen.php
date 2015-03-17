<!DOCTYPE html>
<html>
    <head>
        <title>Mail toevoegen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php");?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">


            <h1>Mail Wijzigen</h1>
            <form action="." method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
                <input type='hidden' name="action" value="mailWijzigen"/>
                <input type='hidden' name="control" value="admin"/>
                <input type='hidden' name="mail_id" value="<?php echo $mail->geefId()?>"/>
                <input type='hidden' name="klant_id" value="<?php echo $mail->geefKlant_id()?>"/>
                <fieldset>
                    <div class="pure-control-group">
                        <label>Mail</label>
                        <input type="email" name="mail" value="<?php echo $mail->geefMail()?>" required="required" pattern="1*( atext / '.' ) '@' ldh-str 1*( '.' ldh-str )">
                    </div>
                    
                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Wijzigen</button>
                    </div>
                </fieldset>
            </form>
            <br/>
            <a href="./?control=admin&action=klant&klant_id=<?php echo $mail->geefKlant_id()?>">
                Ga terug naar de klant.
            </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>