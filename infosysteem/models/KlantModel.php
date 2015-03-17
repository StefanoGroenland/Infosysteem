<?php

namespace infosysteem\models;

use infosysteem\models\fpdf17 as PDF;

class KlantModel {

    protected $db;
    //de key wordt gebruikt om wachtwoord waardes voor de sql tabel gebruikers te crypten,
    //zodat het beter beveiligd is.
    private $key = 'dekeyvoordewachtwoordenindedatabase';

    public function __construct() {
        include("DB.php");
        $this->db = new \PDO($dsn, $user, $password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function isGerechtigd() {
        //controleer of er ingelogd is. Ja, kijk of de gerbuiker de deze controller mag gebruiken 
        if (isset($_SESSION['gebruiker']) && !empty($_SESSION['gebruiker'])) {
            $gebruiker = $_SESSION['gebruiker'];
            if ($gebruiker->geefRecht() == "klant") {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    
    /* ============================
     *          TICKETS
      ============================= */

    //geeft alle tickets
    public function geefTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        $sql = 'SELECT * FROM `tickets` WHERE `klant_id` = :klant_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft 1 ticket
    public function geefTicket() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        $id = $_REQUEST['ticket_id'];
        $sql = 'SELECT * FROM `tickets` WHERE `id` = :id and `klant_id` = :klant_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $ticket = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $ticket[0];
    }

    //geeft de tickets van 1 dag voor de dashboard
    public function geefDagTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        if (isset($_POST['datum']) && !empty($_POST['datum'])) {
            //neemt de datum uit de post
            $datum = date("Y-m-d", strtotime($_POST['datum']));
        } else {
            //maakt de datum aan van vandaag
            $datum = Date("Y-m-d");
        }

        $sql = 'SELECT * FROM `tickets` WHERE `klant_id` = :klant_id AND `afspraak_datum` LIKE :datum';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':datum', $datum);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft tickets via de zoekfuntie
    public function zoekTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        //begin van de query
        $sql = 'SELECT * FROM `tickets` WHERE `klant_id` = :klant_id';
        //controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer'])) {
            $sql .= ' AND ';
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }

        //controlleert of er een status is meegegeven
        if (isset($_POST['status']) && !empty($_POST['status'])) {
            $status = $_POST['status'];
            //als de status geen is dan hoeft het niet gebruikt te worden
            if ($status !== 'geen') {
                $sql .= ' AND ';
                $sql .= " `status` = :status";
            }
        }

        //controlleert of er een periode en datum is meegegeven
        if (isset($_POST['periode']) && !empty($_POST['periode']) &&
                isset($_POST['datum']) && !empty($_POST['datum'])) {
            $periode = $_POST['periode'];
            //als de status geen is dan hoeft het niet gebruikt te worden
            if ($periode !== 'geen') {
                $datum = $_POST['datum'];
                $sql .= ' AND ';
                $sql .= ' `' . $periode . '_datum` = :datum';
            }
        }

        $stmnt = $this->db->prepare($sql);
        if (isset($_POST['nummer']) && !empty($_POST['nummer'])) {
            $stmnt->bindParam(':nummer', $nummer);
        }
        if ($_POST['status'] !== 'geen') {
            $stmnt->bindParam(':status', $status);
        }
        if ($_POST['periode'] !== 'geen') {
            $stmnt->bindParam(':datum', $datum);
        }
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    /* ============================
     *          RAPPORT
      ============================= */

    //geeft alle gesloten tickets(rapporten)
    public function geefGeslotenTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        $sql = 'SELECT * FROM `tickets` WHERE `status` = "gesloten" AND `klant_id` = :klant_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft geslotentickets(rapporten) via de zoek functie
    public function zoekGeslotenTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        //begin van de query
        $sql = 'SELECT * FROM `tickets` WHERE `status` = "gesloten" AND `klant_id` = :klant_id';
        //controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer'])) {
            $sql .= ' AND ';
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }
        //controlleert of er een datum is meegegeven
        if (isset($_POST['datum']) && !empty($_POST['datum'])) {
            $sql .= ' AND ';
            $datum = $_POST['datum'];
            $sql .= ' `rapport_datum` = :datum';
        }
        $stmnt = $this->db->prepare($sql);
        if (isset($_POST['nummer']) && !empty($_POST['nummer'])) {
            $stmnt->bindParam(':nummer', $nummer);
        }
        if (isset($_POST['datum']) && !empty($_POST['datum'])) {
            $stmnt->bindParam(':datum', $datum);
        }
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    /* ============================
     *          ESCALATIE
      ============================= */

    public function geefEscalatiesTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        $sql = 'SELECT * FROM `tickets` WHERE `escalatie` != "" AND `klant_id` = :klant_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    public function zoekEscalatiesTickets() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        //begin van de query
        $sql = 'SELECT * FROM `tickets` WHERE `escalatie` != "" AND `klant_id` = :klant_id';
        //controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer'])) {
            $sql .= ' AND ';
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }
        //controlleert of er een datum is meegegeven
        if (isset($_POST['periode']) && !empty($_POST['periode']) &&
                isset($_POST['datum']) && !empty($_POST['datum'])) {
            $periode = $_POST['periode'];
            //als de status geen is dan hoeft het niet gebruikt te worden
            if ($periode !== 'geen') {
                $datum = $_POST['datum'];
                $sql .= ' AND ';
                $sql .= ' `' . $periode . '_datum` = :datum';
            }
        }
        $stmnt = $this->db->prepare($sql);
        if (isset($_POST['nummer']) && !empty($_POST['nummer'])) {
            $stmnt->bindParam(':nummer', $nummer);
        }
        if (isset($_POST['datum']) && !empty($_POST['datum'])) {
            $stmnt->bindParam(':datum', $datum);
        }
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    /* ============================
     *          GEBRUIKERS
      ============================= */

