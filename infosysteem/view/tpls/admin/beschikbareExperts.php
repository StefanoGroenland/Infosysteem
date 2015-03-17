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
                        <input type='hidden' name="action" value="beschikbareExperts">
                        <input type='hidden' name="control" value="admin">
                        <div class="row">
                        <div class="col-lg-8">
                        <label>Datum</label>
                        <input type="date" class="pure-input-rounded" style="width:200px;" name="datum">


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
                        </div>

                        <div class="col-lg-4">
                        <div class="h4">Datum vandaag : <?php echo date("d-m-Y")?></div>
                            <div class="h4">Week : <?php echo date("W") ?></div>
                            </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="container-fluid">
        <div class="widget-container fluid-height">
            <div class="widget-content padded clearfix">
                <div class="widget-content clearfix">
                    <main>
                        <h1>Beschikbare Experts</h1>
                        <table class="table table-bordered table-striped" id="dataTableLogs">
                            <thead>
                            <th class="hidden-xs " style="color:white;">Expert</th>
                            <th class="hidden-xs " style="color:white;">8:00 t/m 10:00</th>
                            <th class="hidden-xs " style="color:white;">10:00 t/m 12:00</th>
                            <th class="hidden-xs " style="color:white;">12:00 t/m 14:00</th>
                            <th class="hidden-xs " style="color:white;">14:00 t/m 16:00</th>
                            <th class="hidden-xs " style="color:white;">16:00 t/m 18:00</th>
                            <th class="hidden-xs " style="color:white;width:13%;">18:00 t/m 20:00</th>
                            <th class="hidden-xs " style="color:white;width:13%;">20:00 t/m 22:00</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Expert naamw1</td>
                                <td style="background-color:green;color:white;text-align:center">08:00/10:00</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:red;color:white;text-align:center">xx:xx/xx:xx</td>

                            </tr>
                            <tr>
                                <td>Expert naamw2</td>
                                <td style="background-color:green;color:white;text-align:center">08:00/10:00</td>
                                <td style="background-color:red;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:red;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:red;color:white;text-align:center">xx:xx/xx:xx</td>

                            </tr>
                            <tr>
                                <td>Expert naamw3</td>
                                <td style="background-color:green;color:white;text-align:center">08:00/10:00</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:red;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:green;color:white;text-align:center">10:00/12:00</td>
                                <td style="background-color:orange;color:white;text-align:center">10:00/10:30</td>
                                <td style="background-color:red;color:white;text-align:center">xx:xx/xx:xx</td>

                            </tr>
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


