<!DOCTYPE html>
<html>  
    <head>
        <title>
            AIS - Dashboard
        </title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Navigation -->
        <?php include_once("includes/topNavigatie.php"); ?>
        <!-- End Navigation -->
        <div class="container-fluid main-content">
            <!-- Statistics -->
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-container fluid-height">
                        <div class="heading bgcolor1">
                            Storingen
                        </div>
                        <div class="widget-content padded">
                            <?php foreach ($storingen as $storing) : ?>
                                <div class="pure-control-group">
                                    <label>Titel: </label>

                                    <?php echo $storing->geefTitel(); ?>
                                </div>
                                <div class="pure-control-group">
                                    <label>Start datum:</label>
                                    <?php echo $storing->geefStartDatum(); ?>
                                </div>
                                <div style="margin:-25px 10px 10px;  float:right;"> 
                                    <a href=".?control=admin&amp;action=storingen&amp;storing_id=<?php echo $storing->geefId(); ?>">Details</a></div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-container fluid-height">
                        <div class="heading bgcolor2">
                            <i class="fa fa-list-ol"></i>Links
                        </div>
                        <div class="widget-content padded clearfix">
                            <ol>
                                <li>
                                    <a target="_blank" href="http://stefanogroenland.nl">www.StefanoGroenland.nl</a>
                                </li>
                                <li>
                                    Aliquam tincidunt mauris eu risus.
                                </li>
                                <li>
                                    Vestibulum auctor dapibus neque.
                                </li>
                                <li>
                                    Nunc dignissim risus id metus.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-container fluid-height clearfix">
                        <div class="heading bgcolor3">
                            <div class="dashboard-button"></div>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard 
                            <!--ZOEK FUNCTIE-->
                            <form action="." method="post" style="float:right;">
                                <input type='hidden' name="action" value="default">
                                <input type='hidden' name="control" value="admin">

                                <div class="zoekfunctie">
                                    <label>Afspraak Datum</label>
                                    <input class="fieldset__input js__datepicker" type="text" placeholder="Selecteer datum" name="datum">
                                    <button type="submit" class="zoek-button"></button>
                                </div>
                            </form>

                        </div>

                        <br />

                        <div class="widget-content padded clearfix">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="widget-content padded clearfix">
                                        <table class="table table-bordered table-striped" >
                                            <thead>
                                            <th class="hidden-xs " style="color:white;">
                                                Ticket nummer
                                            </th>
                                            <th class="hidden-xs " style="color:white;">
                                                Tijdstip
                                            </th>
                                            <th class="hidden-xs " style="color:white;">
                                                Klant
                                            </th>
                                            <th class="hidden-xs " style="color:white; width:20%">
                                                Adres + Postcode
                                            </th>
                                            <th style="color:white;">
                                                Woonplaats
                                            </th>

                                            </thead>
                                            <tbody>

                                                <?php if (isset($tickets) && !empty($tickets)): ?>
                                                    <?php foreach ($tickets as $ticket): ?>

                                                        <tr class="klikbaar">
                                                            <td class="hidden-xs" >
                                                                <a href="./?control=admin&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>"></a>
                                                                <?php echo $ticket->geefId(); ?>
                                                            </td>
                                                            <td class="hidden-xs">
                                                                <?php echo $ticket->geefTijdstip(); ?>
                                                            </td>
                                                            <!--KLANT INFORMATIE-->
                                                            <?php $s = 0; ?>
                                                            <?php foreach ($klanten as $klant) : ?>
                                                                <?php if ($ticket->geefKlant_id() === $klant[0]->geefId() && $s < 1): ?>

                                                                    <td class="hidden-xs">
                                                                        <?php echo $klant[0]->geefVoornaam(); ?>
                                                                        <?php echo $klant[0]->geefTussenvoegsel(); ?>
                                                                        <?php echo $klant[0]->geefAchternaam(); ?>
                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        <?php echo $klant[0]->geefStraatnaam(); ?>
                                                                        <?php echo $klant[0]->geefHuisnummer(); ?>
                                                                        <?php echo $klant[0]->geefPostcode(); ?>
                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        <?php echo $klant[0]->geefWoonplaats(); ?>
                                                                    </td>
                                                                    <?php $s++; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>

                                                            <!--EIND KLANT INFORMATIE-->

                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <script>
                                                $('tr').click(function () {
                                                    window.location = $(this).find('a').attr('href');
                                                });
                                        </script>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-1.10.2.minjs"></script>
        <script>window.jQuery || document.write('<script src="datepicker/tests/jquery.2.0.0.js"><\/script>')</script>
        <script src="datepicker/lib/picker.js"></script>
        <script src="datepicker/lib/picker.date.js"></script>
        <script src="datepicker/lib/picker.time.js"></script>
        <script src="datepicker/lib/legacy.js"></script>
        <script src="datepicker/demo/scripts/demo.js"></script>
        <script src="datepicker/demo/scripts/rainbow.js"></script>
        <script type="text/javascript">
                                            var _gaq = _gaq || [];
                                            _gaq.push(['_setAccount', 'UA-36321179-2']);
                                            _gaq.push(['_trackPageview']);
                                            (function () {
                                                var ga = document.createElement('script');
                                                ga.type = 'text/javascript';
                                                ga.async = true;
                                                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                                                var s = document.getElementsByTagName('script')[0];
                                                s.parentNode.insertBefore(ga, s);
                                            })();
        </script>




    </body>
</html>