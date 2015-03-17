<!DOCTYPE html>
<html>
    <head>
        <title>
            AIS - Tickets
        </title>
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

                        <!--ZOEK FUNCTIE-->
                        <!--
                        <form action="." method="post" class="pure-form zoek" style="float:right;">
                             <input type='hidden' name="action" value="tickets">
                             <input type='hidden' name="control" value="admin">
                    
                             <label>Ticket nummer</label>
                             <input type="number" class="pure-input-rounded" style="width:100px;" name="nummer" placeholder="Vul in">
                    
                             <label>| Status</label>
                             <select name="status">
                                 <option value="geen" >geen</option>
                                 <option value="open">open</option>
                                 <option value="gesloten">gesloten</option>
                             </select>
                    
                             <label>| Periode</label>
                             <select name="periode" id="periode">
                                 <option value="geen" >geen</option>
                                 <option value="aanmaak">aanmaak</option>
                                 <option value="afspraak">afspraak</option>
                                 <option value="bezoek">bezoek</option>
                                 <option value="sluit">sluit</option>
                             </select>
                    
                             <input type="text"  id="datepicker" class="pure-input-rounded" name="datum" required="required" placeholder="Selecteer datum">
                    
                             <script>
                                 $(function() {
                                     //$( "#datepicker" ).datepicker();
                                     $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                     $('#datepicker').attr("disabled", "disabled");
                                 });
                    
                                 //zorgt ervoor dat datum wordt disabled als je geen kiest
                                 $("select").change(checkDatum);
                                 checkDatum();
                    
                                 function checkDatum() {
                                     var periode = $("#periode").val();
                                     if (periode === 'geen')
                                     {
                                         $('#datepicker').attr("disabled", "disabled");
                                     }
                                     else {
                                         $('#datepicker').removeAttr("disabled");
                                     }
                                 }
                             </script>
                    
                             <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                         </form>
                    
                        !-->
                        <!--ZOEK FUNCTIE-->
                        <form action="." method="post" class="pure-form" style="float:right;">
                            <input type='hidden' name="action" value="tickets">
                            <input type='hidden' name="control" value="admin">
                            <label>Zoek op</label>
                            <select id="zoek" name="zoek">
                                <option value="id">Ticket nummer</option>
                                <option value="afspraakDatum">Afspraak datum</option>
                                <option value="voornaam">Voornaam</option>
                                <option value="achternaam">Achternaam</option>
                                <option value="postcode">Postcode</option>
                            </select>
                            <span id="inputZoeken">
                                <input id="inputZoeken" type="text" class="pure-input-rounded" style="width: 120px;" name="waardeInput" placeholder="Vul in">
                            </span>
                            <button type="submit" class="zoek-button">&nbsp;&nbsp;</button>
                        </form>

                        <h1>Tickets</h1>

                        <h3>
                            <?php
                            //maakt de dagen aan in nl woorden
                            $dagen = array("Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag");
                            //echo $dagen[date( "w", strtotime(2014-3-11))];
                            if (isset($datum))
                            {
                                echo $dagen[date("w", strtotime($datum))] . ' ';
                                echo $datum;
                            }
                            ?>
                        </h3>
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                            <th class="hidden-xs " style="color:white;">#</th>
                            <th class="hidden-xs " style="color:white;">Afspraak datum</th>
                            <th class="hidden-xs " style="color:white;">Tijd</th>
                            <th class="hidden-xs " style="color:white;">Klant</th>
                            <th class="hidden-xs " style="color:white;">Postcode - Huisnr.</th>
                            <th class="hidden-xs " style="color:white;">Expert</th>
                            </thead>
                            <tbody>
                                <?php if (isset($tickets) && !empty($tickets)): ?>
                                    <?php foreach ($tickets as $ticket): ?>
                                        <tr class="klikbaar">
                                            <td>
                                                <a href="./?control=admin&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>"></a>
                                                <?php echo $ticket->geefId(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefAfspraak_datum(); ?>
                                            </td>
                                            <td>
                                                <?php echo $ticket->geefTijdstip(); ?>
                                            </td>
                                            <!--KLANT INFORMATIE-->
                                            <?php foreach ($klanten as $klant): ?>
                                                <?php if ($ticket->geefKlant_id() === $klant->geefId())://kijkt of het de juiste klant is ?>
                                                    <td>
                                                        <?php echo $klant->geefVoornaam(); ?>
                                                        <?php echo $klant->geefTussenvoegsel(); ?>
                                                        <?php echo $klant->geefAchternaam(); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $klant->geefPostcode(); ?> -
                                                        <?php echo $klant->geefHuisnummer(); ?>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <!--KLANT INFORMATIE-->


                                            <!--Expert-->
                                            <?php foreach ($gebruikers as $gebruiker): ?>
                                                <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                                    <td>
                                                        <?php echo $gebruiker->geefNaam(); ?>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <!--EINDE EXPERT-->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <script>
                            //maakt de tabelrij klikbaar
                            $('.klikbaar').click(function () {
                                window.location = $(this).find('a').attr('href');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $("select").change(checkOption);

        function checkOption()
        {

            var textInvoer = $("[name=waardeInput]");
            var dateInvoer = $("[name=waardeDate]");
            var option = $("#zoek").val();

            if (option !== 'afspraakDatum')
            {
                dateInvoer.remove();
                $("#inputZoeken").append(" <input type='text' placeholder='Vul in' name='waardeInput'> ");
                if(textInvoer >= [0])
                {
                    textInvoer.remove();
                }

            }
            else
            {
                textInvoer.remove();
               $("#inputZoeken").append(" <input type='date' required name='waardeDate'> ");

            }

        }

    </script>
</html>