<!DOCTYPE html>
<html>
    <head>
        <title>Mijn gegevens</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include("includes/topNavigatie.php"); ?>

        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <h1>Mijn gegevens</h1>
                        <div class="pure-form pure-form-aligned">
                            <form action="." method="post" enctype="multipart/form-data"  class="pure-form pure-form-aligned">

                                <input type='hidden' name="action" value="wijzigMijnGegevens"/>
                                <input type='hidden' name="control" value="admin"/>
                                <input type="hidden" name="gebruiker_id" value="<?php echo $_SESSION['gebruiker']->geefId(); ?>"/>
                                <div class="pure-control-group">
                                    <label>Voornaam</label>
                                    <input type="text" name="voornaam" value="<?php echo $gegevens->geefVoornaam(); ?>"/>
                                </div>

                                <div class="pure-control-group">
                                    <label>Tussenvoegsel</label>
                                    <input type="text" name="tussenvoegsel" value="<?php echo $gegevens->geefTussenvoegsel(); ?>"/>

                                </div>

                                <div class="pure-control-group">
                                    <label>Achternaam</label>
                                    <input type="text" name="achternaam" value="<?php echo $gegevens->geefAchternaam(); ?>"/>
                                </div>

                                <div class="pure-control-group">
                                    <label>E-mail adres</label>
                                    <input type="text" name="mail" value="<?php echo $gegevens->geefMail(); ?>"/>
                                </div>
                                
                                <div class="pure-control-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" class="pure-input-1-3" value="<?php echo $gegevens->geefFoto(); ?>">
                                </div>
                                
                                <div class="pure-controls">
                                    <button type="submit"/> Wijzig gegevens </button>
                                    <button type="reset"/> Herstel </button>
                                </div>
                                <div>
                                    <?php
                                    if (isset($opmerking))
                                    {
                                        echo '<span style="color:red;">' . $opmerking . '</span>';
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="widget-container fluid-height clearfix">
                        <div class="widget-content padded clearfix">
                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="wijzigWachtwoord"/>
                                <input type='hidden' name="control" value="admin"/>
                                <input type="hidden" name="gebruiker_id" value="<?php echo $_SESSION['gebruiker']->geefId(); ?>" />

                                <div class="pure-control-group">
                                    <label>Huidig Wachtwoord</label>
                                    <input type="password" name="huidigWachtwoord"/>
                                </div>
                                <div class="pure-control-group">
                                    <label>Nieuw Wachtwoord</label>
                                    <input type="password" name="nieuwWachtwoord"/>
                                </div>
                                <div class="pure-control-group">
                                    <label>Herhaal Nieuw Wachtwoord</label>
                                    <input type="password" name="herhaalNieuwWachtwoord"/>
                                </div>

                                <div class="pure-controls">
                                    <button type="submit"/> Wijzig gegevens </button>
                                    <button type="reset"/> Herstel </button>
                                </div>
                                <div>
                                    <?php
                                    if (isset($opmerking))
                                    {
                                        echo '<span style="color:red;">' . $opmerking . '</span>';
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>