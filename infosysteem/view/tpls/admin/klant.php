<!DOCTYPE html>
<html>
    <head>
        <title>Klant</title>
        <?php include_once("includes/link.php"); ?>
    </head>
    <body class="page-header-fixed bg-1">
        <?php include_once("includes/topNavigatie.php");?>
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
                        <ol class="breadcrumb">

                                <li><a href="./?control=admin&action=klanten">Klanten</a></li>
                                <li class="active"><?php echo $klant->geefVoornaam()." "; echo $klant->geefTussenvoegsel()." "; echo $klant->geefAchternaam(); ?></li>

                            </ol>
            <h1>Klant</h1>
            <table class="table table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th class="hidden-xs " style="color:white;">Naam</th>
                        <th class="hidden-xs " style="color:white;">Adres</th>
                        <th class="hidden-xs " style="color:white;">Postcode</th>
                        <th class="hidden-xs " style="color:white;">Woonplaats</th>
                        <th class="hidden-xs " style="color:white;">Bedrijf</th>
                        <th class="hidden-xs " style="color:white;">Email</th>
                        <th class="hidden-xs " style="color:white;">Telefoon</th>
                        <th class="hidden-xs " style="color:white;">Mobiel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $klant->geefVoornaam();?>
                            <?php echo $klant->geefTussenvoegsel();?>
                            <?php echo $klant->geefAchternaam();?>
                        </td>
                        <td>
                            <?php echo $klant->geefStraatnaam();?>
                            <?php echo $klant->geefHuisnummer();?>
                        </td>
                        <td>
                            <?php echo $klant->geefPostcode();?>
                        </td>
                        <td>
                            <?php echo $klant->geefWoonplaats();?>
                        </td>
                        <td>
                            <?php echo $klant->geefBedrijf();?>
                        </td>
                        <td>
                            <?php echo $klant->geefEmail();?>
                        </td>
                        <td>
                            <?php echo $klant->geefTelefoon();?>
                        </td>
                        <td>
                            <?php echo $klant->geefMobiel();?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="./?control=admin&action=klantWijzigen&klant_id=<?php echo $klant->geefId()?>">
                Wijzig klant gegevens
            </a>
            
            <br/><br/>
            
            <h1>Tickets</h1>
            <table class="table table-bordered table-striped dataTable">
                <thead>
                    <th class="hidden-xs " style="color:white;">Ticket</th>
                    <th class="hidden-xs " style="color:white;">Tijdstip</th>
                    <th class="hidden-xs " style="color:white;">Status</th>
                    <th class="hidden-xs " style="color:white;">Aanmaak datum</th>
                    <th class="hidden-xs " style="color:white;">Afspraak datum</th>
                    <th class="hidden-xs " style="color:white;">Bezoek datum</th>
                    <th class="hidden-xs " style="color:white;">Sluit datum</th>
                    <th class="hidden-xs " style="color:white;">Wijzigen</th>
                    <th class="hidden-xs " style="color:white;">Verwijderen</th>
                    
                </thead>
                <tbody>
                    <?php if(isset($tickets) && !empty($tickets)):?>
                        <?php foreach($tickets as $ticket):?>
                        <tr>
                            <td>
                                <?php echo $ticket->geefId();?>
                            </td>
                            <td>
                                <?php echo $ticket->geefTijdstip();?>
                            </td>

                            <td>
                                <?php echo $ticket->geefStatus();?>
                            </td>
                            <td>
                                <?php echo $ticket->geefAanmaak_datum();?>
                            </td>
                            <td>
                                <?php echo $ticket->geefAfspraak_datum();?>
                            </td>
                            <td>
                                <?php echo $ticket->geefBezoek_datum();?>
                            </td>
                            <td>
                                <?php echo $ticket->geefSluit_datum();?>
                            </td>
                            <td class="eind_cel">
                                <a href="./?control=admin&action=ticketWijzigen&ticket_id=<?php echo $ticket->geefId()?>&klant_id=<?php echo $klant->geefId();?>">
                                    Wijzigen
                                </a>
                            </td>
                            <td class="eind_cel">
                                <a href="./?control=admin&action=ticketVerwijderen&ticket_id=<?php echo $ticket->geefId()?>&klant_id=<?php echo $klant->geefId();?>" onclick="return confirm('Weet je het zeker?')">
                                    Verwijderen
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                                
                    <?php endif;?>
                </tbody>
            </table>
            <?php if(empty($tickets)):?>  
                <h3>Geen tickets gevonden</h3>
            <?php endif;?>
            <a href="./?control=admin&action=ticketToevoegen&klant_id=<?php echo $klant->geefId();?>">
                Voeg een nieuw ticket toe
            </a>
            
            <br/><br/>
                
            <div class="informatie">
                <h1>E-mail Adressen</h1>
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th class="hidden-xs " style="color:white;">Nummer</th>
                            <th class="hidden-xs " style="color:white;">Mail adres</th>
                            <th class="hidden-xs " style="color:white;">Wijzigen</th>
                            <th class="hidden-xs " style="color:white;">Verwijderen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $teller = 1;?>
                        <?php foreach ($mails as $mail):?>
                        <tr>
                            <td>
                                <?php echo $teller++;?>
                            </td>
                            <td>
                                <?php echo $mail->geefMail();?>
                            </td>
                            <td class="eind_cel">
                                <a href="./?control=admin&action=mailWijzigen&mail_id=<?php echo $mail->geefId()?>&klant_id=<?php echo $klant->geefId();?>">
                                    Wijzigen
                                </a>
                            </td>
                            <td class="eind_cel">
                                <a href="./?control=admin&action=mailVerwijderen&mail_id=<?php echo $mail->geefId()?>&klant_id=<?php echo $klant->geefId();?>" onclick="return confirm('Weet je het zeker?')">
                                    Verwijderen
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <br/>

                <form action="." method="post" class="pure-form">
                    <input type='hidden' name="action" value="mailToevoegen">
                    <input type='hidden' name="control" value="admin">
                    <input type='hidden' name="klant_id" value="<?php echo $klant->geefId()?>">
                    <label>Mail</label>
                    <input type="email" class="pure-input-rounded" style="width:100px;" name="mail" required="required">

                    <button type="submit" class="pure-button pure-button-primary"> Voeg een mail toe</button>
                </form>
            </div>
            
            
            <div class="informatie">
                <h1>Server gegevens</h1>
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th class="hidden-xs " style="color:white;"> Naam </th>
                            <th class="hidden-xs " style="color:white;"> Ip adress </th>
                            <th class="hidden-xs " style="color:white;"> Inlognaam </th>
                            <th class="hidden-xs " style="color:white;"> Wachtwoord </th>
                            <th class="hidden-xs " style="color:white;">Wijzigen</th>
                            <th class="hidden-xs " style="color:white;">Verwijderen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servers as $server):?>
                        <tr>
                            <td>
                                <?php echo $server->geefNaam();?>
                            </td>
                            <td>
                                <?php echo $server->geefIp();?>
                            </td>
                            <td>
                                <?php echo $server->geefInlognaam();?>
                            </td>
                            <td>
                                <?php echo $server->geefWachtwoord();?>
                            </td>
                            <td class="eind_cel">
                                <a href="./?control=admin&action=serverWijzigen&server_id=<?php echo $server->geefId()?>">
                                    Wijzigen
                                </a>
                            </td>
                            <td class="eind_cel">
                                <a href="./?control=admin&action=serverVerwijderen&server_id=<?php echo $server->geefId()?>&klant_id=<?php echo $server->geefKlant_id()?>" onclick="return confirm('Weet je het zeker?')">
                                    Verwijderen
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <br/>
                <a href="./?control=admin&action=serverToevoegen&klant_id=<?php echo $klant->geefId();?>">
                    Toevoegen
                </a>
            </div>
            
            <div class="break" style="border-bottom: 1px solid #e4e4e4;"></div>
            
            <div class="informatie">
                <h1>Facturen/Offertes</h1>
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <th class="hidden-xs " style="color:white;">Datum</th>
                        <th class="hidden-xs " style="color:white;">Pdf</th>
                        <th class="hidden-xs " style="color:white;">Soort</th>
                        <th class="hidden-xs " style="color:white;">Status</th>
                        
                    </thead>
                    <tbody>
                        <?php if(isset($facturen) && !empty($facturen)):?>
                            <?php foreach($facturen as $factuur):?>
                            <tr>
                                <td>
                                    <?php echo $factuur->geefDatum();?>
                                </td>
                                <td>
                                    <a href="<?php echo $factuur->geefPdf();?>" target="_blank">
                                        <?php echo $factuur->geefPdf();?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $factuur->geefSoort();?>
                                </td>
                                <td>
                                    <?php if($factuur->geefStatus() == 'niet verzonden'):?>
                                    <a href="./?control=admin&action=verzendmail&factuur_id=<?php echo $factuur->geefId();?>&klant_id=<?php echo $factuur->geefKlant_id();?>" >
                                        <button>
                                            Verzend
                                        </button>
                                    </a>
                                    <?php else:?>
                                        <?php echo $factuur->geefStatus();?>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
                <?php if(empty($facturen)):?>  
                    <h3>Geen factuur gevonden</h3>
                <?php endif;?>
            </div>
            
            <div class="break"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>