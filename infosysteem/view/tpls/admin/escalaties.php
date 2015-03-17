<!DOCTYPE html>
<html>
    <head>
        <title>Escalaties</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="row">
            <div class="container">
            <div class="col-md-12">
                <div class="widget-container fluid-height">
                    <div class="heading bgcolor1">
                        Zoeken
                    </div>
                    <div class="widget-content padded">
                        <form action="." method="post" class="pure-form zoek">
                            <input type='hidden' name="action" value="escalaties">
                            <input type='hidden' name="control" value="admin">

                            <label>Ticket nummer</label>
                            <input type="number" class="pure-input-rounded" style="width:100px;" name="nummer"
                                   placeholder="Vul in">

                            <label> Periode</label>
                            <select name="periode" id="periode">
                                <option value="geen">geen</option>
                                <option value="aanmaak">aanmaak</option>
                                <option value="afspraak">afspraak</option>
                                <option value="sluit">sluit</option>
                            </select>

                            <input type="text" id="datepicker" class="pure-input-rounded" name="datum"
                                   placeholder="Selecteer datum">
                            <script>
                                $(function () {
                                    //$( "#datepicker" ).datepicker();
                                    $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
                                    $('#datepicker').attr("disabled", "disabled");
                                });
                                //zorgt ervoor dat datum wordt disabled als je geen kiest
                                $("select").change(checkDatum);
                                checkDatum();
                                function checkDatum() {
                                    var periode = $("#periode").val();
                                    if (periode === 'geen') {
                                        $('#datepicker').attr("disabled", "disabled");
                                    }
                                    else {
                                        $('#datepicker').removeAttr("disabled");
                                    }
                                }
                            </script>

                            <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="widget-container fluid-height">
                    <div class="widget-content padded clearfix">
                        <div class="widget-content clearfix">
                            <main>
                                <h1>Escalaties</h1>
                                <table class="table table-bordered table-striped dataTable" id="dataTable1">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;">Nr.</th>
                                    <th class="hidden-xs " style="color:white;">Escalatie Aangemaakt</th>
                                    <th class="hidden-xs " style="color:white;">Betrokken Klant</th>
                                    <th class="hidden-xs " style="color:white;">Betrokken Expert</th>
                                    <th class="hidden-xs " style="color:white;">Afspraak datum</th>
                                    <th class="hidden-xs " style="color:white;">Sluit datum</th>
                                    <th class="hidden-xs " style="color:white;">Admin</th>
                                    </thead>
                                    <tbody>
                                        <?php $x = 0; ?>
                                        <?php foreach ($escalaties as $escalatie) : ?>

                                            <tr class="klikbaar">
                                                <td>
                                                    <a href=".?control=admin&action=ticket&ticket_id=<?php echo $tickets[$x]['id']; ?>&klant_id=<?php echo $klanten[$x]['id']; ?>">
                                                        <?php echo $escalatie['id']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo date("d-m-Y", strtotime($escalatie['e_datum_aangemaakt'])); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($klanten as $klant)
                                                    {

                                                        if ($tickets[$x]['klant_id'] === $klant['id'] && $i < 1)
                                                        {

                                                            echo $klant['voornaam'] . ' ';
                                                            echo $klant['tussenvoegsel'] . ' ';
                                                            echo $klant['achternaam'];
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>

                                                    <?php
                                                    $i = 0;
                                                    foreach ($experts as $expert)
                                                    {

                                                        if ($tickets[$x]['gebruiker_id'] === $expert['id'] && $i < 1)
                                                        {
                                                            echo $expert['voornaam'] . ' ';
                                                            echo $expert['tussenvoegsel'] . ' ';
                                                            echo $expert['achternaam'];
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo date("d-m-Y", strtotime($tickets[$x]['afspraak_datum'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo date("d-m-Y", strtotime($tickets[$x]['sluit_datum'])); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $i = 0;

                                                    $gebruiker_id = $tickets[$x]['gebruiker_id'];

                                                    foreach ($admins as $admin)
                                                    {
                                                        $adminId = $admin[0]['id'];


                                                        if ($gebruiker_id === $adminId && $i < 1)
                                                        {

                                                            echo $admin[0]['voornaam'] . ' ';
                                                            echo $admin[0]['tussenvoegsel'] . ' ';
                                                            echo $admin[0]['achternaam'];
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>

                                            <?php $x++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <script>
                                    //maakt de tabelrij klikbaar
                                    $('.klikbaar').click(function () {
                                        window.location = $(this).find('a').attr('href');
                                    });
                                </script>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>