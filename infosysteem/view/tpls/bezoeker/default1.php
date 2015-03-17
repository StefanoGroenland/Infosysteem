<!DOCTYPE html>
<html>
    <head>
        <title>Bezoeker - Inloggen</title>
        <link rel="STYLESHEET" href="css/opmaakcss" type="text/css">
        <link rel="stylesheet" href="css/FormsEnButtonscss">
    </head>
    <body>
<?php
//echo '&#8364 ';//euro teken
//date_default_timezone_set('Europe/Amsterdam');
//echo Date("H:i");
//echo '<br>';
//echo Date("d-m-y/g:i:s");
//echo '<br>';
//$tempDate = '2012-13-14';
//echo date( "w", strtotime( $tempDate));

?>
        <main>
            <h1>Inloggen</h1>
            <form action="." method="post" class="pure-form pure-form-aligned">
                <input type='hidden' name="action" value="default">
                <input type='hidden' name="control" value="bezoeker">
                <fieldset>
                    <div class="pure-control-group">
                        <label>Gebruikersnaam</label>
                        <input type="text" class="pure-input-1-3" placeholder="vul in" name="gn" required="required"/>
                    </div>
                    <div class="pure-control-group">
                        <label>Wachtwoord</label>
                        <input type="password" class="pure-input-1-3" placeholder="vul in" name="ww" required="required"/>
                    </div>
                    <div class="pure-controls">
                        <?php echo $opmerking; ?>
                        <br/><br/>
                        <button type="submit" >Log in</button>
                    </div>
                </fieldset>
            </form>
        </main>
    </body>
</html>
