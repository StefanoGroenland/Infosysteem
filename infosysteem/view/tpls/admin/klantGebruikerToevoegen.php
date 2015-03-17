<!DOCTYPE html>
<html>
    <head>
        <title>Gebruiker toevoegen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <ol class="breadcrumb">
                                <li><a href="./?control=admin&action=gebruikersBeheer">Beheer</a></li>
                                <li><a href="./?control=admin&action=gebruikerToevoegen">Voeg gebruiker Toe</a></li>
                                <li class="active">Voeg klant gebruiker toe</li>
                            </ol>
                            <h1>Klant toevoegen</h1>
                            <?php
                            if (isset($opmerking)) {
                                echo '<span style="color:red;">' . $opmerking . '</span>';
                            }
                            ?>
                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="klantGebruikerToevoegen">
                                <input type='hidden' name="control" value="admin">
                                <input type='hidden' name="gebruikerstype" value="klant">
                                <div class="pure-control-group">
                                    <label>Voornaam</label>
                                    <input type="text" class="pure-input-1-3" placeholder="vul in" name="voornaam" required="required">
                                </div>

                                <div class="pure-control-group">
                                    <label>Tussenvoegsel</label>
                                    <input type="text" class="pure-input-1-3" placeholder="vul in" name="tussenvoegsel" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Achternaam</label>
                                    <input type="text" class="pure-input-1-3" placeholder="vul in" name="achternaam" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Gebruikersnaam</label>
                                    <input type="text" class="pure-input-1-3" placeholder="vul in" name="gebruikersnaam" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Wachtwoord</label>
                                    <input type="password" class="pure-input-1-3" placeholder="vul in" name="wachtwoord" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Herhaal Wachtwoord</label>
                                    <input type="password" class="pure-input-1-3" placeholder="vul in" name="wachtwoord2" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>E-mail adres</label>
                                    <input type="email" class="pure-input-1-3" placeholder="vul in" name="mail">
                                </div>

                                <div class="pure-control-group">
                                    <label>Klant</label>
                                    <select name="klant_id">
                                        <?php foreach ($klanten as $klant): ?>
                                            <option value="<?php echo $klant->geefId(); ?>"><?php echo $klant->geefNaam(); ?></option>
<?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Maak klant aan</button>
                                </div>
                                </fieldset>
                            </form>
                            
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>