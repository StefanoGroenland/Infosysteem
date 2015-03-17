<!DOCTYPE html>
<html>
    <head>
        <title>Global Settings</title>
        <?php include_once("includes/link.php"); ?>
        
        
    </head>
    
    
    
    
    
    <body class="page-header-fixed bg-1">
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <?php include_once("includes/topNavigatie.php"); ?>
                        <main>
                            <h1><i class="fa fa-gear"></i> Global Settings </h1>

                            <form action="." method="post" class="pure-form pure-form-aligned">
                                <input type='hidden' name="action" value="GlobalSettings" />
                                <input type='hidden' name="control" value="admin" />


                                <fieldset>


                                    <div class="pure-control-group">
                                        <label>Standaard Wachtwoord</label>


                                        <input type="text" required="required" name="standaardWachtwoord" value="<?php echo $standaardWachtwoord->geefWachtwoord(); ?>"/>
                                    </div>

                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Opslaan</button>
                                    </div>
                                </fieldset>
                                
                                
                                
                            </form>
                          </div>
                </div>


            </div>
        </div>

    </body>
</html>