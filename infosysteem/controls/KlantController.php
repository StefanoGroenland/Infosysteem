<?php

namespace infosysteem\controls;

use infosysteem\models as MODELS;
use infosysteem\view as VIEW;

class KlantController {

    private $action;
    private $control;
    private $view;
    private $model;

    public function __construct($control, $action) {
        $this->control = $control;
        $this->action = $action;

        $this->view = new VIEW\View();
        $this->model = new MODELS\KlantModel();

        $isGerechtigd = $this->model->isGerechtigd();

        if ($isGerechtigd != true) {
            $this->forward('default', 'bezoeker');
        }
    }

    public function execute() {
        $opdracht = $this->action . 'Action';
        if (!method_exists($this, $opdracht)) {
            $opdracht = 'defaultAction';
            $this->action = 'default';
        }
        $this->$opdracht();
        //de request wordt gevuld met de huidige action,
        //zodat de juiste item in de navigatie een active kan krijgen
        $_REQUEST['action'] = $this->action;

        $this->view->setAction($this->action);
        $this->view->setControl($this->control);
        $this->view->toon();
    }

    public function forward($action, $control) {
        $_REQUEST['action'] = $action;
        $_REQUEST['action'] = $action;
        $klasseNaam = __NAMESPACE__ . '\\' . ucFirst($control) . 'Controller';
        $controller = new $klasseNaam($control, $action);
        $controller->execute();
        exit();
    }

    public function uitloggenAction() {
        $_SESSION = array();
        session_destroy();
        $this->forward('default', 'bezoeker');
    }

    //de default is de eerste functie wat wordt gedaan als er wordt ingelogd
    //de eerste default pagina is de dashboard
    private function defaultAction() {
        $tickets = $this->model->geefDagTickets();
        $this->view->set('tickets', $tickets);

        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);

        $gebruikers = $this->model->geefGebruikers();
        $this->view->set('gebruikers', $gebruikers);

        if (isset($_POST['datum'])) {
            $datum = date("d-m-Y", strtotime($_POST['datum']));
        } else {
            $datum = Date("d-m-Y");
        }
        $this->view->set('datum', $datum);
    }

    /* ============================
     *          RAPPORT
      ============================= */

    //pagina met alle rapporten
    private function rapportenAction() {
        if (isset($_POST) && !empty($_POST)) {
            $tickets = $this->model->zoekGeslotenTickets();
        } else {
            //geeft alle tickets die gesolten zijn, deze tickets hebben een rapport
            $tickets = $this->model->geefGeslotenTickets();
        }
        $this->view->set('tickets', $tickets);
        //geeft alle klanten
        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);


        $this->view->set('gebruikers', $this->model->geefGebruikers());
    }

    //voegd een rapport aan een ticket
    private function rapportToevoegenAction() {
        if (isset($_POST) && !empty($_POST)) {
            //maakt een rapport(vult de gegevens in de ticket)
            //en zet de status op gesloten
            $this->model->maakRapport();
            //stuurt je naar de ticket pagina
            $this->forward('ticket', 'admin');
        } else {
            //geeft de ticket mee om later de ticket en klant id te gebruiken.
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }

    //wijzigt de rapport
    private function rapportWijzigenAction() {
        if (isset($_POST) && !empty($_POST)) {
            $this->model->wijzigRapport();
            $this->forward('ticket', 'admin');
        } else {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }

    /* ============================
     *          TICKETS
      ============================= */

    //tickets pagina
    private function ticketsAction() {
        if (isset($_POST) && !empty($_POST)) {
            $tickets = $this->model->zoekTickets();
        } else {
            $tickets = $this->model->geefTickets();
        }
        $this->view->set('tickets', $tickets);
        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);
        $gebruikers = $this->model->geefGebruikers();
        $this->view->set('gebruikers', $gebruikers);
    }

    //pagina met de ticket informatie
    private function ticketAction() {
        $ticket = $this->model->geefTicket();
        $this->view->set('ticket', $ticket);

        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);


        $this->view->set('gebruikers', $this->model->geefGebruikers());
    }

    /* ============================
     *          ESCALATIE
      ============================= */

    private function escalatiesAction() {
        if (isset($_POST) && !empty($_POST)) {
            $tickets = $this->model->zoekEscalatiesTickets();
        } else {
            //geeft alle tickets die een ingevulde esccalatie hebben
            $tickets = $this->model->geefEscalatiesTickets();
        }
        $this->view->set('tickets', $tickets);
        //geeft alle klanten
        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);
        $this->view->set('gebruikers', $this->model->geefGebruikers());
    }

    /* ============================
     *         KLANTEN
      ============================= */

    //haalt gegevens op van 1 klant
    private function klantAction() {
        //haalt de klant op
        $klant = $this->model->geefKlant();
        //plaats de klant in de pagina
        $this->view->set('klant', $klant);

        //haalt alle problemen op van de aangegeven klant
        $tickets = $this->model->geefTickets();
        //plaats de problemen in de pagina
        $this->view->set('tickets', $tickets);

        //haalt alle problemen op van de aangegeven klant
        $facturen = $this->model->geefKlantFacturen();
        //plaats de problemen in de pagina
        $this->view->set('facturen', $facturen);
    }

    private function wijzigMijnGegevensAction()
    {
        $gegevens = $this->model->geefMijnGegevens();
        $this->view->set('gegevens', $gegevens);
        
        if(isset($_POST['voornaam']) && !empty($_POST['voornaam']) ||
                isset($_POST['tussenvoegsel']) && !empty($_POST['tussenvoegsel']) ||
                isset($_POST['achternaam']) && !empty($_POST['achternaam']) ||
                isset($_POST['mail']) && !empty($_POST['mail']) ||
                isset($_POST['straatnaam']) && !empty($_POST['straatnaam'])||
                isset($_POST['postcode']) && !empty($_POST['postcode'])||
                isset($_POST['woonplaats']) && !empty($_POST['woonplaats'])||
                isset($_POST['huisnummer']) && !empty($_POST['huisnummer'])||
                isset($_POST['bedrijf']) && !empty($_POST['bedrijf'])||
                isset($_POST['telefoon']) && !empty($_POST['telefoon'])||
                isset($_POST['mobiel']) && !empty($_POST['mobiel']))
        {
            $this->model->wijzigMijnGegevens();
            $this->model->wijzigSession();
            $this->forward('default', 'klant');
        }
    }
    
    
    private function wijzigWachtwoordAction()
    {
        
        if(!empty($_POST['huidigWachtwoord']) && isset($_POST['huidigWachtwoord']) &&
                !empty($_POST['nieuwWachtwoord']) && isset($_POST['nieuwWachtwoord']) &&
                !empty($_POST['herhaalNieuwWachtwoord']) && isset($_POST['herhaalNieuwWachtwoord'])) 
        { 
            $this->model->wijzigWachtwoord();
        }
        $this->forward('wijzigMijnGegevens', 'Klant');
    }
    
}
