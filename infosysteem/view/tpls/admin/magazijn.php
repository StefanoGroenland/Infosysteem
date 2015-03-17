<!DOCTYPE html>
<html>
    <head>
        <title>Magazijn</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Begin Navigatie !-->
        <?php include_once("includes/topNavigatie.php"); ?>
        <!-- Einde Navigatie !-->
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <ol class="breadcrumb">


                            <li class="active">Magazijn</li>
                            <li><a href="./?control=admin&action=productenBeheer">Producten Lijst</a></li>
                        </ol>
                        
                        <h1>Producten</h1>
                        
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>

                                    <th class="hidden-xs " style="color:white;">Naam</th>
                                    <th class="hidden-xs " style="color:white;">Hoeveelheid</th>

                                </tr>
                            </thead>
                            <tbody>

<?php foreach ($products as $product): ?>
                                    <tr>


                                        <td>
    <?php echo $product->geefNaam(); ?>
                                        </td>
                                        <td>
                                            <form method="post" action=".">
                                                <input type="hidden" name="action" value="wijzigVoorraad"/>
                                                <input type="hidden" name="control" value="admin"/>
                                                <input type="hidden" name="id" value="<?php echo $product->geefId(); ?>" />
                                                <input type="text" name="voorraad" value="<?php echo $product->geefVoorraad(); ?>"/> 
                                                <button type="submit" name="btn1">UPDATE</button>
                                            </form>

                                        </td>

                                    </tr>
<?php endforeach; ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>