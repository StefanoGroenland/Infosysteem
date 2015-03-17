<!DOCTYPE html>
<html>
    <head>
        <title>AIS - Logs</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <h1>Logs</h1>

                            <table class="table table-bordered table-striped" id="dataTableLogs">
                                <thead>
                                <th class="hidden-xs " style="color:white;">#ID</th>
                                <th class="hidden-xs " style="color:white;width:15%;">IP</th>
                                <th class="hidden-xs " style="color:white;width:6%;">Status</th>
                                <th class="hidden-xs " style="color:white;width:30%;">Log</th>
                                <th class="hidden-xs " style="color:white;width:20%;">Gebruiker</th>
                                <th class="hidden-xs " style="color:white;width:20%;">Datum</th>
                                <th class="hidden-xs " style="color:white;width:10%;">Tijd</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $log) : ?>
                                        <?php if (isset($log) && !empty($log)): ?>

                                            <tr>
                                                <td>
                                                    <?php echo $log->geefId(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $log->geefIp_adres(); ?>
                                                </td>
                                                <td style="<?php
                                                if ($log->geefStatus() === 'Gelukt')
                                                {
                                                    echo 'color:#0DB81B';
                                                } elseif ($log->geefStatus() === 'Mislukt')
                                                {
                                                    echo 'color:#F36F3A';
                                                }
                                                ?>">
                                                        <?php echo $log->geefStatus(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $log->geefLog(); ?>
                                                </td>
                                                <td>

                                                    <?php echo $log->geefVoornaam(); ?>
                                                    <?php echo $log->geefAchternaam(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $log->geefDatum_log(); ?>

                                                </td>
                                                <td>
                                                    <?php echo $log->geefTijd_log(); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>