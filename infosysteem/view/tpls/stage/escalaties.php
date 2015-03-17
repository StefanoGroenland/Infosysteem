<!DOCTYPE html>
<html>
    <head>
        <title>Escalaties</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <main>
                            <!--ZOEK FUNCTIE-->
                            <form action="." method="post" class="pure-form" style="float:right;">
                                <input type='hidden' name="action" value="escalaties">
                                <input type='hidden' name="control" value="stage">

                                <label>Ticket nummer</label>
                                <input type="text" class="pure-input-rounded" style="width:100px;" name="nummer">

                                <label>| Periode</label>
                                <select name="periode" id="periode">
                                    <option value="geen" >geen</option>
                                    <option value="aanmaak">aanmaak</option>
                                    <option value="afspraak">afspraak</option>
                                    <option value="bezoek">bezoek</option>
                                    <option value="sluit">sluit</option>
                                </select>

                                <input type="text"  id="datepicker" class="pure-input-rounded" name="datum">

                                <script>
                                    $(function() {
                                        //$( "#datepicker" ).datepicker();
                                        $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                        $('#datepicker').attr("disabled", "disabled");
                                    });
                                    //zorgt ervoor dat datum wordt disabled als je geen kiest
                                    $("select").change(checkDatum);
                                    checkDatum();
                                    function checkDatum()
                                    {
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

                            <h1>Escalaties</h1>
                            <table class="table table-bordered table-striped" id="dataTable1">
                                <thead>
                                <th class="hidden-xs " style="color:white;">Nr.</th>
                                <th class="hidden-xs " style="color:white;">Tijdstip</th>
                                <th class="hidden-xs " style="color:white;">Klant</th>
                                <th class="hidden-xs " style="color:white;">Adres</th>
                                <th class="hidden-xs " style="color:white;">Postcode</th>
                                <th class="hidden-xs " style="color:white;">Woonplaats</th>
                                <th class="hidden-xs " style="color:white;">Afspraak datum</th>
                                <th class="hidden-xs " style="color:white;">Expert</th>
                                <th class="hidden-xs " style="color:white;">Escalatie</th>
                                <th class="hidden-xs " style="color:white;">Antwoord</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($tickets) && !empty($tickets)): ?>
                                        <?php foreach ($tickets as $ticket): ?>
                                            <tr class="klikbaar">
                                                <td>
                                                    <a href="./?control=stage&action=ticket&ticket_id=<?php echo $ticket->geefId(); ?>&klant_id=<?php echo $ticket->geefKlant_id(); ?>"></a>
                                                    <?php echo $ticket->geefId(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $ticket->geefTijdstip(); ?>
                                                </td>
                                                <!--KLANT INFORMATIE-->
                                                <?php foreach ($klanten as $klant): ?>
                                                    <?php if ($ticket->geefKlant_id() === $klant->geefId())://kijkt of het de juiste klant is?>
                                                        <td>
                                                            <?php echo $klant->geefVoornaam(); ?>
                                                            <?php echo $klant->geefTussenvoegsel(); ?>
                                                            <?php echo $klant->geefAchternaam(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $klant->geefStraatnaam(); ?>
                                                            <?php echo $klant->geefHuisnummer(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $klant->geefPostcode(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $klant->geefWoonplaats(); ?>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!--EINDE KLANT INFORMATIE-->
                                                <td>
                                                    <?php echo $ticket->geefAfspraak_datum(); ?>
                                                </td>
                                                <!--GEBRUIKER-->
                                                <?php foreach ($gebruikers as $gebruiker): ?>
                                                    <?php if ($ticket->geefGebruiker_id() === $gebruiker->geefId()): ?>
                                                        <td>
                                                            <?php echo $gebruiker->geefNaam(); ?>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!--EINDE GEBRUIKER-->
                                                <td>
                                                    <?php echo $ticket->geefEscalatie(); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $i = $ticket->geefAntwoord_escalatie();
                                                    if (empty($i)):
                                                        ?>
                                                        <?php if ($ticket->geefGebruiker_id() === $_SESSION['gebruiker']->geefId()): ?>
                                                            Er is geen antwoord gegeven<br/>
                                                            <a href="./?control=stage&action=escalatieAntwoordToevoegen&ticket_id=<?php echo $ticket->geefId() ?>"> <img src="./img/toevoegen.png"/>Vul een antwoord in</a>
                                                        <?php endif; ?>
                                                        <?php if ($ticket->geefGebruiker_id() !== $_SESSION['gebruiker']->geefId()): ?>
                                                            Er is geen antwoord gegeven
                                                        <?php endif; ?>
                                                        <?php
                                                    endif;
                                                    if (!empty($i)) {
                                                        echo $i;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <script>
                                //maakt de tabelrij klikbaar
                                $('.klikbaar').click(function() {
                                    window.location = $(this).find('a').attr('href');
                                });
                            </script>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>