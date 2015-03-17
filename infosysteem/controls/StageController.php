<?php
    namespace infosysteem\controls;
    use infosysteem\models as MODELS;
    use infosysteem\view as VIEW;

class StageController  
{
    private $action;
    private $control;
    private $view;
    private $model;
    
    public function __construct($control,$action)
    {
        $this->control = $control;
        $this->action = $action;

        $this->view=new VIEW\View();     
        $this->model = new MODELS\StageModel();
        
        $isGerechtigd = $this->model->isGerechtigd();
        
        if($isGerechtigd!=true)
        {
            $this->forward('default','bezoeker');
        }
    }
    
    public function execute() 
    {
        $opdracht = $this->action.'Action';
        if(!method_exists($this,$opdracht))
        {
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
    
    public function forward($action, $control)
    {
        $klasseNaam = __NAMESPACE__.'\\'.ucFirst($control).'Controller';
        $controller = new $klasseNaam($control,$action);
        $controller->execute(); 
        exit();
    }
    
    public function uitloggenAction()
    {
        $_SESSION = array();
        session_destroy();
        $this->forward('default','bezoeker');
    }

    //de default is de eerste functie wat wordt gedaan als er wordt ingelogd
    //de eerste default pagina is de dashboard
    private function defaultAction()
    {
        $tickets = $this->model->geefDagTickets();
        $this->view->set('tickets', $tickets);
        
        $gebruikers = $this->model->geefGebruikers();
        $this->view->set('gebruikers', $gebruikers);
        
        $klanten = $this->model->geefKlantenBijTickets($tickets);
        $this->view->set('klanten', $klanten);
        
        if(isset($_POST['datum']))
        {
            $datum = date("d-m-Y", strtotime($_POST['datum']));
        }
        else
        {
            $datum = Date("d-m-Y");
        }
        $this->view->set('datum', $datum);
    }
    
    /*============================
     *          KLANT
     =============================*/
    
    //een pagina met alle klanten
    public function klantenAction()
    {
        //controlleert of de post naam is gevuld voor de zoek functie
        if(isset($_POST['waarde']) && !empty($_POST['waarde']))
        {
            //haalt alle klanten op die voldoen aan de zoek woord
            $klanten = $this->model->zoekKlanten();
        }
        else
        {
            //haalt alle klanten op
            $klanten = $this->model->geefKlanten();
        }
        //plaats de klanten in de view
        $this->view->set('klanten', $klanten);
    }
    
    //haalt gegevens op van 1 klant
    private function klantAction()
    {
        //haalt de klant op
        $klant = $this->model->geefKlant();
        //plaats de klant in de pagina
        $this->view->set('klant', $klant);
        
        //haalt alle problemen op van de aangegeven klant
        $tickets = $this->model->geefKlantTickets();
        //plaats de problemen in de pagina
        $this->view->set('tickets', $tickets);
    }
    
    //voegt een klant toe
    private function klantToevoegenAction()
    {
        //controleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            //post gevuld
            //controleer of alle genodigde gegevens zijn ingevuld
            if(isset($_POST['voornaam']) && isset($_POST['achternaam']) && !empty($_POST['voornaam']) && !empty($_POST['achternaam']) )
            {
                //maak een klant aan
                $this->model->maakKlant();
                //stuurt je door naar de default pagina
                $this->forward('klanten', 'stage');
            }
        }
    }
    
    //de gegevens van een klant wijzigen
    public function klantWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            //controleer of de juiste gegevens zijn ingevuld die je minimaal moet hebben voor de database
            if(isset($_POST['voornaam']) && !empty($_POST['voornaam']) && 
               isset($_POST['achternaam']) && !empty($_POST['achternaam']) )
            {
                $this->model->wijzigKlant();
                //stuurt je terug naar de klantpagina
                $this->forward('klant', 'stage');
            }
        }
        else
        {
            $klant = $this->model->geefKlant();
            $this->view->set('klant', $klant);
        }
    }
    
    //verwijdert een klant
    public function klantVerwijderenAction()
    {
        $this->model->verwijderKlant();
        $this->forward('klanten', 'stage');
    }
    
    /*============================
     *          GEBRUIKER
     =============================*/
    //wijzig je eigen wachtwoord
    public function wachtwoordWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            //krijgt opmerkingen terug
            $opmerking = $this->model->wijzigWachtwoord();
            $this->view->set('opmerking', $opmerking);
        }
    }
    
    /*============================
     *          RAPPORT
     =============================*/
    
    //pagina met alle rapporten
    public function rapportenAction()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $tickets = $this->model->zoekGeslotenTickets();
        }
        else
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
    public function rapportToevoegenAction()
    {
        if(isset($_POST) && !empty($_POST))
        {
            //maakt een rapport(vult de gegevens in de ticket)
            //en zet de status op gesloten
            $this->model->maakRapport();
            //stuurt je naar de ticket pagina
            $this->forward('ticket', 'stage');   
        }
        else 
        {
            //geeft de ticket mee om later de ticket en klant id te gebruiken.
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }
    
    //wijzigt de rapport
    public function rapportWijzigenAction()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigRapport();
            $this->forward('ticket', 'stage');
        }
        else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }
    
    /*============================
     *          TICKETS
     =============================*/
    
    //tickets pagina
    public function ticketsAction()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $tickets = $this->model->zoekTickets();
        }
        else
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
    public function ticketAction()
    {
        $ticket = $this->model->geefTicket();
        $this->view->set('ticket', $ticket);
        
        $klant = $this->model->geefKlant();
        $this->view->set('klant', $klant);
        
        
        $this->view->set('gebruikers', $this->model->geefGebruikers());
    }
    
    //wijzigt de ticket
    public function ticketWijzigenAction()
    {
        //controlleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            $this->model->wijzigTicket();
            //stuurt je naar de klant pagina
            $this->forward('ticket', 'stage');
        }
        else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }
    
    //maakt een nieuwe ticket aan
    public function ticketToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            $this->model->maakTicket();
            $this->forward('klant', 'stage');
        }
        else
        {
            $this->view->set('gebruikers', $this->model->geefGebruikers());
            $this->view->set('klant_id', $_REQUEST['klant_id']);
        }
    }
    
    /*============================
     *          ESCALATIE
     =============================*/
     
    public function escalatiesAction()
    {
        if(isset($_POST) && !empty($_POST))
        {
            $tickets = $this->model->zoekEscalatiesTickets();
        }
        else
        {
            //geeft alle tickets die een ingevulde esccalatie hebben
            $tickets = $this->model->geefEscalatiesTickets();
        }
        $this->view->set('tickets', $tickets);
        //geeft alle klanten
        $klanten = $this->model->geefKlanten();
        $this->view->set('klanten', $klanten);
        $this->view->set('gebruikers', $this->model->geefGebruikers());
    }
    
    public function escalatieToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            $this->model->maakEscalatie();
            $this->forward('ticket', 'stage');
        }
        else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }
    public function escalatieAntwoordToevoegenAction()
    {
        //controlleert of er een formulier is ingevuld
        if(isset($_POST) && !empty($_POST))
        {
            $this->model->maakEscalatieAntwoord();
            $this->forward('ticket', 'stage');
        }
        else
        {
            $ticket = $this->model->geefTicket();
            $this->view->set('ticket', $ticket);
        }
    }
      private function wijzigMijnGegevensAction()
    {
        $gegevens = $this->model->geefMijnGegevens();
        $this->view->set('gegevens', $gegevens);
        
        if(isset($_POST['voornaam']) && !empty($_POST['voornaam']) ||
                isset($_POST['tussenvoegsel']) && !empty($_POST['tussenvoegsel']) ||
                isset($_POST['achternaam']) && !empty($_POST['achternaam']) ||
                isset($_POST['mail']) && !empty($_POST['mail']))
        {
            $this->model->wijzigMijnGegevens();
            $this->model->wijzigSession();
            $this->forward('default', 'stage');
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
        $this->forward('wijzigMijnGegevens', 'stage');
    }
    
}


   
  