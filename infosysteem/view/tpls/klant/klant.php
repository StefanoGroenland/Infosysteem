<!DOCTYPE html>
<html>
    <head>
        <title>Mijn profiel</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <?php include_once("includes/topNavigatie.php"); ?>
                        <main>
                            <h1>Mijn Profiel</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Naam</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Adres</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Postcode</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Woonplaats</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Bedrijf</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Email</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Telefoon</th>
                                        <th class="hidden-xs sorting_disabled" style="color:white;">Mobiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $klant->geefVoornaam(); ?>
                                            <?php echo $klant->geefTussenvoegsel(); ?>
                                            <?php echo $klant->geefAchternaam(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefStraatnaam(); ?>
                                            <?php echo $klant->geefHuisnummer(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefPostcode(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefWoonplaats(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefBedrijf(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefEmail(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefTelefoon(); ?>
                                        </td>
                                        <td>
                                            <?php echo $klant->geefMobiel(); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h2>Wachtwoord wijzigen</h2>
                            <?php if (isset($opmerking)) {
                                echo $opmerking;
                            } ?>
                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="wachtwoordWijzigen">
                                <input type='hidden' name="control" value="klant">
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Huidig wachtwoord</label>
                                        <input type="password" name="wachtwoord1" placeholder="vul in" required="required" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Nieuw wachtwoord</label>
                                        <input type="password" name="wachtwoord2" placeholder="vul in" required="required" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Herhaal nieuw wachtwoord</label>
                                        <input type="password" name="wachtwoord3" placeholder="vul in" required="required" />
                                    </div>

                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Wijzigen</button>
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