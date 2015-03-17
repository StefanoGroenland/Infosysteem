<!DOCTYPE html>
<html>
    <head>
        <title>Klant wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php");?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                             <ol class="breadcrumb">

                                <li><a href="./?control=admin&action=klanten">Klanten</a></li>
                                 <li><a href="./?control=admin&action=klant&klant_id=<?php echo $klant->geefId();?>">Terug naar klant</a></li>
                                <li class="active">Klant wijzigen</li>

                            </ol>
            <h1>Klant gegevens wijzigen</h1>
            <span style="float: right;">
                <a href="./?control=admin&action=klantVerwijderen&klant_id=<?php echo $klant->geefId();?>" onclick="return confirm('Weet je het zeker?')">
                    <!--<img src="./img/verwijder.png"/>--> Verwijder de klant
                </a>
            </span>
            <form action="." method="post" class="pure-form pure-form-aligned">
                <input type='hidden' name="action" value="klantWijzigen">
                <input type='hidden' name="control" value="admin">
                <input type='hidden' name="klant_id" value="<?php echo $klant->geefId();?>">
                <fieldset>
                    <div class="pure-control-group">
                        <label>Voornaam</label>
                        <input type="text" name="voornaam" value="<?php echo $klant->geefVoornaam();?>" required="required">
                    </div>

                    <div class="pure-control-group">
                        <label>Tussenvoegsel</label>
                        <input type="text" name="tussenvoegsel" value="<?php echo $klant->geefTussenvoegsel();?>">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Achternaam</label>
                        <input type="text" name="achternaam" value="<?php echo $klant->geefAchternaam();?>" required="required" >
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Straatnaam</label>
                        <input type="text" name="straatnaam" value="<?php echo $klant->geefStraatnaam();?>">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Huisnummer</label>
                        <input type="text" name="huisnummer" value="<?php echo $klant->geefHuisnummer();?>" maxlength="6">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Postcode</label>
                        <input type="text" name="postcode" value="<?php echo $klant->geefPostcode();?>" pattern="[0-9]{4}[A-Za-z]{2}" title="4 cijfers - 2 letters, zonder spatie" maxlength="6">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Woonplaats</label>
                        <input type="text" name="woonplaats" value="<?php echo $klant->geefWoonplaats();?>">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Bedrijf</label>
                        <input type="text" name="bedrijf" value="<?php echo $klant->geefBedrijf();?>">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>E-mail adres</label>
                        <input type="email" name="email" value="<?php echo $klant->geefEmail();?>">
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Telefoon</label>
                        <input type="text" name="telefoon" value="<?php echo $klant->geefTelefoon();?>" maxlength="10"/>
                    </div>
                    
                    <div class="pure-control-group">
                        <label>Mobiel</label>
                        <input type="text" name="mobiel" value="<?php echo $klant->geefMobiel();?>" maxlength="10"/>
                    </div>
                    
                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Opslaan</button>
                        <button type="reset" class="pure-button pure-button-primary">Herstellen</button>
                    </div>
                </fieldset>
            </form>
            <br/>
            <a href="./?control=admin&action=klant&klant_id=<?php echo $klant->geefId();?>">
                <!--<img src="./img/vorige.png"/>-->Terug naar de klant.
            </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>