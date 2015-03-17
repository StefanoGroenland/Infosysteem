<!DOCTYPE html>
<html>
    <head>
        <title>
            AIS - Ticket
        </title>
        <?php include_once("includes/link.php"); ?>

    </head>
    <body class="page-header-fixed bg-1">
    <main>
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>

                            <div class="heading bgcolor1">
                                Storingen
                            </div>
                            <?php $countable = count($storingen);?>
                            <?php for($i = 0; $i < $countable; $i++) :?>
                                <div class="widget-content padded clearfix">
                                    <div class="table">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Titel
                                                    </td>
                                                    <td>
                                                        <?php echo $storingen[$i]->geefTitel(); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Omschrijving
                                                    </td>
                                                    <td>
                                                        <?php echo $storingen[$i]->geefOmschrijving(); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Start Datum
                                                    </td>
                                                    <td>
                                                        <?php echo $storingen[$i]->geefStartDatum(); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Verwachte eind datum
                                                    </td>
                                                    <td>
                                                        <?php echo $storingen[$i]->geefEindDatum(); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Status
                                                    </td>
                                                    <td>
                                                        <?php echo $storingen[$i]->geefStatus(); ?>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
