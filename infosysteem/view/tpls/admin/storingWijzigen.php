<!DOCTYPE html>
<html>
    <head>
        <title>Storing wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>

        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <h1> Storing Wijzigen </h1>
                        <?php
                        if (isset($opmerking))
                        {
                            echo '<span style="color:red;">' . $opmerking . '</span>';
                        }
                        ?>
                        <form action="." method="post" class="pure-form pure-form-aligned">
                            <input type='hidden' name="action" value="storingWijzigen">
                            <input type='hidden' name="control" value="admin">
                            <input type="hidden" name="id" value="<?php echo $storing->geefId(); ?>"
                            <fieldset>
                                
                                <div class="pure-control-group">
                                    <label>Titel</label>
                                    <input type="text" class="pure-input-1-4" value="<?php echo $storing->geefTitel(); ?>" name="titel" required="required">
                                </div>

                                <div class="pure-control-group">
                                    <label>Omschrijving</label>
                                    <textarea class="pure-input-1-4" name="omschrijving" required="required" ><?php echo $storing->geefOmschrijving(); ?></textarea>
                                </div>

                                <div class="pure-control-group">
                                    <label>Startdatum</label>
                                    <input type="text" class="pure-input-1-4" value="<?php echo $storing->geefStartDatum(); ?>" name="startDatum" required="required" >
                                </div>

                                <div class="pure-control-group">
                                    <label>Verwachte eind datum</label>
                                    <input type="text" class="pure-input-1-4" name="eindDatum" value="<?php echo $storing->geefEindDatum(); ?>" >
                                </div>
                                <div class="pure-control-group">
                                    <label>Status</label>
                                    <?php echo $storing->geefStatus(); ?>
                                    <select name="status">
                                        <option <?php if($storing->geefStatus() === "Lopend") { echo 'selected'; } ?>  value="lopend"> Lopend </option>
                                        <option <?php if($storing->geefStatus() === "Opgelost") { echo 'selected'; } ?>  value="opgelost"> Opgelost </option>
                                    </select>
                                   
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Storing wijzigen</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>