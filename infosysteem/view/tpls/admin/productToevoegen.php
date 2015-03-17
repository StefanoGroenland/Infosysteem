<!DOCTYPE html>
<html>
    <head>
        <title>Product toevoegen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <?php include_once("includes/topNavigatie.php"); ?>
                        <main>
                            <ol class="breadcrumb">
                             <li><a href="./?control=admin&action=factuur">Factuur</a></li>
                             <li><a href="./?control=admin&action=productenBeheer">Producten Lijst</a></li>
                                <li class="active">Product toevoegen</li>
                                
                               
                            </ol>
                            <h1>Product toevoegen</h1>
                            <?php if (isset($opmerking)) {
                                echo '<span style="color:red;">' . $opmerking . '</span>';
                            } ?>
                            <form action="." method="post" class="pure-form pure-form-aligned" enctype="multipart/form-data">
                                <input type='hidden' name="action" value="productToevoegen">
                                <input type='hidden' name="control" value="admin">
                                <fieldset>
                                    <div class="pure-control-group">
                                        <label>Product naam</label>
                                        <input type="text"placeholder="vul in" name="naam" required="required">
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Beschrijving</label>
                                        <textarea name="beschrijving" placeholder="vul in"></textarea>
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Prijs</label>
                                        <input type="text" placeholder="vul in" name="prijs" required="requiered">
                                    </div>

                                    <div class="pure-control-group">
                                        <label>Foto</label>
                                        <input type="file" name="file">
                                    </div>

                                    <div class="pure-controls">
                                        <button type="submit" class="pure-button pure-button-primary">Maak Product aan</button>
                                    </div>
                                </fieldset>
                            </form>
                            <br>
                            
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>