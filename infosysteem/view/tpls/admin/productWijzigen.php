<!DOCTYPE html>
<html>
    <head>
        <title>Product wijzigen</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
    <main>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <ol class="breadcrumb">
                            <li><a href="./?control=admin&action=factuur">Factuur</a></li>
                                <li><a href="./?control=admin&action=productenBeheer">Producten Lijst</a></li>
                                <li><a href="./?control=admin&action=productToevoegen">Product toevoegen</a></li>
                                
                                <li class="active">Product wijzigen</li>
                            </ol>
                        <h1>Product wijzigen</h1>
                        <form action="." method="post" class="pure-form pure-form-aligned" enctype="multipart/form-data">
                            <input type='hidden' name="action" value="ProductWijzigen">
                            <input type='hidden' name="control" value="admin">
                            <input type='hidden' name="product_id" value="<?php echo $product->geefId(); ?>">
                            <fieldset>
                                <div class="pure-control-group">
                                    <label>Product naam</label>
                                    <input type="text"placeholder="vul in" name="naam" required="required" value="<?php echo $product->geefNaam(); ?>">
                                </div>

                                <div class="pure-control-group">
                                    <label>Beschrijving</label>
                                    <textarea name="beschrijving" placeholder="vul in" value="<?php echo $product->geefBeschrijving(); ?>"><?php echo $product->geefBeschrijving(); ?></textarea>
                                </div>

                                <div class="pure-control-group">
                                    <label>Prijs</label>
                                    <input type="text" placeholder="vul in" name="prijs" required="requiered" value="<?php echo $product->geefPrijs(); ?>">
                                </div>

                                <div class="pure-control-group">
                                    <label>Foto</label>
                                    <input type="file" name="file">
                                    <input type='hidden' name="foto" value="<?php echo $product->geefFoto(); ?>">
                                </div>

                                <div class="pure-controls">
                                    <button type="submit" class="pure-button pure-button-primary">Opslaan</button>
                                    <button type="reset" class="pure-button pure-button-primary">herstel</button>
                                </div>
                                
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
            </div>
    </main>
</body>
</html>