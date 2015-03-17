<!DOCTYPE html>
<html>
    <head>
        <title>PDF</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <h1>PDF <?php echo ucfirst($pdf->geefSoort()); ?></h1>
                            <a href="./<?php echo $pdf->geefPdf(); ?>" target="_blank">
                                Toon PDF in nieuw tabblad
                            </a>
                            <iframe src="<?php echo $pdf->geefPdf(); ?>" style="width: 500px; height: 700px; float: right;">
                            <p>Your browser does not support iframes.</p>
                            </iframe>
                            <br/>
                            <a href="./?control=admin&action=verzendmail&factuur_id=<?php echo $pdf->geefId(); ?>&klant_id=<?php echo $pdf->geefKlant_id(); ?>" >
                                <button style="margin-top:20px;">
                                    Opslaan & Verzenden
                                </button>
                            </a>
                            <br/>
                            <a href="./?control=admin&action=klant&klant_id=<?php echo $pdf->geefKlant_id(); ?>">
                                <button style="margin-top:20px;">
                                    Opslaan
                                </button>
                            </a>
                            <br/>
                            <a href="./?control=admin&action=factuurVerwijderen&factuur_id=<?php echo $pdf->geefId(); ?>&factuur_pad=<?php echo $pdf->geefPdf(); ?>">
                                <button style="margin-top:20px;">
                                    Verwijder
                                </button>
                            </a>
                            <br>
                            <a href="./?control=admin&action=factuur">
                                Ga naar Factuur.
                            </a>
                            <footer></footer>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>