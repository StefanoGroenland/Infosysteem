<!DOCTYPE html>
<html>
    <head>
        <title>Gebruikers beheren</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <?php include_once("includes/topNavigatie.php"); ?>
                        <main>
                            <ol class="breadcrumb">
                                <li class="active">Beheer</li>
                                <li><a href="./?control=admin&action=gebruikerToevoegen">Voeg gebruiker toe</a></li>
                                <li><a href="./?control=admin&action=klantGebruikerToevoegen">Voeg klant gebruiker toe</a></li>
                            </ol>
                            <h1>Gebruikers beheren</h1>
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                <th class="hidden-xs " style="color:white;">Naam</th>
                                <th class="hidden-xs " style="color:white;">Mail</th>
                                <th class="hidden-xs " style="color:white;">Recht</th>
                                <th class="hidden-xs " style="color:white;">Klant Nr.</th>
                                <th class="hidden-xs " style="color:white;">Wijzig</th>
                                <th class="hidden-xs " style="color:white;">Verwijder</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($gebruikers as $gebruiker): ?>
                                        <tr>
                                            <td><?php echo $gebruiker->geefNaam(); ?></td>
                                            <td><?php echo $gebruiker->geefMail(); ?></td>
                                            <td><?php echo $gebruiker->geefRecht(); ?></td>
                                            <td>
                                                <?php
                                                if ($gebruiker->geefRecht() == 'klant') {
                                                    echo $gebruiker->geefKlant_id();
                                                }
                                                ?>
                                            </td>
                                            <td class="eind_cel">
                                                <a href="./?control=admin&action=gebruikerWijzigen&gebruiker_id=<?php echo $gebruiker->geefId(); ?>">
                                                    <!--<img src="./img/wijzig.png"/>-->
                                                    Wijzig
                                                </a>
                                            </td>
                                            <td class="eind_cel">
                                                <a href="./?control=admin&action=gebruikerVerwijderen&gebruiker_id=<?php echo $gebruiker->geefId() ?>" onclick="return confirm('Weet je het zeker?')">
                                                    <!--<img src="./img/verwijder.png"/>-->
                                                    Verwijder
                                                </a>
                                            </td>
                                        </tr>
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