<?php

namespace infosysteem\models;

class StageModel
{

    protected $db;
    //de key wordt gebruikt om wachtwoord waardes voor de sql tabel gebruikers te crypten,
    //zodat het beter beveiligd is.
    private $key = 'dekeyvoordewachtwoordenindedatabase';

    public function __construct()
    {
        include("DB.php");
        $this->db = new \PDO($dsn, $user, $password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function isGerechtigd()
    {
        //controleer of er ingelogd is. Ja, kijk of de gebruiker de deze controller mag gebruiken 
        if (isset($_SESSION['gebruiker']) && !empty($_SESSION['gebruiker']))
        {
            $gebruiker = $_SESSION['gebruiker'];
            if ($gebruiker->geefRecht() == "stage")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;
    }

    /* ============================
     *          KLANT
      ============================= */

    //geeft alle klanten
    public function geefKlanten()
    {
        $sql = 'SELECT * FROM `klanten`';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $klanten = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $klanten;
    }

    //geeft 1 klant
    public function geefKlant()
    {
        $id = $_REQUEST['klant_id'];
        $sql = 'SELECT * FROM `klanten` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $klant[0];
    }

    //maakt een klant aan in de database
    public function maakKlant()
    {
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $straatnaam = $_POST['straatnaam'];
        $huisnummer = $_POST['huisnummer'];
        $postcode = $_POST['postcode'];
        $woonplaats = $_POST['woonplaats'];
        $bedrijf = $_POST['bedrijf'];
        $email = $_POST['email'];
        $telefoon = $_POST['telefoon'];
        $mobiel = $_POST['mobiel'];

        $sql = 'INSERT INTO 
                `klanten` (`voornaam`,`tussenvoegsel`,`achternaam`, 
                           `straatnaam`,`huisnummer`,`postcode`,`woonplaats`,
                           `bedrijf`,`email`,`telefoon`,`mobiel`)
                VALUES (:voornaam,:tussenvoegsel,:achternaam, 
                        :straatnaam,:huisnummer,:postcode,:woonplaats,
                        :bedrijf,:email,:telefoon,:mobiel)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':straatnaam', $straatnaam);
        $stmnt->bindParam(':huisnummer', $huisnummer);
        $stmnt->bindParam(':postcode', $postcode);
        $stmnt->bindParam(':woonplaats', $woonplaats);
        $stmnt->bindParam(':bedrijf', $bedrijf);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':telefoon', $telefoon);
        $stmnt->bindParam(':mobiel', $mobiel);
        $stmnt->execute();
    }

    //wijzig gegevens van een klant
    public function wijzigKlant()
    {
        $id = $_POST['klant_id'];
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $straatnaam = $_POST['straatnaam'];
        $huisnummer = $_POST['huisnummer'];
        $postcode = $_POST['postcode'];
        $woonplaats = $_POST['woonplaats'];
        $bedrijf = $_POST['bedrijf'];
        $email = $_POST['email'];
        $telefoon = $_POST['telefoon'];
        $mobiel = $_POST['mobiel'];

        $sql = 'UPDATE `klanten` SET 
            `voornaam` = :voornaam,
            `tussenvoegsel` = :tussenvoegsel,
            `achternaam` = :achternaam,
            `straatnaam`= :straatnaam,
            `huisnummer`= :huisnummer,
            `postcode`= :postcode,
            `woonplaats`= :woonplaats,
            `bedrijf`= :bedrijf,
            `email`= :email,
            `telefoon`= :telefoon,
            `mobiel`= :mobiel
            WHERE `id` = :id;';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':straatnaam', $straatnaam);
        $stmnt->bindParam(':huisnummer', $huisnummer);
        $stmnt->bindParam(':postcode', $postcode);
        $stmnt->bindParam(':woonplaats', $woonplaats);
        $stmnt->bindParam(':bedrijf', $bedrijf);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':telefoon', $telefoon);
        $stmnt->bindParam(':mobiel', $mobiel);
        $stmnt->execute();
    }

