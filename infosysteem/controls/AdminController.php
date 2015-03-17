<?php

namespace infosysteem\controls;

use infosysteem\models as MODELS;
use infosysteem\view as VIEW;

class AdminController
{

    private $action;
    private $control;
    private $view;
    private $model;

    public function __construct($control, $action)
    {
        $this->control = $control;
        $this->action = $action;

        $this->view = new VIEW\View();
        $this->model = new MODELS\AdminModel();

        $notificaties = $this->model->geefNotificatie();
        $this->view->set('notificaties', $notificaties);

        $isGerechtigd = $this->model->isGerechtigd();

        if ($isGerechtigd != true)
        {
            $this->forward('default', 'bezoeker');
        }
    }

    public function execute()
    {
        $opdracht = $this->action . 'Action';
        if (!method_exists($this, $opdracht))
        {
            $opdracht = 'defaultAction';
            $this->action = 'default';
        }
        $this->$opdracht();
        //de request wordt gevuld met de huidige action,
        //zodat de juiste item in de navigatie een active-class kan krijgen
        $_REQUEST['action'] = $this->action;

        $this->view->setAction($this->action);
        $this->view->setControl($this->control);
        $this->view->toon();
    }

    public function forward($action, $control)
    {
        $klasseNaam = __NAMESPACE__ . '\\' . ucFirst($control) . 'Controller';
        $controller = new $klasseNaam($control, $action);
        $controller->execute();
        exit();
    }

    public function uitloggenAction()
    {
        $_SESSION = array();
        session_destroy();
        $this->forward('default', 'bezoeker');
    }

    //de default is de eerste functie wat wordt gedaan als er wordt ingelogd
    //de eerste default pagina is de dashboard
    private function defaultAction()
    {
        $tickets = $this->model->geefDagTickets();
        if (!empty($tickets) && isset($tickets))
        {

            $this->view->set('tickets', $tickets);

            $gebruikers = $this->model->geefGebruikers();
            $this->view->set('gebruikers', $gebruikers);

            $klanten = $this->model->geefKlantenVanVandaag($tickets);
            $this->view->set('klanten', $klanten);
        } else
        {
            $this->model->foutGoedMelding('warning', 'Er zijn voor vandaag geen tickets! ');
        }
        $storingen = $this->model->geefLaatsteStoringen();
        $this->view->set('storingen', $storingen);
    }

    /* ============================
     *          KLANT
      ============================= */

    //een pagina met alle klanten
    private function klantenAction()
    {

        //controlleert of de post naam is gevuld voor de zoek functie
        if (isset($_POST['waarde']) && !empty($_POST['waarde']))
        {
            //haalt alle klanten op die voldoen aan de zoek woord
            $klanten = $this->model->zoekKlanten();
        } else
        {
            //haalt alle klanten op
            $klanten = $this->model->geefKlanten();
        }
        //plaats de klanten in de view
        if ($klanten !== 'LEEG')
        {
            $this->view->set('klanten', $klanten);
        } else
        {
            $this->model->foutGoedMelding('danger', 'Klant bestaat niet');
        }
    }

    //haalt gegevens op van 1 klant
    private function klantAction()
    {
        //haalt de klant op
        $klant = $this->model->geefKlant();
        //plaats de klant in de pagina
        $this->view->set('klant', $klant);

        //haalt de mail adressen op
        $mails = $this->model->geefMails();
        //plaats de mail adressen in de pagina
        $this->view->set('mails', $mails);

        //haalt de mail adressen op
        $servers = $this->model->geefServers();
        //plaats de mail adressen in de pagina
        $this->view->set('servers', $servers);

        //haalt alle problemen op van de aangegeven klant
        $tickets = $this->model->geefKlantTickets();
        //plaats de problemen in de pagina
        $this->view->set('tickets', $tickets);

        //haalt alle problemen op van de aangegeven klant
        $facturen = $this->model->geefKlantFacturen();
        //plaats de problemen in de pagina
        $this->view->set('facturen', $facturen);
    }

