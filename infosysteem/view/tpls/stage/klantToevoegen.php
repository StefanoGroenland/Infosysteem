<!DOCTYPE html>
<html>
    <head>
        <title>Klant toevoegen</title>
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

                                <li><a href="./?control=stage&action=klanten">Klanten</a></li>
                                <li class="active">Klant toevoegen</li>

                            </ol>
                            <h1>Klant toevoegen</h1>
                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="klantToevoegen">
                                <input type='hidden' name="control" value="stage">
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Voornaam</label>
                                        <input type="text" name="voornaam" placeholder="vul in" required="required">
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Tussenvoegsel</label>
                                        <input type="text" name="tussenvoegsel" placeholder="vul in">
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Achternaam</label>
                                        <input type="text" name="achternaam" placeholder="vul in" required="required" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Straatnaam</label>
                                        <input type="text" name="straatnaam" placeholder="vul in">
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Huisnummer</label>
                                        <input type="text" name="huisnummer" placeholder="vul in" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Postcode</label>
                                        <input type="text" name="postcode" placeholder="vul in" pattern="[0-9]{4}[A-Za-z]{2}" title="4 cijfers - 2 letters, zonder spatie" maxlength="6">
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Woonplaats</label>
                                        <input type="text" name="woonplaats" placeholder="vul in" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Bedrijf</label>
                                        <input type="text" name="bedrijf" placeholder="vul in" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Email</label>
                                        <input type="text" name="email" placeholder="vul in" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Telefoon</label>
                                        <input type="text" name="telefoon" placeholder="vul in" >
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Mobiel</label>
                                        <input type="text" name="mobiel" placeholder="vul in" >
                                    </div>

                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Maak klant</button>
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