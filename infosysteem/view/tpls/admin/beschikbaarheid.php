<!DOCTYPE html>
<html>
    <head>
        <title>AIS - Expert Beschikbaarheid</title>
        <?php include_once("includes/link.php"); ?>
    </head>

    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php"); ?>
        <div class="row">
            <div class="container">
                <div class="col-md-12">
                    <div class="widget-container fluid-height">
                        <div class="heading bgcolor1">
                            Weeknummer
                        </div>
                        <div class="widget-content padded">
                            <form action="." method="post" class="pure-form zoek">
                                <input type='hidden' name="action" value="weekNummer">
                                <input type='hidden' name="control" value="admin">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label>Weeknummer</label>
                                        <input value="<?php if(isset($_POST['weeknummer']) && !empty($_POST['weeknummer'])) { echo $_POST['weeknummer']; }  ?>" type="number" required class="pure-input-rounded" style="width:200px;" min="1" max="52" name="weeknummer">
                                        <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                    </div>
                                </div>
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
                                    <div class="h1">Beschikbaarheid</div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table id="beschikbaarheid" class="table table-bordered table-striped">
                                                <input type="hidden" name="beschikbaarheid_id" value="<?php echo $beschikbaarheid['id']; ?>" />
                                                <thead>
                                                <th class="hidden-xs " style="color:white;">Datum</th>
                                                <th class="hidden-xs " style="color:white;">Dag</th>
                                                <th class="hidden-xs " style="color:white;">Voeg uren toe</th>
                                                </thead>
                                                <tbody>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[1])); ?> </td>
                                                        <td>
                                                            Maandag
                                                        </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalMa">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[2])); ?> </td>
                                                        <td>
                                                            Dinsdag
                                                        </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalDi">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[3])); ?> </td>
                                                        <td>
                                                            Woensdag
                                                        </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalWo">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[4])); ?> </td>
                                                        <td> Donderdag </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalDo">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[5])); ?> </td>
                                                        <td>
                                                            Vrijdag
                                                        </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalVr">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[6])); ?> </td>
                                                        <td>
                                                            Zaterdag
                                                        </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalZa">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="rowToClone">
                                                        <td> <?php echo date("d-m-Y", strtotime($dates[7])); ?> </td>
                                                        <td>
                                                            Zondag
                                                        </td>
                                                        <td>
                                                            <!-- Large modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalZo">Voeg beschikbaarheid toe</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!--        !!!MODALSSSS!!!        -->

        <!--         Maandag-->
        <div class="modal fade modalMa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content padded">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Maandag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="beschikbaarheid" >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Status </th>
                                    </thead>
                                    <tbody>
                                        <tr name="Ma_uren">
                                            <td>
                                                <select name="Ma_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Ma_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Ma_status">
                                                    <option name="beschikbaar"> Beschikbaar </option>
                                                    <option name="niet beschikbaar"> Niet beschikbaar </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Ma_addRow"> </button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit" class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--         Dinsdag-->
        <div class="modal fade modalDi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Dinsdag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="beschikbaarheid">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    </thead>
                                    <tbody>
                                        <tr name="Di_uren">
                                            <td>
                                                <select name="Di_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Di_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Di_addRow"> </button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit"  class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--         Woensdag-->
        <div class="modal fade modalWo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Woensdag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="beschikbaarheid" >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    </thead>
                                    <tbody>
                                        <tr name="Wo_uren">
                                            <td>
                                                <select name="Wo_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Wo_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Wo_addRow"> </button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit"  class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--         Donderdag-->
        <div class="modal fade modalDo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Donderdag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="beschikbaarheid" >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    </thead>
                                    <tbody>
                                        <tr name="Do_uren">
                                            <td>
                                                <select name="Do_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Do_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Do_addRow"> </button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit"  class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--         Vrijdag-->
        <div class="modal fade modalVr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Vrijdag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="beschikbaarheid" >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    </thead>
                                    <tbody>
                                        <tr name="Vr_uren">
                                            <td>
                                                <select name="Vr_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Vr_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Vr_addRow"> </button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit" class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--         Zaterdag-->
        <div class="modal fade modalZa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Zaterdag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="beschikbaarheid" >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    </thead>
                                    <tbody>
                                        <tr name="Za_uren">
                                            <td>
                                                <select name="Za_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Za_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Za_addRow"> </button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit"  class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--         Zondag-->
        <div class="modal fade modalZo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beschikbaarheid voor: Zondag</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action=".">
                                <input type="hidden" name="control" value="admin" >
                                <input type="hidden" name="action" value="bInvoer" >
                                
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Van </th>
                                    <th class="hidden-xs " style="color:white;width:20%;"> Tot </th>
                                    </thead>

                                    <tbody>
                                        <tr name="Zo_uren">
                                            <td>
                                                <select name="Zo_uurVan">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="Zo_uurTot">
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a> <button type="button" class="glyphicon glyphicon-plus-sign" name="Zo_addRow"></button> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;">
                                                <button type="submit" class="btn btn-success">Opslaan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script>

        var dagen = ["Ma", "Di", "Wo", "Do", "Vr", "Za", "Zo"];
        var lengte = dagen.length;

        var i = 0;
        var x = 0;
        var y = 0;
        var xy = 0;
        // functie voor maandag
        $('[name=Ma_addRow]').click(function (){
            if(x < 1)
            {
                $('[name="Ma_uren"]').clone().attr('name', 'Ma_uren'+[y]).insertAfter('[name="Ma_uren"]');
                x++;
                y++;
            }else{
                $('[name="Ma_uren"]').clone().attr('name', 'Ma_uren'+[y]).insertAfter('[name="Ma_uren'+[xy]+'"]');
                y++;
                xy++;
            }
        });
        // functie voor dinsdag
        $('[name=Di_addRow]').click(function (){
            if(x < 1)
            {
                $('[name="Di_uren"]').clone().attr('name', 'Di_uren'+[y]).insertAfter('[name="Di_uren"]');
                x++;
                y++;
            }else{
                $('[name="Di_uren"]').clone().attr('name', 'Di_uren'+[y]).insertAfter('[name="Di_uren'+[xy]+'"]');
                y++;
                xy++;
            }
        });
        // functie voor woensdag
        $('[name=Wo_addRow]').click(function (){
            if(x < 1)
            {
                $('[name="Wo_uren"]').clone().attr('name', 'Wo_uren'+[y]).insertAfter('[name="Wo_uren"]');
                x++;
                y++;
            }else{
                $('[name="Wo_uren"]').clone().attr('name', 'Wo_uren'+[y]).insertAfter('[name="Wo_uren'+[xy]+'"]');
                y++;
                xy++;
            }
        });

        // functie voor donderdag
        $('[name=Do_addRow]').click(function (){
            if(x < 1)
            {
                $('[name="Do_uren"]').clone().attr('name', 'Do_uren'+[y]).insertAfter('[name="Do_uren"]');
                x++;
                y++;
            }else{
                $('[name="Do_uren"]').clone().attr('name', 'Do_uren'+[y]).insertAfter('[name="Do_uren'+[xy]+'"]');
                y++;
                xy++;
            }
        });
        // functie voor vrijdag
        $('[name=Vr_addRow]').click(function (){
            if(x < 1)
            {
                $('[name="Vr_uren"]').clone().attr('name', 'Vr_uren'+[y]).insertAfter('[name="Vr_uren"]');
                x++;
                y++;
            }else{
                $('[name="Vr_uren"]').clone().attr('name', 'Vr_uren'+[y]).insertAfter('[name="Vr_uren'+[xy]+'"]');
                y++;
                xy++;
            }
        });
        // functie voor zaterdag
        $('[name=Za_addRow]').click(function (){
            if(x < 1)
            {
                $('[name="Za_uren"]').clone().attr('name', 'Za_uren'+[y]).insertAfter('[name="Za_uren"]');
                x++;
                y++;
            }else{
                $('[name="Za_uren"]').clone().attr('name', 'Za_uren'+[y]).insertAfter('[name="Za_uren'+[xy]+'"]');
                y++;
                xy++;
            }
        });

        // functie voor zondag
        $('[name=Zo_addRow]').click(function (){
        if(x < 1)
        {
            $('[name="Zo_uren"]').clone().attr('name', 'Zo_uren'+[y]).insertAfter('[name="Zo_uren"]');
            x++;
            y++;
        }else{
            $('[name="Zo_uren"]').clone().attr('name', 'Zo_uren'+[y]).insertAfter('[name="Zo_uren'+[xy]+'"]');
            y++;
            xy++;
        }
        });

    </script>

</html>