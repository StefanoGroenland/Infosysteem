<!DOCTYPE html>
<html>
    <head>
        <title>Producten</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Navigation -->
        <?php include_once("includes/topNavigatie.php"); ?>
        <!-- End Navigation -->

        <!--<div class="col-lg-5">-->
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <ol class="breadcrumb">
                            <li><a href="./?control=admin&action=factuur">Factuur</a></li>
                                <li class="active">Producten Lijst</li>
                                <li><a href="./?control=admin&action=productToevoegen">Product toevoegen</a></li>
                                
                            </ol>
                        <h1>Producten</h1>
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                            <th class="hidden-xs " style="color:white;">Naam</th>
                            <th class="hidden-xs " style="color:white;">Beschrijving</th>
                            <th class="hidden-xs " style="color:white;">Prijs</th>
                            <th class="hidden-xs " style="color:white;">Wijzig</th>
                            <th class="hidden-xs " style="color:white;">Verwijder</th>
                            </thead>
                            <tbody>
                                <?php foreach ($producten as $product): ?>
                                    <tr>
                                        <td style="width: 10%;">
                                            <?php echo $product->geefNaam(); ?>
                                            <br/>
                                            <?php if (strlen($product->geefFoto()) >= 1): ?>
                                                <img src="img/producten/<?php echo $product->geefFoto(); ?>" style="max-width: 100px;"/>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $product->geefBeschrijving(); ?>
                                        </td>
                                        <td>    
                                            &#8364;<?php echo $product->geefPrijs(); ?>
                                        </td>
                                        <td class="eind_cel">
                                            <a href="./?control=admin&action=productWijzigen&product_id=<?php echo $product->geefId(); ?>">
                                                <!--<img src="./img/wijzig.png"/>-->
                                                Wijzig
                                            </a>
                                        </td>
                                        <td class="eind_cel">
                                            <a href="./?control=admin&action=productVerwijderen&product_id=<?php echo $product->geefId() ?>" onclick="return confirm('Weet je het zeker?')">
                                                <!--<img src="./img/verwijder.png"/-->
                                                Verwijder
                                            </a>
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