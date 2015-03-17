<!DOCTYPE html>
<html>
    <head>
        <title>Gebruikers wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <?php include_once("includes/topNavigatie.php"); ?>
                        <main>
                            <h1>Gebruiker wijzigen</h1>
                            <?php
                            if (isset($opmerking))
                            {
                                echo $opmerking;
                            }
                            ?>
                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="gebruikerWijzigen" />
                                <input type='hidden' name="control" value="admin" />
                                <input type='hidden' name="gebruiker_id" value="<?php echo $gebruiker->geefId(); ?>" />
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Voornaam</label>
                                        <input type="text" name="voornaam" value="<?php echo $gebruiker->geefVoornaam(); ?>" placeholder="vul in" required="required" />
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Tussenvoegsel</label>
                                        <input type="text" name="tussenvoegsel" value="<?php echo $gebruiker->geefTussenvoegsel(); ?>" placeholder="vul in" />
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Achternaam</label>
                                        <input type="text" name="achternaam" value="<?php echo $gebruiker->geefAchternaam(); ?>" placeholder="vul in" required="required" />
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Mail</label>
                                        <input type="email" name="mail" value="<?php echo $gebruiker->geefMail(); ?>" placeholder="vul in" />
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Gebruikersnaam</label>
                                        <input type="text" name="gebruikersnaam" value="<?php echo $gebruiker->geefGebruikersnaam(); ?>" placeholder="vul in" required="required" />
                                        <input type="hidden" name="huidig_gebruikersnaam" value="<?php echo $gebruiker->geefGebruikersnaam(); ?>" />
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Wachtwoord</label>
                                        <input id="wachtwoord" type="password" name="wachtwoord" value="<?php echo $gebruiker->geefWachtwoord(); ?>" placeholder="vul in" required="required"/>
                                        <a id="eyeToggle"> <span class="glyphicon glyphicon-eye-open"> </span> </a>
                                        
                                    </div>

                                    <div class="pure-controls">
                                        <button type="submit" name="wijzigGebruiker" class="pure-button pure-button-primary">Opslaan</button>
                                        <button type="reset" class="pure-button pure-button-primary">Herstellen</button>
                                    </div>
                                </fieldset>
                            </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="widget-container fluid-height clearfix">
                    <div class="widget-content padded clearfix">
                        <form action="." method="post" class="pure-form pure-form-aligned">
                            <input type='hidden' name="action" value="resetStandaardWachtwoord"/>
                            <input type='hidden' name="control" value="admin"/>
                            <input type="hidden" name="gebruiker_id" value="<?php echo $gebruiker->geefId(); ?>" />
                            <div class="pure-control-group">
                                Standaard wachtwoord: <?php echo $standaardWachtwoord->geefWachtwoord(); ?>
                            </div>
                            <div class="pure-controls">
                                <button name="resetWachtwoord" type="submit"/> Reset wachtwoord </button>
                            </div>
                        </form>
                        <div class="widget-content padded clearfix">
                            <a href="./?control=admin&action=gebruikersBeheer">
                                Terug naar de gebruikers.
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>
<script>
    var toggle = $("span");
    $(function() {
    $( "#eyeToggle" ).click(function() {
        if(toggle.hasClass("glyphicon-eye-open") === true)
        {
            $( "span" ).removeClass("glyphicon-eye-open"), $("span").addClass("glyphicon-eye-close");
            $("#wachtwoord").removeAttr('type'),$("#wachtwoord").attr("type", "text");
        }
        else
        {
            $( "span" ).removeClass("glyphicon-eye-close"), $("span").addClass("glyphicon-eye-open");
            $("#wachtwoord").removeAttr('type'),$("#wachtwoord").attr("type", "password");
        }
    });
    });

</script>
</html>