    //voegt een klant toe
    private function klantToevoegenAction()
    {
        //controleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            //post gevuld
            //controleer of alle genodigde gegevens zijn ingevuld
            if (isset($_POST['voornaam']) && isset($_POST['achternaam']) && !empty($_POST['voornaam']) && !empty($_POST['achternaam']))
            {
                //maak een klant aan
                $this->model->maakKlant();
                //stuurt je door naar de default pagina
                $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> klant is aangemaakt. <span class="glyphicon glyphicon-saved"></span>');
                $this->model->setLog('Klant toevoegen', 'Gelukt');
                $this->forward('klanten', 'admin');
            }
        }
    }

    //de gegevens van een klant wijzigen
    private function klantWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            //controleer of de juiste gegevens zijn ingevuld die je minimaal moet hebben voor de database
            if (isset($_POST['voornaam']) && !empty($_POST['voornaam']) &&
                    isset($_POST['achternaam']) && !empty($_POST['achternaam']))
            {
                $this->model->wijzigKlant();
                //stuurt je terug naar de klantpagina
                $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> klant is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
                $this->model->setLog('Klant wijzigen', 'Gelukt');
                $this->forward('klant', 'admin');
            }
        } else
        {
            $klant = $this->model->geefKlant();
            $this->view->set('klant', $klant);
        }
    }

    //verwijdert een klant
    private function klantVerwijderenAction()
    {
        $this->model->verwijderKlant();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> klant is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Klant verwijderen', 'Gelukt');
        $this->forward('klanten', 'admin');
    }

    /* ============================
     *          GEBRUIKER
      ============================= */

    //pagina met alle gebruikers om ze te kunnen beheren
    private function gebruikersBeheerAction()
    {
        $gebruikers = $this->model->geefGebruikers();
        $this->view->set('gebruikers', $gebruikers);
    }

    //voegt een gebruiker toe
    private function gebruikerToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            //kijkt of de gebruikersnaam al bestaat en geeft dan een boolean terug
            $bestaatGN = $this->model->bestaatGN();
            //false als de gebruikersnaam niet bestaat
            if ($bestaatGN === FALSE)
            {
                //controleert of de wachtwoorden overeenkomen
                if ($_POST['wachtwoord'] === $_POST['wachtwoord2'])
                {
                    $id = $this->model->maakGebruiker();
                    if (isset($_FILES['foto']))
                    {
                        $this->model->updateFoto($id);
                    }
                    //stuurt je naar de gebruikersbeheer pagina
                    $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> gebruiker is aangemaakt. <span class="glyphicon glyphicon-saved"></span>');
                    $this->model->setLog('Gebruiker toevoegen', 'Gelukt');
                    $this->forward('gebruikersBeheer', 'admin');
                } else
                {
                    $this->view->set('opmerking', 'Wachtwoorden komen niet overeen');
                }
            } else
            {
                $this->view->set('opmerking', 'Gebruikersnaam is al in gebruik');
            }
        }
    }

    //voegt een klant als gebruiker toe
    private function klantGebruikerToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            //kijkt of de gebruikersnaam al bestaat en geeft dan een boolean terug
            $bestaatGN = $this->model->bestaatGN();
            //false als de gebruikersnaam niet bestaat
            if ($bestaatGN === FALSE)
            {
                //controleert of de wachtwoorden overeenkomen
                if ($_POST['wachtwoord'] === $_POST['wachtwoord2'])
                {
                    $this->model->maakKlantGebruiker();
                    //stuurt je naar de gebruikersbeheer pagina
                    $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> klant gebruiker is aangemaakt. <span class="glyphicon glyphicon-saved"></span>');
                    $this->model->setLog('Klang gebruiker aanmaken', 1);
                    $this->forward('gebruikersBeheer', 'admin');
                } else
                {
                    $this->view->set('opmerking', 'Wachtwoorden komen niet overeen');
                }
            } else
            {
                $this->view->set('opmerking', 'Gebruikersnaam is al in gebruik');
            }
        }
        $klanten = $this->model->geefKlanten();
        $this->view->set('klanten', $klanten);
    }

    //wijzigt een gebruiker
    private function gebruikerWijzigenAction()
    {
        //haalt de gebruiker op


        $gebruiker = $this->model->geefGebruikerZonder();

        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            //controleert of er een gebruikersnaam en wachtwoord is meegegeven
            if (isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord']) &&
                    !empty($_POST['gebruikersnaam']) && !empty($_POST['wachtwoord']))
            {
                //kijkt of de gebruikersnaam al bestaat en geeft dan een boolean terug
                $bestaatGN = $this->model->bestaatGNWijzig();
                //false als de gebruikersnaam niet bestaat
                if ($bestaatGN === FALSE)
                {
                    $this->model->wijzigGebruiker();
                    //stuurt je naar de gebruikersbeheer pagina
                    $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> gebruiker is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
                    $this->model->setLog('Gebruiker gewijzigd', 1);
                    $this->forward('gebruikersBeheer', 'admin');
                } else
                {
                    $this->view->set('opmerking', 'Gebruikersnaam is al in gebruik');
                }
            } else
            {
                
            }
        }
        $this->view->set('gebruiker', $gebruiker);
        $standaardWachtwoord = $this->model->geefStandaardWachtwoord();
        $this->view->set('standaardWachtwoord', $standaardWachtwoord);
    }

    //verwijdert een gebruiker
    private function gebruikerVerwijderenAction()
    {
        $this->model->verwijderGebruiker();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> gebruiker verwijderd! <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Gebruiker verwijderen', 1);
        $this->forward('gebruikersBeheer', 'admin');
    }

    //wijzig je eigen wachtwoord
    private function wachtwoordWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            //krijgt opmerkingen terug
            $opmerking = $this->model->wijzigWachtwoord();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> wachtwoord is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Wachtwoord wijzigen', 1);
            $this->view->set('opmerking', $opmerking);
        }
    }

    /* ============================
     *          RAPPORT
      ============================= */

    //pagina met alle rapporten
    private function rapportenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $tickets = $this->model->zoekGeslotenTickets();
            if (isset($_POST['datum']))
            {
                $datum = date("d-m-Y", strtotime($_POST['datum']));
                $this->view->set('datum', $datum);
            }
        } else
        {
            //geeft alle tickets die gesolten zijn, deze tickets hebben een rapport
            $tickets = $this->model->geefGeslotenTickets();
        }
        $this->view->set('tickets', $tickets);
        //geeft alle klanten
        $klanten = $this->model->geefKlanten();
        $this->view->set('klanten', $klanten);


        $this->view->set('gebruikers', $this->model->geefGebruikers());
    }

    //voegd een rapport aan een ticket
    private function rapportToevoegenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            //maakt een rapport(vult de gegevens in de ticket)
            //en zet de status op gesloten
            $this->model->maakRapport();
            //stuurt je naar de ticket pagina
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> rapport is toegevoegd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Rapport toevoegen', 1);
            $this->forward('ticket', 'admin');
        } else
        {
            //geeft de ticket mee om later de ticket en klant id te gebruiken.
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }

    //wijzigt de rapport
    private function rapportWijzigenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigRapport();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> rapport is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Rapport wijzigen', 1);
            $this->forward('ticket', 'admin');
        } else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }

    /* ============================
     *          TICKETS
      ============================= */

    //tickets pagina
    private function ticketsAction()
    {
        if (isset($_POST['zoek']) && !empty($_POST['zoek']))
        {
            $tickets = $this->model->zoekTickets();
            if ($tickets === "ticketBestaatNiet")
            {
                $this->model->foutGoedMelding('danger', 'Ticket bestaat niet!');
            }
        }
        if (!isset($tickets) && empty($tickets) || $tickets === "ticketBestaatNiet")
        {
            $tickets = $this->model->geefTickets();
        }
        $this->view->set('tickets', $tickets);

        $klanten = $this->model->geefKlanten();
        $this->view->set('klanten', $klanten);

        $gebruikers = $this->model->geefGebruikers();
        $this->view->set('gebruikers', $gebruikers);
    }

    //pagina met de ticket informatie
    private function ticketAction()
    {
        //controlleert of de post naam is gevuld voor de zoek functie
        if (isset($_POST['waarde']) && !empty($_POST['waarde']))
        {
            //haalt alle klanten op die voldoen aan de zoek woord
            $tickets = $this->model->zoekTickets();
        } else
        {
            //haalt alle klanten op
            $tickets = $this->model->geefTickets();
        }
        if ($tickets === "ticketBestaatNiet")
        {
            $this->forward('ticket', 'admin');
            $this->model->foutGoedMelding('danger', '<strong> Foutmelding: </strong> Ticket bestaat niet!');
        } else
        {
            //plaats de klanten in de view
            $this->view->set('tickets', $tickets);
            //eind
            $this->view->set('ticket', $this->model->geefTicket());
            $this->view->set('klant', $this->model->geefKlant());
            $this->view->set('gebruikers', $this->model->geefGebruikers());
        }
    }

    //pagina na ticket info voor bezoek rapport en escalatie
    private function ticketbzkAction()
    {
        $ticket = $this->model->geefTicket();
        $this->view->set('ticket', $ticket);

        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);

        $this->view->set('gebruikers', $this->model->geefGebruikers());

        if (!empty($_POST['ticket_id']) && isset($_POST['ticket_id']) && !empty($_POST['escalatie']) && isset($_POST['escalatie']))
        {
            $this->model->wijzigEscalatie();
            $this->model->foutGoedMelding('success', 'Uw escalatie is verzonden.');
            $this->model->setLog('Escalatie toevoegen', 1);
            $this->forward('tickets', 'admin');
        }
        if (!empty($_POST['ticket_id']) && isset($_POST['ticket_id']) && !empty($_POST['antwoord_escalatie']) && isset($_POST['antwoord_escalatie']))
        {
            $this->model->wijzigEscalatieAntwoord();
            $this->model->foutGoedMelding('success', 'Uw antwoord escalatie is verzonden');
            $this->model->setLog('Escalatie antwoord toevoegen', 1);
            $this->forward('tickets', 'admin');
        }
    }

    //wijzigt de ticket
    private function ticketWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigTicket();
            $this->model->setLog('Ticket gewijzigen', 'Gelukt');
            //stuurt je naar de klant pagina
            $this->forward('ticket', 'admin');
        } else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }

    //maakt een nieuwe ticket aan
    private function ticketToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            $ticket_id = $this->model->maakTicket();
            $this->model->voegAgendaEventToe($ticket_id);
            $_SESSION['ticket_id'] = $ticket_id;

            $this->forward('getBeschikbareExpert', 'admin');
        } else
        {
            $this->view->set('gebruikers', $this->model->geefExperts());
            $this->view->set('klant_id', $_REQUEST['klant_id']);
        }
    }

    //verwijdert de ticket
    private function ticketVerwijderenAction()
    {
        $this->model->verwijderTicket();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> ticket is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Ticket verwijderen', 'Gelukt');
        $this->forward('klant', 'admin');
    }

    /* ============================
     *          ESCALATIE
      ============================= */

    private function escalatiesAction()
    {
        if (isset($_POST['ticket_id']) && !empty($_POST['ticket_id']) ||
                isset($_POST['periode']) && !empty($_POST['periode']) ||
                isset($_POST['datum']) && !empty($_POST['datum']))
        {
            $this->view->set('escalatie', $this->model->zoekEscalatiesTickets());
        } else
        {
            $this->view->set('escalaties', $this->model->geefEscalaties());
            $ticket = $this->model->geefTicketsBijEscalatie();
            $this->view->set('tickets', $ticket);
            $this->view->set('klanten', $this->model->geefKlantenBijTickets());
            $this->view->set('experts', $this->model->geefExpertBijTickets());
            $admins = $this->model->geefGebruiker($ticket);

            $this->view->set('admins', $admins);
        }
    }

    private function escalatieAntwoordToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->maakEscalatieAntwoord();
            $this->model->setLog('Escalatie antwoord toevoegen', 'Gelukt');
            $this->forward('ticket', 'admin');
        } else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }

    //wijzigt een escalatie
    private function escalatieWijzigenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigEscalatie();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> escalatie is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Escalatie wijzigen', 'Gelukt');
            $this->forward('ticket', 'admin');
        }

        $ticket = $this->model->geefTicket();
        $this->view->set('ticket', $ticket);
    }

    /* ============================
     *          FACTUREN
      ============================= */

    private function factuurAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            //productenOud zijn de producten die gekozen zijn in de webpagina
            // productenNieuw zijn de producten die gekozen zijn en daarna zijn verkregen van de database.
            $productenOud = $this->model->maakPDF();
            if ($productenOud === 'DUPS')
            {
                $this->model->foutGoedMelding('danger', '<strong> Foutmelding </strong> U heeft 2 dezelfde producten gekozen, gebruik hiervoor het aantal!');
            } else
            {
                $productNieuw = $this->model->geefBesteldeProducten($productenOud);
                $t = 1;
                for ($i = 0; $i < count($productenOud); $i++)
                {
                    // van alle producten die zijn gekozen wordt de aantal voorraad gepakt
                    $voorraadNieuw[$i] = $productNieuw[$i][0]->geefVoorraad();
                    $gekozenAantal[$i] = $productenOud[$i][1];
                    //de einde van de producten wordt d.m.v. count verkregen
                    $eindeArray = count($productenOud);

                    if ($voorraadNieuw[$i] > $gekozenAantal[$i])
                    {
                        $goeieVoorraad = true;
                    } else
                    {
                        $goeieVoorraad = false;
                    }

                    if ($goeieVoorraad !== true)
                    {
                        $this->model->foutGoedMelding('danger', 'Gekozen product(en) is(zijn) niet op voorraad! Controleer het <a href=".?action=magazijn&control=admin">Magazijn <span class="glyphicon glyphicon-link"></span></a>');
                    } else
                    {
                        if ($t === $eindeArray)
                        {
                            $_SESSION['geselecteerdeProducten'] = $productenOud;
                            $this->model->pdfToevoegen();
                            $this->forward('factuurVerzend', 'admin');
                        }
                    }

                    $goeieVoorraad = false;
                    $t++;
                }
            }
        }

        $producten = $this->model->geefProducten();
        $this->view->set('producten', $producten);
        $klanten = $this->model->geefKlanten();
        $this->view->set('klanten', $klanten);
    }

    private function factuurVerzendAction()
    {
        $pdf = $this->model->geefPdfBijNaam();
        $this->view->set('pdf', $pdf);

        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);

        $this->model->setLog('Factuur maken', 'Gelukt');
    }

    private function factuurVerwijderenAction()
    {
        $this->model->verwijderFactuur();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> factuur is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Factuur verwijderen', 'Gelukt');
        $this->forward('factuur', 'admin');
    }

    /* ============================
     *          MAIL
      ============================= */

    private function verzendmailAction()
    {
        $factuur_id = $_POST['Factuur_id'];
        $factuur = $this->model->geefFactuur();
        $this->model->stuurMail($factuur);
        $productenOud = $_SESSION['geselecteerdeProducten'];
        $productenNieuw = $_SESSION['producten'];
        $this->model->wijzigMagazijn($productenNieuw, $productenOud);
        $this->forward('klant', 'admin');
    }

    /* ============================
     *          PRODUCTEN
      ============================= */

    private function productenBeheerAction()
    {
        $producten = $this->model->geefProducten();
        $this->view->set('producten', $producten);
    }

    private function productToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            $bestaat = $this->model->bestaatProduct();
            if ($bestaat == false)
            {
                $this->model->maakProduct();
                $this->model->setLog('Product toevoegen', 'Gelukt');
                $this->forward('productenBeheer', 'admin');
            } else
            {
                $this->model->foutGoedMelding('danger', '<strong>Mislukt!</strong> product kan niet worden toegevoegd omdat deze al bestaat.');
                $this->model->setLog('Product toevoegen', 'Mislukt');
            }
        }
    }

    private function productWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigProduct();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> product is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Product wijzigen', 'Gelukt');
            $this->forward('productenBeheer', 'admin');
        } else
        {
            $product = $this->model->geefProduct($_REQUEST['product_id']);
            $this->view->set('product', $product);
        }
    }

    private function productVerwijderenAction()
    {
        $this->model->verwijderProduct();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> product is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Product verwijderen', 'Gelukt');
        $this->forward('productenBeheer', 'admin');
    }

    /* ============================
     *          MAIL
      ============================= */

    private function mailToevoegenAction()
    {
        $this->model->maakMail();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> E-mail adres is toegevoed. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Mail toevoegen', 'Gelukt');
        $this->forward('klant', 'admin');
    }

    private function mailVerwijderenAction()
    {
        $this->model->verwijderMail();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> E-mail adres is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Mail verwijderen', 'Gelukt');
        $this->forward('klant', 'admin');
    }

    private function mailWijzigenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigMail();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> E-mail adres is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Mail wijzigen', 'Gelukt');
            $this->forward('klant', 'admin');
        }
        $mail = $this->model->geefMail();
        $this->view->set('mail', $mail);
    }

    /* ============================
     *          Server
      ============================= */

    private function serverToevoegenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->maakServer();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> server is toegevoegd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Server toevoegen', 'Gelukt');
            $this->forward('klant', 'admin');
        }
    }

    private function serverWijzigenAction()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigServer();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> server is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Server wijzigen', 'Gelukt');
            $this->forward('klant', 'admin');
        }
        $server = $this->model->geefServer();
        $this->view->set('server', $server);
    }

    private function serverVerwijderenAction()
    {
        $this->model->verwijderServer();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> server is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Server verwijderen', 'Gelukt');
        $this->forward('klant', 'admin');
    }

    private function wijzigMijnGegevensAction()
    {
        $gegevens = $this->model->geefMijnGegevens();
        $this->view->set('gegevens', $gegevens);

        $id = $_SESSION['gebruiker']->geefId();
        if (isset($_POST['voornaam']) && !empty($_POST['voornaam']) ||
                isset($_POST['tussenvoegsel']) && !empty($_POST['tussenvoegsel']) ||
                isset($_POST['achternaam']) && !empty($_POST['achternaam']) ||
                isset($_POST['mail']) && !empty($_POST['mail']))
        {
            $this->model->wijzigMijnGegevens();
            if (isset($_FILES['foto']))
            {
                $this->model->updateFoto($id);
            }
            $this->model->wijzigSession();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> Persoonlijke gegevens gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Eigen gegevens wijzigen', 'Gelukt');
            $this->forward('default', 'admin');
        }
    }

    private function wijzigWachtwoordAction()
    {

        if (!empty($_POST['huidigWachtwoord']) && isset($_POST['huidigWachtwoord']) &&
                !empty($_POST['nieuwWachtwoord']) && isset($_POST['nieuwWachtwoord']) &&
                !empty($_POST['herhaalNieuwWachtwoord']) && isset($_POST['herhaalNieuwWachtwoord']))
        {
            $this->model->wijzigWachtwoord();
        }
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> wachtwoord is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Eigen wachtwoord wijzigen', 'Gelukt');
        $this->forward('wijzigMijnGegevens', 'admin');
    }

    private function GlobalSettingsAction()
    {
        $standaardWachtwoord = $this->model->geefStandaardWachtwoord();
        $this->view->set('standaardWachtwoord', $standaardWachtwoord);
        if (isset($_POST['action']))
        {
            $this->model->wijzigStandaardWachtwoord();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> standaard wachtwoord is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Global wachtwoord wijzigen', 'Gelukt');
            $this->forward('default', 'admin');
        }
    }

    private function resetStandaardWachtwoordAction()
    {
        if (isset($_POST['resetWachtwoord']) && !empty($_POST['resetWachtwoord']))
        {
            $wachtwoord = $this->model->geefStandaardWachtwoord();
            $this->model->resetWachtwoord($wachtwoord);
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> wachtwoord is ge-reset. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Wachtwoord reset', 'Gelukt');
            $this->forward('gebruikerWijzigen', 'admin');
        }
    }

    private function MagazijnAction()
    {
        $products = $this->model->ProductView();
        $this->view->set('products', $products);
    }

    private function wijzigVoorraadAction()
    {
        $this->model->wijzigVoorraad();
        $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> voorraad gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
        $this->model->setLog('Voorraad wijzigen', 'Gelukt');
        $this->forward('magazijn', 'admin');
    }

    private function storingenAction()
    {
        $storingen = $this->model->geefStoringen();
        $this->view->set('storingen', $storingen);
    }

    private function storingenBeheerAction()
    {
        $this->view->set('storingen', $this->model->geefStoringen());

        if ($_GET['status'] === 'non-active')
        {
            $this->notificatieWijzigActiveAction();
        }
    }

    private function storingToevoegenAction()
    {
        if (!empty($_POST['titel']) && isset($_POST['titel']) &&
                !empty($_POST['omschrijving']) && isset($_POST['omschrijving']))
        {
            $result = $this->model->storingToevoegen();
            //$this->model->voegNotificatieToe();
            switch ($result)
            {
                case "GELUKT":
                    $this->model->foutGoedMelding('success', 'Storing is toegevoegd. <span class="glyphicon glyphicon-saved"></span>');
                    $this->model->setLog('Storing toevoegen', 'Gelukt');
                    break;
                case "MISLUKT":
                    $this->model->foutGoedMelding('danger', 'Storing is niet toegevoegd!');
                    $this->model->setLog('Storing toevoegen', 'Mislukt');
                    break;
            }
        }
    }

    private function storingWijzigenAction()
    {
        if (!empty($_POST['titel']) && isset($_POST['titel']) &&
                !empty($_POST['startDatum']) && isset($_POST['startDatum']) &&
                !empty($_POST['omschrijving']) && isset($_POST['omschrijving']))
        {

            $this->model->storingWijzigen();
            $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> storing is gewijzigd. <span class="glyphicon glyphicon-saved"></span>');
            $this->model->setLog('Storing wijzigen', 'Gelukt');
            $this->forward('storingenBeheer', 'admin');
        }
        $storing = $this->model->geefSelectedStoring();
        $this->view->set('storing', $storing);
    }

    private function storingStatusWijzigenAction()
    {
        if (!empty($_GET['status']) && isset($_GET['status']) &&
                !empty($_GET['id']) && isset($_GET['id']))
        {
            $this->model->storingWijzigStatus();
            $this->model->setLog('Storing status wijzigen', 'Gelukt');
            $this->forward('storingenBeheer', 'admin');
        }
    }

    private function storingVerwijderenAction()
    {
        $result = $this->model->storingVerwijderen();
        switch ($result)
        {
            case"GELUKT":
                $this->model->foutGoedMelding('success', '<strong>Gelukt!</strong> storing is verwijderd. <span class="glyphicon glyphicon-saved"></span>');
                $this->model->setLog('Storing verwijderen', 'Gelukt');

                break;
            case "MISLUKT":
                $this->model->foutGoedMelding('danger', '<strong>Mislukt!</strong> storing verwijderen is mislukt.');
                $this->model->setLog('Storing verwijderen', 'Mislukt');
                break;
        }
        $this->forward('storingenBeheer', 'admin');
    }

    private function notificatieWijzigActiveAction()
    {
        $this->model->wijzigNotificatieStatus();
    }

    private function logsBeheerAction()
    {
        $this->view->set('logs', $this->model->getLogs());

        //$this->view->set('log_gebruiker', $this->model->geefLogGebruiker());
    }

    private function calendarAction()
    {
        
    }


    private function beschikbaarheidAction()
    {
        $result = $_SESSION['insertUpdate'];
        
        if($result === 'INSERT')
        {
            $weeknummer = $_SESSION['weeknummer'];
            echo 'insert weeknummer: ' . $weeknummer;
        }
        else if($result = 'UPDATE')
        {
            $weeknummer = $_SESSION['weeknummer'];
            echo 'update weeknummer: ' . $weeknummer;
        }

        var_dump($result);
        $_SESSION['weeknummer'] = '';
    }
    
    private function weekNummerAction()
    {
        $weeknummer = $_POST['weeknummer'];
        // kijken of de weeknummer bestaat.
        if (isset($_POST['weeknummer']) && !empty($_POST['weeknummer']))
        {
            //de weeknummer opslaan om de formulier ermee te kunnen doorsturen
            $_SESSION['weeknummer'] = $_POST['weeknummer'];
            
            // de beschikbaarheid opvragen door middel van de ingevoerde weeknummer.
            $result = $this->model->getBeschikbaarheidParam($_POST['weeknummer']);
            
            //de datums vragen voor de week, die is ingevuld
            $datums = $this->model->getDates($_POST['weeknummer']);

            // kijken of de weeknummer is ingevoerd, anders een warning geven. De weeknummer moet ingevuld zijn.
            if ($result !== 'geenBeschikbaarheid')
            {
                $this->view->set('weeknummer', $weeknummer );
                $this->view->set('dates', $datums);
            }
            else
            {
                $_SESSION['urenbeschikbaar'] = 'geenBeschikbaarheid';
            }
            //controle of de weeknummer bestaat
            $result2 = $this->model->controleerWeeknummers();
            if($result2 === 'NONE')
            {
                $_SESSION['insertUpdate'] = 'INSERT';
            }
            elseif($result2 === 'SINGLE')
            {
                $_SESSION['insertUpdate'] = 'UPDATE';
            }
            else
            {
                $this->model->foutGoedMelding('danger', '<strong> Foutmelding 1019AC:  </strong> Systeemfout! schakel een Systeenbeheerder in.');
            }
                
        } else
        {
            $this->model->foutGoedMelding('warning', '<strong> Let op! </strong> U heeft nog geen weeknummer ingevoerd!');
        }
        $this->forward('beschikbaarheid', 'admin');
    }

    private function getBeschikbareExpertAction()
    {
        $this->view->set('experts', $this->model->getBeschikbareExpert($_SESSION['ticket_id']));
    }

    private function beschikbareExpertsAction()
    {
        
    }

}