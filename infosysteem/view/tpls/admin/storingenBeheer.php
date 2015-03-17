<!DOCTYPE html>
<html>
    <head>
        <title>storingen Beheren</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <!--ZOEK FUNCTIE-->
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <h1>Storingen</h1>
                        <table class="table table-bordered table-striped dataTable col-lg-10">
                            <thead>
                            
                            <th class="hidden-xs " style="color:white;">Titel</th>
                            <th class="hidden-xs " style="color:white;">Omschrijving</th>
                            <th class="hidden-xs " style="color:white; width:10%;">Start datum</th>
                            <th class="hidden-xs " style="color:white; width:10%">Eind datum</th>
                            <th class="hidden-xs " style="color:white;">Status</th>
                            <th class="hidden-xs " style="color:white; width:10%;">Wijzigen</th>
                            <th class="hidden-xs " style="color:white; width:10%;">Status wijzigen</th>
                            <th class="hidden-xs " style="color:white;">Verwijderen</th>
                            </thead>
                            <tbody>   
                                <?php if (isset($storingen) && !empty($storingen)): ?>
                                    <?php foreach ($storingen as $storing): ?>     
                                        <tr>
                                            
                                            <td>
                                                <?php echo $storing->geefTitel(); ?>
                                            </td>
                                            <td>
                                                <?php echo $storing->geefOmschrijving(); ?>
                                            </td>
                                            <td>
                                                <?php echo $storing->geefStartDatum(); ?>
                                            </td>
                                            <td >
                                                <?php echo $storing->geefEindDatum(); ?>
                                            </td>
                                            <td>
                                                <?php echo $storing->geefStatus(); ?>
                                            </td>
                                            <td>
                                                <a href=".?control=admin&amp;action=storingWijzigen&amp;storingId=<?php echo $storing->geefId(); ?>"> Wijzig storing </a>
                                            </td>
                                            <td>
                                                <a href=".?control=admin&amp;action=storingStatusWijzigen&id=<?php echo $storing->geefId(); ?>&amp;status=<?php echo $storing->geefStatus(); ?> "> Status wijzigen</a>
                                            </td>
                                            <td>
                                                <a href=".?control=admin&amp;action=storingVerwijderen&id=<?php echo $storing->geefId(); ?>"> Delete </a>
                                            </td>
                                            
                                            <?php //Vraag of hier een statusWijzigen knop kan komen, om de status gelijk te kunnen wijzigen. Van lopend naar gesloten en andersom! ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <tr>
                                    <td> <a href=".?control=admin&amp;action=storingToevoegen" > Voeg Storing toe </a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>