    //haalt alle gebruikers op
    public function geefGebruikers() {
        $sql = "SELECT  `id`,
                        `voornaam`,
                        `tussenvoegsel`,
                        `achternaam`,
                        `gebruikersnaam`,
                        AES_DECRYPT(wachtwoord,:key) AS 'wachtwoord',
                        `mail`,
                        `gebruikerstype`
                FROM  `gebruikers`";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->execute();
        $gebruikers = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        return $gebruikers;
    }

    /* ============================
     *          KLANT
      ============================= */

    //geeft 1 klant
    public function geefKlant() {
        $klant_id = $_SESSION['gebruiker']->geefKlant_id();
        $sql = 'SELECT * FROM `klanten` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $klant_id);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $klant[0];
    }

    //geeft de facturen van de klant
    public function geefKlantFacturen() {
        $id = $_SESSION['gebruiker']->geefKlant_id();
        $sql = 'SELECT * FROM `facturen` WHERE `klant_id` = :klan_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klant_id', $id);
        $stmnt->execute();
        $facturen = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Factuur');
        return $facturen;
    }

    //wijzigt de wachtwoord van de gebruiker die nu is ingelogd
    public function wijzigWachtwoord()
    {
        $huidigWachtwoord = $_POST['huidigWachtwoord'];
        $nieuwWachtwoord = $_POST['nieuwWachtwoord'];
        $herhaalNieuwWachtwoord = $_POST['herhaalNieuwWachtwoord'];
        //controleer of het oude wachtwoord goed is
        if ($huidigWachtwoord === $_SESSION['gebruiker']->geefWachtwoord())
        {
            //controleer of de nieuwe wachtwoorden gelijk zijn
            if ($nieuwWachtwoord === $herhaalNieuwWachtwoord)
            {
                $id = $_SESSION['gebruiker']->geefId();
                //verander de wachtwoord in de database
                $sql = "UPDATE `gebruikers` SET `wachtwoord`= AES_ENCRYPT(:wachtwoord,:key) WHERE  `id` = :id";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':wachtwoord', $nieuwWachtwoord);
                $stmnt->bindParam(':id', $id);
                $stmnt->bindParam(':key',$this->key);
                $stmnt->execute();
                //plaats de nieuwe wachtwoord in de gebruiker
                $_SESSION['gebruiker']->zetWachtwoord($nieuwWachtwoord);
                return 'Wachtwoord gewijzigd';
            }
            else
            {
                return 'Uw nieuwe wachtwoorden komen niet overeen';
            }
        }
        else
        {
            return 'Uw huidige wachtwoord komt niet overeen';
        }
    }


    public function wijzigMijnGegevens() 
    {

        $id = $_SESSION['gebruiker']->geefKlant_id();
        $voornaam = $_REQUEST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $mail = $_POST['mail'];
        $straatnaam = $_POST['straatnaam'];
        $huisnummer = $_POST['huisnummer'];
        $postcode = $_POST['postcode'];
        $woonplaats = $_POST['woonplaats'];
        $bedrijf = $_POST['bedrijf'];
        $telefoon = $_POST['telefoon'];
        $mobiel = $_POST['mobiel'];
        
        $sql = 'UPDATE `klanten` SET 
            `voornaam` = :voornaam,
            `tussenvoegsel` = :tussenvoegsel,
            `achternaam` = :achternaam,
            `straatnaam` = :straatnaam,
            `huisnummer` = :huisnummer,
            `postcode` = :postcode,
            `woonplaats` = :woonplaats,
            `bedrijf` = :bedrijf,
            `telefoon` = :telefoon,
            `mobiel` = :mobiel,
            `email`= :mail
            WHERE `id` = :id;';

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->bindParam(':straatnaam', $straatnaam);
        $stmnt->bindParam(':huisnummer', $huisnummer);
        $stmnt->bindParam(':postcode', $postcode);
        $stmnt->bindParam(':woonplaats', $woonplaats);
        $stmnt->bindParam(':bedrijf', $bedrijf);
        $stmnt->bindParam(':telefoon', $telefoon);
        $stmnt->bindParam(':mobiel', $mobiel);
        
        $stmnt->execute();
    }

    public function wijzigSession() 
    {
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $mail = $_POST['mail'];
        $straatnaam = $_POST['straatnaam'];
        $huisnummer = $_POST['huisnummer'];
        $postcode = $_POST['postcode'];
        $woonplaats = $_POST['woonplaats'];
        $bedrijf = $_POST['bedrijf'];
        $telefoon = $_POST['telefoon'];
        $mobiel = $_POST['mobiel'];
        
        $_SESSION['gebruiker']->zetVoornaam($voornaam);
        $_SESSION['gebruiker']->zetTussenvoegsel($tussenvoegsel);
        $_SESSION['gebruiker']->zetAchternaam($achternaam);
        $_SESSION['gebruiker']->zetMail($mail);
        $_SESSION['gebruiker']->zetStraatnaam($straatnaam);
        $_SESSION['gebruiker']->zetHuisNummer($huisnummer);
        $_SESSION['gebruiker']->zetPostCode($postcode);
        $_SESSION['gebruiker']->zetWoonPlaats($woonplaats);
        $_SESSION['gebruiker']->zetBedrijf($bedrijf);
        $_SESSION['gebruiker']->zetTelefoon($telefoon);
        $_SESSION['gebruiker']->zetMobiel($mobiel);
    }

    public function geefMijnGegevens() 
    {
        if (isset($_REQUEST['gebruiker_id']) && !empty($_REQUEST['gebruiker_id']))
        {
            $id = $_SESSION['gebruiker']->geefKlant_id();
        }
       
        $sql = 'SELECT * FROM `klanten` WHERE `id` = :id ';      
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $gegevens = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $gegevens[0];
       
    }

}
