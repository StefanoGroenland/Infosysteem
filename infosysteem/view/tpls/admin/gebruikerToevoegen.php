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
                        <ol class="breadcrumb">
                            <li><a href="./?control=admin&action=gebruikersBeheer">Beheer</a></li>
                                <li class="active">Voeg gebruiker Toe</li>
                                <li><a href="./?control=admin&action=klantGebruikerToevoegen">Voeg klant gebruiker toe</a></li>
                            </ol>
                        <h1>Gebruiker toevoegen</h1>
                        <?php
                        if (isset($opmerking)) {
                            echo '<span style="color:red;">' . $opmerking . '</span>';
                        }
                        ?>
                        <form action="." method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
                            <input type='hidden' name="action" value="gebruikerToevoegen">
                            <input type='hidden' name="control" value="admin">
                            <fieldset>
                                <div class="pure-control-group">
                                    <label>Voornaam</label>
                                    <input type="text" class="pure-input-1-3" placeholder="Vul in" name="voornaam" required="required">
                                </div>

                                <div class="pure-control-group">
                                    <label>Tussenvoegsel</label>
                                    <input type="text" class="pure-input-1-3" placeholder="Vul in" name="tussenvoegsel" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Achternaam</label>
                                    <input type="text" class="pure-input-1-3" placeholder="Vul in" name="achternaam" required="required" >
                                </div>

                                                                
                                <div class="pure-control-group">
                                    <label>Foto</label>
                                    <input type="file" class="pure-input-1-3" name="foto">
                                </div>
                                
                                <div class="pure-control-group">
                                    <label>Gebruikersnaam</label>
                                    <input type="text" class="pure-input-1-3" placeholder="Vul in" name="gebruikersnaam" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Wachtwoord</label>
                                    <input type="password" class="pure-input-1-3" placeholder="Vul in" name="wachtwoord" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Herhaal Wachtwoord</label>
                                    <input type="password" class="pure-input-1-3" placeholder="Vul in" name="wachtwoord2" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>E-mail adres</label>
                                    <input type="email" class="pure-input-1-3" placeholder="Vul in" name="mail">
                                </div>

                                <div class="pure-control-group">
                                    <label>Gebruikerstype</label>
                                    <select name="gebruikerstype">
                                        <option value="admin" selected>administrator</option>
                                        <option value="stage">stagiair</option>
                                    </select>
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Maak gebruiker aan</button>
                                </div>
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>