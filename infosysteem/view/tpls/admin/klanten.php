<!DOCTYPE html>
<html>
    <head>
        <title>Klanten</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Begin Navigatie !-->
        <?php include_once("includes/topNavigatie.php"); ?>
        <!-- Einde Navigatie !-->
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <ol class="breadcrumb">


                            <li class="active">Klanten</li>
                            <li><a href="./?control=admin&action=klantToevoegen">Klant toevoegen</a></li>
                        </ol>
                        <!--ZOEK FUNCTIE-->
                        <form action="." method="post" class="pure-form" style="float:right;">
                            <input type='hidden' name="action" value="klanten">
                            <input type='hidden' name="control" value="admin">
                            <label>Zoek op</label>
                            <select name="zoek">
                                <option value="voornaam">voornaam</option>
                                <option value="achternaam">achternaam</option>
                                <option value="postcode">postcode</option>
                                <option value="id">klantnummer</option>
                                <option value="email">email</option>
                                <option value="bedrijf">bedrijf</option>
                                <option value="telefoon">telefoonnummer</option>
                                <option value="huisnummer">huisnummer</option>
                            </select>
                            <input type="text" class="pure-input-rounded" style="width: 120px;" name="waarde"  placeholder="Vul in">
                            <label>|</label>

                            <!--
                            <select name="zoek2">
                                <option value="voornaam">voornaam</option>
                                <option value="achternaam" selected="selected">achternaam</option>
                                <option value="postcode">postcode</option>
                                <option value="id">klantnummer</option>
                                <option value="email">email</option>
                                <option value="bedrijf">bedrijf</option>
                                <option value="telefoon">telefoonnummer</option>
                                <option value="huisnummer">huisnummer</option>
                            </select>
                            <input type="text" class="pure-input-rounded" style="width: 120px;" name="waarde2"  placeholder="Vul in">
                            !-->


                            <button type="submit" class="zoek-button">&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </form>


                        <h1>Klanten</h1>
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th class="hidden-xs " style="color:white;">Nr.</th>
                                    <th class="hidden-xs " style="color:white;">Naam</th>
                                    <th class="hidden-xs " style="color:white;">Adres</th>
                                    <th class="hidden-xs " style="color:white;">Postcode</th>
                                    <th class="hidden-xs " style="color:white;">Woonplaats</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($klanten as $klant): ?>
                                    <tr class="klikbaar">
                                        <td><?php echo $klant->geefId(); ?></td>
                                        <td>
                                            <a href="./?control=admin&action=klant&klant_id=<?php echo $klant->geefId(); ?>"></a>
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
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <script>
                            $('.klikbaar').click(function() {
                                window.location = $(this).find('a').attr('href');
                            });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </body>
</html>