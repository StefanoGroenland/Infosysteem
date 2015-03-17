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
                        <h1>Storing toevoegen</h1>
                        <?php
                        if (isset($opmerking))
                        {
                            echo '<span style="color:red;">' . $opmerking . '</span>';
                        }
                        ?>
                        <form action="." method="post" class="pure-form pure-form-aligned">
                            <input type='hidden' name="action" value="storingToevoegen">
                            <input type='hidden' name="control" value="admin">
                            <fieldset>
                                <div class="pure-control-group">
                                    <label>Titel</label>
                                    <input type="text" class="pure-input-1-4" placeholder="Vul in" name="titel" required="required">
                                </div>

                                <div class="pure-control-group">
                                    <label>Omschrijving</label>
                                    <textarea class="pure-input-1-4" placeholder="Vul in" name="omschrijving" > </textarea>
                                </div>

                                <div class="pure-control-group">
                                    <label>Startdatum</label>
                                    <input type="date" class="pure-input-1-4" placeholder="Vul in" name="startDatum" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Verwachte eind datum</label>
                                    <input type="date" class="pure-input-1-4" placeholder="Vul in" name="eindDatum" required="required" >
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Storing plaatsen</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>