    //verwijdert een klant
    public function verwijderKlant()
    {
        $id = $_REQUEST['klant_id'];
        $sql = 'DELETE FROM `klanten` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    //geeft klanten via de zoekfunctie
    public function zoekKlanten()
    {
        $sql = 'SELECT * FROM  `klanten` WHERE';
        $eerste = true;
        if (isset($_POST['waarde']) && !empty($_POST['waarde']))
        {
            //eerste zoek optie
            $waarde = '%';
            $waarde .= $_POST['waarde'];
            $waarde .= '%';
            $zoek = $_POST['zoek'];
            $eerste = false;
            $sql .= '`' . $zoek . '` LIKE "' . $waarde . '" ';
        }
        if (isset($_POST['waarde2']) && !empty($_POST['waarde2']))
        {
            //tweede zoek optie
            $waarde2 = '%';
            $waarde2 .= $_POST['waarde2'];
            $waarde2 .= '%';
            $zoek2 = $_POST['zoek2'];
            if (!$eerste)
            {
                if ($waarde === $waarde2)
                {
                    $sql .= ' AND ';
                }
                else
                {
                    $sql .= ' OR ';
                }
            }
            $sql .= '`' . $zoek2 . '` LIKE "' . $waarde2 . '"';
        }
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $klanten = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $klanten;
    }

    //geeft alle klanten van de tickets
    public function geefKlantenBijTickets($tickets)
    {
        $ticketnummers = '0';
        foreach ($tickets as $ticket)
        {
            $ticketnummers .= ',' . $ticket->geefKlant_id();
        }
        $sql = 'SELECT * FROM `klanten` WHERE `id` IN (' . $ticketnummers . ')';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $klanten = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $klanten;
    }

    /* ============================
     *          TICKETS
      ============================= */

    //geeft alle tickets
    public function geefTickets()
    {
        $sql = 'SELECT * FROM `tickets`';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft alle tickets van een klant
    public function geefKlantTickets()
    {
        $id = $_REQUEST['klant_id'];
        $sql = 'SELECT * FROM `tickets` WHERE `klant_id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft 1 ticket
    public function geefTicket()
    {
        $id = $_REQUEST['ticket_id'];
        $sql = 'SELECT * FROM `tickets` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $ticket = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $ticket[0];
    }

    //geeft de tickets van 1 dag voor de dashboard
    public function geefDagTickets()
    {
        if (isset($_POST['datum']) && !empty($_POST['datum']))
        {
            //neemt de datum uit de post
            $datum = date("Y-m-d", strtotime($_POST['datum']));
        }
        else
        {
            //maakt de datum aan van vandaag
            $datum = Date("Y-m-d");
        }

        $sql = 'SELECT * FROM `tickets` WHERE `afspraak_datum` LIKE :datum';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':datum', $datum);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft tickets via de zoekfuntie
    public function zoekTickets()
    {
        //$eerste kijkt of het de eerste zoek query is
        //bij de eerste moet er een WHERE komen
        //anders moet er een AND erbij komen
        $eerste = true;
        //begin van de query
        $sql = 'SELECT * FROM `tickets` ';
        //controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            if ($eerste)
            {
                $sql .= ' WHERE ';
                $eerste = FALSE;
            }
            else
            {
                $sql .= ' AND ';
            }
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }

        //controlleert of er een status is meegegeven
        if (isset($_POST['status']) && !empty($_POST['status']))
        {
            $status = $_POST['status'];
            //als de status geen is dan hoeft het niet gebruikt te worden
            if ($status !== 'geen')
            {
                if ($eerste)
                {
                    $sql .= ' WHERE ';
                    $eerste = FALSE;
                }
                else
                {
                    $sql .= ' AND ';
                }
                $sql .= " `status` = :status";
            }
        }

        //controlleert of er een periode en datum is meegegeven
        if (isset($_POST['periode']) && !empty($_POST['periode']) &&
                isset($_POST['datum']) && !empty($_POST['datum']))
        {
            $periode = $_POST['periode'];
            //als de status geen is dan hoeft het niet gebruikt te worden
            if ($periode !== 'geen')
            {
                $datum = $_POST['datum'];
                if ($eerste)
                {
                    $sql .= ' WHERE ';
                    $eerste = FALSE;
                }
                else
                {
                    $sql .= ' AND ';
                }
                $sql .= ' `' . $periode . '_datum` = :datum';
            }
        }
        $stmnt = $this->db->prepare($sql);
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            $stmnt->bindParam(':nummer', $nummer);
        }
        if ($_POST['status'] !== 'geen')
        {
            $stmnt->bindParam(':status', $status);
        }
        if ($_POST['periode'] !== 'geen')
        {
            $stmnt->bindParam(':datum', $datum);
        }
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //wijzigt gegevens van de ticket
    public function wijzigTicket()
    {
        $id = $_POST['ticket_id'];
        $aankomst = $_POST['aankomst'];
        $vertrek = $_POST['vertrek'];
        $klant_id = $_POST['klant_id'];
        $opmerking = $_POST['opmerking'];
        $aanmaak_datum = date("Y-m-d", strtotime($_POST['aanmaak_datum']));
        $afspraak_datum = date("Y-m-d", strtotime($_POST['afspraak_datum']));
        $bezoek_datum = date("Y-m-d", strtotime($_POST['bezoek_datum']));
        $sluit_datum = date("Y-m-d", strtotime($_POST['sluit_datum']));
        $status = $_POST['status'];

        $sql = 'UPDATE `tickets` SET
                `aankomst`= :aankomst,
                `vertrek`= :vertrek,
                `klant_id`= :klant_id,
                `opmerking`= :opmerking,
                `aanmaak_datum`= :aanmaak_datum,
                `afspraak_datum`= :afspraak_datum,
                `bezoek_datum`= :bezoek_datum,
                `sluit_datum`= :sluit_datum,
                `status`= :status
                 WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':aankomst', $aankomst);
        $stmnt->bindParam(':vertrek', $vertrek);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->bindParam(':opmerking', $opmerking);
        $stmnt->bindParam(':aanmaak_datum', $aanmaak_datum);
        $stmnt->bindParam(':afspraak_datum', $afspraak_datum);
        $stmnt->bindParam(':bezoek_datum', $bezoek_datum);
        $stmnt->bindParam(':sluit_datum', $sluit_datum);
        $stmnt->bindParam(':status', $status);
        $stmnt->execute();
    }

    //maakt een nieuwe ticket aan
    public function maakTicket()
    {
        $aankomst = $_POST['aankomst'];
        $vertrek = $_POST['vertrek'];
        $klant_id = $_POST['klant_id'];
        $opmerking = $_POST['opmerking'];
        $aanmaak_datum = date("Y-m-d", strtotime($_POST['aanmaak_datum']));
        $afspraak_datum = date("Y-m-d", strtotime($_POST['afspraak_datum']));
        $bezoek_datum = date("Y-m-d", strtotime($_POST['bezoek_datum']));
        $sluit_datum = date("Y-m-d", strtotime($_POST['sluit_datum']));
        $status = 'open';
        $aangemaakt_gebruiker_id = $_SESSION['gebruiker']->geefId();
        $gebruiker_id = $_POST['gebruiker_id'];

        $sql = 'INSERT INTO `tickets`(
                    `aankomst`,
                    `vertrek`,
                    `klant_id`,
                    `gebruiker_id`,
                    `aangemaakt_gebruiker_id`,
                    `opmerking`,
                    `aanmaak_datum`,
                    `afspraak_datum`,
                    `bezoek_datum`,
                    `sluit_datum`,
                    `status`)
                VALUES (
                    :aankomst,
                    :vertrek,
                    :klant_id,
                    :gebruiker_id,
                    :aangemaakt_gebruiker_id,
                    :opmerking,
                    :aanmaak_datum,
                    :afspraak_datum,
                    :bezoek_datum,
                    :sluit_datum,
                    :status)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':aankomst', $aankomst);
        $stmnt->bindParam(':vertrek', $vertrek);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->bindParam(':opmerking', $opmerking);
        $stmnt->bindParam(':aanmaak_datum', $aanmaak_datum);
        $stmnt->bindParam(':afspraak_datum', $afspraak_datum);
        $stmnt->bindParam(':bezoek_datum', $bezoek_datum);
        $stmnt->bindParam(':sluit_datum', $sluit_datum);
        $stmnt->bindParam(':status', $status);
        $stmnt->bindParam(':aangemaakt_gebruiker_id', $aangemaakt_gebruiker_id);
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        $stmnt->execute();
    }

    /* ============================
     *          GEBRUIKERS
      ============================= */

    //haalt alle gebruikers op
    public function geefGebruikers()
    {
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
     *          RAPPORT
      ============================= */

    //voegt de rapport gegevens in de ticket in en verandert de status naar gesloten
    public function maakRapport()
    {
        $rapport = $_POST['rapport'];
        $rapport_datum = $_POST['datum'];
        $status = 'gesloten';
        $id = $_POST['ticket_id'];

        $sql = 'UPDATE `tickets` SET 
                    `status`=:status,
                    `rapport`=:rapport,
                    `rapport_datum`=:rapport_datum 
                WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':status', $status);
        $stmnt->bindParam(':rapport', $rapport);
        $stmnt->bindParam(':rapport_datum', $rapport_datum);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    //wijzigt de rapport gegevens in de ticket
    public function wijzigRapport()
    {
        $rapport = $_POST['rapport'];
        $rapport_datum = date("Y-m-d", strtotime($_POST['datum']));
        $id = $_POST['ticket_id'];

        $sql = 'UPDATE `tickets` SET
                    `rapport`=:rapport,
                    `rapport_datum`=:rapport_datum 
                WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':rapport', $rapport);
        $stmnt->bindParam(':rapport_datum', $rapport_datum);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    //geeft alle gesloten tickets(rapporten)
    public function geefGeslotenTickets()
    {
        $sql = 'SELECT * FROM `tickets` WHERE `status` = "gesloten"';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    //geeft geslotentickets(rapporten) via de zoek functie
    public function zoekGeslotenTickets()
    {
        //begin van de query
        $sql = 'SELECT * FROM `tickets` WHERE `status` = "gesloten"';
        //controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            $sql .= ' AND ';
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }
        //controlleert of er een datum is meegegeven
        if (isset($_POST['datum']) && !empty($_POST['datum']))
        {
            $sql .= ' AND ';
            $datum = $_POST['datum'];
            $sql .= ' `rapport_datum` = :datum';
        }
        $stmnt = $this->db->prepare($sql);
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            $stmnt->bindParam(':nummer', $nummer);
        }
        if (isset($_POST['datum']) && !empty($_POST['datum']))
        {
            $stmnt->bindParam(':datum', $datum);
        }
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    /* ============================
     *          ESCALATIE
      ============================= */

    public function maakEscalatie()
    {
        $escalatie = $_POST['escalatie'];
        $id = $_POST['ticket_id'];

        $sql = 'UPDATE `tickets` SET
                    `escalatie`=:escalatie
                WHERE `id`=:id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':escalatie', $escalatie);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    public function geefEscalatiesTickets()
    {
        $sql = 'SELECT * FROM `tickets` WHERE `escalatie` != ""';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    public function maakEscalatieAntwoord()
    {
        $escalatie = $_POST['$antwoord_escalatie'];
        $id = $_POST['ticket_id'];

        $sql = 'UPDATE `tickets` SET
                    `antwoord_escalatie`=:antwoord_escalatie
                WHERE `id`=:id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':antwoord_escalatie', $escalatie);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    public function zoekEscalatiesTickets()
    {
        //begin van de query
        $sql = 'SELECT * FROM `tickets` WHERE `escalatie` != ""';
        //controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            $sql .= ' AND ';
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }
        //controlleert of er een datum is meegegeven
        if (isset($_POST['periode']) && !empty($_POST['periode']) &&
                isset($_POST['datum']) && !empty($_POST['datum']))
        {
            $periode = $_POST['periode'];
            //als de status geen is dan hoeft het niet gebruikt te worden
            if ($periode !== 'geen')
            {
                $datum = $_POST['datum'];
                $sql .= ' AND ';
                $sql .= ' `' . $periode . '_datum` = :datum';
            }
        }
        $stmnt = $this->db->prepare($sql);
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            $stmnt->bindParam(':nummer', $nummer);
        }
        if (isset($_POST['datum']) && !empty($_POST['datum']))
        {
            $stmnt->bindParam(':datum', $datum);
        }
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
        return $tickets;
    }

    public function wijzigMijnGegevens()
    {

        $id = $_SESSION['gebruiker']->geefId();
        $voornaam = $_REQUEST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $mail = $_POST['mail'];

        $sql = 'UPDATE `gebruikers` SET 
            `voornaam` = :voornaam,
            `tussenvoegsel` = :tussenvoegsel,
            `achternaam` = :achternaam,
            `mail`= :mail
            WHERE `id` = :id;';

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->execute();
    }

    public function wijzigSession()
    {
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $mail = $_POST['mail'];


        $_SESSION['gebruiker']->zetVoornaam($voornaam);
        $_SESSION['gebruiker']->zetTussenvoegsel($tussenvoegsel);
        $_SESSION['gebruiker']->zetAchternaam($achternaam);
        $_SESSION['gebruiker']->zetMail($mail);
    }

    public function geefMijnGegevens()
    {
        if (isset($_REQUEST['gebruiker_id']) && !empty($_REQUEST['gebruiker_id']))
        {
            $id = $_SESSION['gebruiker']->geefId();
        }
        $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id ';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $gegevens = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        return $gegevens[0];
    }

}
