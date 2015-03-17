<?php

namespace infosysteem\models;

use infosysteem\models\fpdf17 as PDF;

class AdminModel
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
//controleer of er ingelogd is. Ja, kijk of de gerbuiker de deze controller mag gebruiken 
        if (isset($_SESSION['gebruiker']) && !empty($_SESSION['gebruiker']))
        {
            $gebruiker = $_SESSION['gebruiker'];
            if ($gebruiker->geefRecht() == "admin")
            {
                return true;
            } else
            {
                return false;
            }
        }
        return false;
    }

    // log aanmaken. parameters zijn : $log = wat er is gebeurt en gelogged wordt. $status is gelukt of mislukt.
    public function setLog($log, $status)
    {
        $huidigeGebruikerId = $_SESSION['gebruiker']->geefId();
        $sql = 'INSERT INTO
                `logs` (`tijd_log`,`ip_adres`,`log`,`datum_log`,`status`)
                VALUES (CURRENT_TIME,:ip_adres,:log,CURRENT_DATE ,:status)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':ip_adres', $_SERVER['REMOTE_ADDR']);
        $stmnt->bindParam(':log', $log);
        $stmnt->bindParam(':status', $status);
        $stmnt->execute();
        $id = $this->db->lastInsertId();

        $sql2 = 'INSERT into `log_gebruiker` (`gebruiker_id`, log_id)'
                . 'VALUES (:gebruiker_id, :Log_id)';
        $stmnt2 = $this->db->prepare($sql2);
        $stmnt2->bindParam(':Log_id', $id);
        $stmnt2->bindParam(':gebruiker_id', $huidigeGebruikerId);
        $stmnt2->execute();
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
        if (isset($_REQUEST['klant_id']) && !empty($_REQUEST['klant_id']))
        {
            $id = $_REQUEST['klant_id'];
            $sql = 'SELECT * FROM `klanten` WHERE `id` = :id';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->execute();
            $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
            return $klant[0];
        }
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
                } else
                {
                    $sql .= ' OR ';
                }
            }
            $sql .= '`' . $zoek2 . '` LIKE "' . $waarde2 . '"';
        }
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $klanten = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        if ($klanten === NULL)
        {
            return 'LEEG';
        }
        return $klanten;
    }

//geeft alle klanten van de tickets
    public function geefKlantenBijTickets()
    {
        $sql = 'SELECT k.id, k.voornaam, k.tussenvoegsel, k.achternaam FROM `klanten` AS k JOIN `tickets` AS t'
                . ' ON t.klant_id = k.id'
                . ' JOIN `escalaties` AS e ON t.id = e.ticket_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        return $klant;
    }

    public function geefKlantenVanVandaag($tickets)
    {
        $x = 0;
        foreach ($tickets as $ticket)
        {
            $ticketnummers[$x] = $ticket->geefKlant_id();

            $sql = 'SELECT * FROM `klanten` WHERE `id` IN (:ticketnummers)';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':ticketnummers', $ticketnummers[$x]);
            $stmnt->execute();
            $klanten[$x] = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
            $x++;
        }
        return $klanten;
    }

    public function geefExpertBijTickets()
    {
        $sql = 'SELECT g.id, g.voornaam, g.tussenvoegsel, g.achternaam FROM `gebruikers` AS g JOIN `tickets` AS t'
                . ' ON t.gebruiker_id = g.id'
                . ' JOIN `escalaties` AS e ON t.id = e.ticket_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $experts = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        return $experts;
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
        if (isset($_REQUEST['ticket_id']) && !empty($_REQUEST['ticket_id']))
        {
            $id = $_REQUEST['ticket_id'];
            $sql = 'SELECT * FROM `tickets` WHERE `id` = :id';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->execute();
            $ticket = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
            return $ticket[0];
        }
    }

    public function geefTicketParam($id)
    {
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
            $maanden = array("Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "augustus", "September", "Oktober", "November", "December");

            $datum = "24 Oktober 2014";

            preg_match("#([A-Za-z]+)#", $datum, $maand, PREG_OFFSET_CAPTURE);

            for ($i = 0; $i < count($maanden); $i++)
            {
                ($maanden[$i] === $maand[0][0]) ? $datum = str_replace(" ", "-", preg_replace("#([A-Za-z]+)#", $i++, $datum)) : '';
            }
        } else
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
        if (isset($_POST['zoek']) && !empty($_POST['zoek']))
        {
            $waarde = $_POST['zoek'];
            $sql = 'SELECT * FROM `tickets` ';

            switch ($waarde)
            {
                case "id":
                    $id = $_POST['waardeInput'];
                    $sql = $sql . 'WHERE `id` = :id';
                    $stmnt = $this->db->prepare($sql);
                    $stmnt->bindParam(':id', $id);
                    $stmnt->execute();
                    $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
                    break;

                case "afspraakDatum":
                    // waarde van de datum input pakken
                    $datum = $_POST['waardeDate'];

                    // Waarde omzetten naar Y-M-D format voor de database (Database leest niet in Europese DD-MM-YYYY mode)
                    $newDate = $this->geefFormatDatumNaarYMD($datum);
                    // De SQL wordt verder in een andere functie afgemaakt en krijg je een stuk SQL code terug
                    $sql = $this->geefDatumSql($sql);
                    $stmnt = $this->db->prepare($sql);
                    $stmnt->bindParam(':datum', $newDate);
                    $stmnt->execute();
                    $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
                    break;

                case "voornaam":
                    $info = $_POST['waardeInput'];

                    $sql = $sql . 'WHERE `klant_id` = :id';
                    $stmnt = $this->db->prepare($sql);


                    $result = $this->geefZoekFunctieKlantVoornaam($info);
                    if ($result === NULL)
                    {
                        return 'ticketBestaatNiet';
                    }

                    $id = $result->geefId();
                    $stmnt->bindParam(':id', $id);
                    $stmnt->execute();
                    $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
                    break;

                case "achternaam":
                    $info = $_POST['waardeInput'];

                    $sql = $sql . 'WHERE `klant_id` = :id';
                    $stmnt = $this->db->prepare($sql);


                    $result = $this->geefZoekFunctieKlantAchternaam($info);
                    if ($result === NULL)
                    {
                        return 'ticketBestaatNiet';
                    }
                    $id = $result->geefId();
                    $stmnt->bindParam(':id', $id);
                    $stmnt->execute();
                    $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
                    break;

                case "postcode":
                    $info = $_POST['waardeInput'];

                    $sql = $sql . 'WHERE `klant_id` = :id';
                    $stmnt = $this->db->prepare($sql);

                    $result = $this->geefZoekFunctieKlantPostcode($info);
                    $id = $result->geefId();
                    $stmnt->bindParam(':id', $id);
                    $stmnt->execute();
                    $tickets = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Ticket');
                    break;
            }
            if (isset($tickets) && !empty($tickets) && $tickets !== NULL)
            {
                return $tickets;
            } elseif (empty($tickets) && isset($tickets))
            {
                return "ticketBestaatNiet";
            }
        } else
        {
            echo 'else';
        }
    }

    public function geefZoekFunctieKlantVoornaam($info)
    {
        $sql = 'SELECT * FROM `klanten` WHERE `voornaam` = :voornaam';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':voornaam', $info);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        if (!empty($klant) && isset($klant) && $klant != NULL)
        {
            return $klant[0];
        } else
        {
            return NULL;
        }
    }

    public function geefZoekFunctieKlantAchternaam($info)
    {
        $sql = 'SELECT * FROM `klanten` WHERE `achternaam` = :achternaam';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':achternaam', $info);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        if (!empty($klant) && isset($klant) && $klant != NULL)
        {
            return $klant[0];
        } else
        {
            return NULL;
        }
    }

    public function geefZoekFunctieKlantPostcode($info)
    {
        $sql = 'SELECT * FROM `klanten` WHERE `postcode` = :postcode';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':postcode', $info);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        if (!empty($klant) && isset($klant) && $klant != NULL)
        {
            return $klant[0];
        } else
        {
            $this->foutGoedMelding('danger', '<strong> Foutmelding </strong> Postcode bestaat niet !');
            return NULL;
        }
    }

    public function geefDatumSql($sql)
    {
        if (!empty($_POST['waardeDate']) && isset($_POST['waardeDate']))
        {
            return $sql = $sql . 'WHERE `afspraak_datum` = :datum';
        } else
        {
            $this->foutGoedMelding('danger', '<strong> Foutmelding </strong> Er is iets fout gegaan !');
        }
    }

    public function foutGoedMelding($status, $melding)
    {
        echo '<div class="alert alert-' . $status . ' alert-dismissible text-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        ' . $melding . '  
                        </div>';
    }

    public function geefFormatDatumNaarYMD($datum)
    {
        return $newdate = date("Y-m-d", strtotime($datum));
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
        if ($_POST['bezoek_datum'] != "")
        {
            $bezoek_datum = date("Y-m-d", strtotime($_POST['bezoek_datum']));
        } else
        {
            $bezoek_datum = NULL;
        }
        if ($_POST['sluit_datum'] != "")
        {
            $sluit_datum = date("Y-m-d", strtotime($_POST['sluit_datum']));
        } else
        {
            $sluit_datum = NULL;
        }
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
        $aanmaak_datum = date('Y-m-d', strtotime($_POST['aanmaak_datum']));
        $afspraak_datum = date("Y-m-d", strtotime($_POST['afspraak_datum']));
        if ($_POST['bezoek_datum'] != "")
        {
            $bezoek_datum = date("Y-m-d", strtotime($_POST['bezoek_datum']));
        } else
        {
            $bezoek_datum = NULL;
        }
        if ($_POST['sluit_datum'] != "")
        {
            $sluit_datum = date("Y-m-d", strtotime($_POST['sluit_datum']));
        } else
        {
            $sluit_datum = NULL;
        }

        $status = 'open';
        $aangemaakt_gebruiker_id = $_SESSION['gebruiker']->geefId();

        $sql = 'INSERT INTO `tickets`(
                    `aankomst`,
                    `vertrek`,
                    `klant_id`,
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
        $stmnt->execute();

        return $this->db->lastInsertId();
    }

    public function verwijderTicket()
    {
        $id = $_REQUEST['ticket_id'];
        $sql = 'DELETE FROM `tickets` WHERE `id` = :id LIMIT 1';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    /* ============================
     *          GEBRUIKERS
      ============================= */

//haalt alle experts op
    public function geefExperts()
    {
        $sql = "SELECT  * FROM  `gebruikers` WHERE `gebruikerstype` !=  'klant'";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->execute();
        $gebruikers = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        return $gebruikers;
    }

//haalt alle gebruikers op
    public function geefGebruikers()
    {
        $sql = "SELECT  `id`,
                        `voornaam`,
                        `tussenvoegsel`,
                        `achternaam`,
                        `gebruikersnaam`,
                        AES_DECRYPT(wachtwoord,:key) AS 'wachtwoord',
                        `foto`,
                        `mail`,
                        `gebruikerstype`,
                        `klant_id`
                FROM  `gebruikers`";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->execute();
        $gebruikers = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        return $gebruikers;
    }

    public function geefGebruikerZonder()
    {

        if (isset($_REQUEST['gebruiker_id']) && !empty($_REQUEST['gebruiker_id']))
        {
            $id = $_REQUEST['gebruiker_id'];
            $sql = "SELECT  `id`,
                        `voornaam`,
                        `tussenvoegsel`,
                        `achternaam`,
                        `gebruikersnaam`,
                        AES_DECRYPT(wachtwoord,:key) AS 'wachtwoord',
                        `mail`,
                        `gebruikerstype`
                FROM  `gebruikers`
                WHERE `id` = :id";
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->bindParam(':key', $this->key);
            $stmnt->execute();
            $gebruiker = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
            return $gebruiker[0];
        }
    }

//haalt 1 gebruiker op
    public function geefGebruiker($ticket)
    {

        if (isset($_REQUEST['gebruiker_id']) && !empty($_REQUEST['gebruiker_id']))
        {
            $id = $_REQUEST['gebruiker_id'];
            $sql = "SELECT  `id`,
                        `voornaam`,
                        `tussenvoegsel`,
                        `achternaam`,
                        `gebruikersnaam`,
                        AES_DECRYPT(wachtwoord,:key) AS 'wachtwoord',
                        `mail`,
                        `gebruikerstype`
                FROM  `gebruikers` 
                WHERE `id` = :id";
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->bindParam(':key', $this->key);
            $stmnt->execute();
            $gebruiker = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
            return $gebruiker[0];
        } else
        {
            $x = 0;
            foreach ($ticket as $gebruiker)
            {
                $id[$x] = $gebruiker['gebruiker_id'];

                $sql = "SELECT  `id`,
                        `voornaam`,
                        `tussenvoegsel`,
                        `achternaam`
                FROM  `gebruikers` 
                WHERE `id` = :id";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':id', $id[$x]);
                $stmnt->execute();
                $admin[$x] = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
                $x++;
            }
            return $admin;
        }
    }

    public function geefMijnGegevens()
    {
        if (isset($_REQUEST['gebruiker_id']) && !empty($_REQUEST['gebruiker_id']))
        {
            $id = $_SESSION['gebruiker']->geefId();
        }
        $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $gegevens = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        return $gegevens[0];
    }

//controleert of de gegeven gebruikers naam al gebruikt wordt bij het wijzigen van een gebruiker.
    public function bestaatGNWijzig()
    {
        if (isset($_POST['gebruiker_id']) && !empty($_POST['gebruiker_id']))
        {
            $gebruikersnaam = $_POST['gebruikersnaam'];
//zorgt er voor dat er niet op zijn eigen naam wordt gezocht
            $id = $_POST['gebruiker_id'];
            $sql = 'SELECT * FROM `gebruikers` WHERE `gebruikersnaam` = :gebruikersnaam AND `id` != :id';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
            $stmnt->bindParam(':id', $id);
            $stmnt->execute();
            $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');

            if (count($result) === 1)
            {
                return true;
            } else
            {
                return false;
            }
        }
    }

//controlleer of de gebruikersnaam al bestaat
    public function bestaatGN()
    {
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $sql = 'SELECT * FROM `gebruikers` WHERE `gebruikersnaam` = :gebruikersnaam';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmnt->execute();
        $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        if (count($result) === 1)
        {
            return true;
        } else
        {
            return false;
        }
    }

//maakt een nieuwe gebruiker aan
    public function maakGebruiker()
    {
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];
        $mail = $_POST['mail'];
        $gebruikerstype = $_POST['gebruikerstype'];

        $sql = 'INSERT INTO `gebruikers`
                (`voornaam`, `achternaam`, `gebruikersnaam`, `wachtwoord`, `mail`, `gebruikerstype`)
                VALUES
                (:voornaam,:achternaam,:gebruikersnaam,AES_ENCRYPT(:wachtwoord,:key),:mail,:gebruikerstype)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmnt->bindParam(':wachtwoord', $wachtwoord);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->bindParam(':gebruikerstype', $gebruikerstype);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->execute();
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function maakKlantGebruiker()
    {
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];
        $mail = $_POST['mail'];
        $gebruikerstype = $_POST['gebruikerstype'];
        $klant_id = $_POST['klant_id'];

        $sql = 'INSERT INTO `gebruikers` (
                    `voornaam`,
                    `achternaam`,
                    `gebruikersnaam`,
                    `wachtwoord`,
                    `mail`,
                    `gebruikerstype`,
                    `klant_id`)
                VALUES(
                    :voornaam,
                    :achternaam,
                    :gebruikersnaam,
                    AES_ENCRYPT(
                        :wachtwoord,
                        :key),
                    :mail,
                    :gebruikerstype,
                    :klant_id)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmnt->bindParam(':wachtwoord', $wachtwoord);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->bindParam(':gebruikerstype', $gebruikerstype);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->bindParam(':klant_id', $klant_id);
        $stmnt->execute();
    }

//wijzigt de gebruiker
    public function wijzigGebruiker()
    {
        $id = $_POST['gebruiker_id'];
        $voornaam = $_POST['voornaam'];
        $tussenvoegsel = $_POST['tussenvoegsel'];
        $achternaam = $_POST['achternaam'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];
        $mail = $_POST['mail'];
        $sql = 'UPDATE `gebruikers` SET 
                    `voornaam` = :voornaam,
                    `tussenvoegsel` = :tussenvoegsel,
                    `achternaam`= :achternaam,
                    `gebruikersnaam`= :gebruikersnaam,
                    `wachtwoord`= AES_ENCRYPT(:wachtwoord,:key),
                    `mail`= :mail
                WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmnt->bindParam(':wachtwoord', $wachtwoord);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->execute();
    }

//verwijdert een gebruiker
    public function verwijderGebruiker()
    {
        $id = $_REQUEST['gebruiker_id'];
        $sql = 'DELETE FROM `gebruikers` WHERE `id` = :id LIMIT 1';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
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
                $stmnt->bindParam(':key', $this->key);
                $stmnt->execute();
//plaats de nieuwe wachtwoord in de gebruiker
                $_SESSION['gebruiker']->zetWachtwoord($nieuwWachtwoord);
                return 'Wachtwoord gewijzigd';
            } else
            {
                return 'Uw nieuwe wachtwoorden komen niet overeen';
            }
        } else
        {
            return 'Uw huidige wachtwoord komt niet overeen';
        }
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
        $escalatie = $_POST['antwoord_escalatie'];
        $id = $_POST['ticket_id'];

        $sql = 'UPDATE `tickets` SET
                    `antwoord_escalatie`=:antwoord_escalatie
                WHERE `id`=:id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':antwoord_escalatie', $escalatie);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    public function geefEscalaties()
    {
        $sql = 'SELECT * FROM `escalaties`';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $escalaties = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        return $escalaties;
    }

    public function geefTicketsBijEscalatie()
    {
        $sql = 'SELECT t.* FROM `tickets` AS t JOIN `escalaties` AS e ON e.ticket_id = t.id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $tickets = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        return $tickets;
    }

    public function zoekEscalatiesTickets()
    {
//begin van de query
        $sql = 'SELECT * FROM `escalaties` WHERE `e_log` != ""';
//controlleert of er een nummer is meegegeven
        if (isset($_POST['nummer']) && !empty($_POST['nummer']))
        {
            $sql .= ' AND ';
            $nummer = $_POST['nummer'];
            $sql .= ' `id` = :nummer';
        }
//controlleert of er een datum is meegegeven
        if (isset($_POST['periode']) && !empty($_POST['periode']) &&
                isset($_POST['datum']) && !empty($_POST['datum'])
        )
        {
            $periode = $_POST['periode'];
//als de status geen is dan hoeft het niet gebruikt te worden
            if ($periode !== 'geen')
            {
                $datum = $this->geefFormatDatumNaarYMD($_POST['datum']);
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

    public function wijzigEscalatie()
    {

        $escalatie = $_POST['escalatie'];
        $id = $_POST['ticket_id'];
        $sql = 'UPDATE `tickets` SET
                     `datum_veranderd` = CURRENT_DATE(),
                     `tijd_veranderd` = CURRENT_TIME(),
                    `escalatie`=:escalatie,
                    `klant_gewijzigd` = TRUE
                WHERE `id`=:id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':escalatie', $escalatie);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    public function wijzigEscalatieAntwoord()
    {
        $antwoord_escalatie = $_POST['antwoord_escalatie'];
        $id = $_POST['ticket_id'];

        $sql = 'UPDATE `tickets` SET
                      `antwoord_datum_veranderd` = CURRENT_DATE(),
                     `antwoord_tijd_veranderd` = CURRENT_TIME(),
                    `antwoord_escalatie`=:antwoord_escalatie,
                    `expert_gewijzigd` = TRUE
                WHERE `id`=:id';

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':antwoord_escalatie', $antwoord_escalatie);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    /* ============================
     *       PDF, FACTUUR
      ============================= */

    public function maakPDF()
    {
// a4 210 bij 297 mm
//maakt een nieuwe classe aan
//de classe staat in fpdf17 folder
        $pdf = new fpdf17\fpdf();
//maakt een nieuwe pagina
        $pdf->AddPage();
        /*         * ****************** */
//Head
        /*         * ***************** */
        $soort = ucfirst($_POST['soort']);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(10, 10, $soort, '', 0, 'L');
        $pdf->Image('img/logo.png', 100);
        $pdf->Ln();

        /*         * ***************** */
//Contact
        /*         * **************** */
//Klant Gegevens
        $klant = $this->geefKlant();
        $pdf->SetFont('Arial', '', 12);
        $klant_bedrijfsnaam = $klant->geefBedrijf();
        $klant_naam = $klant->geefNaam();
        $klant_adress = $klant->geefStraatnaam() . ' ' . $klant->geefHuisnummer();
        $klant_postcode = $klant->geefPostcode();
        $klant_stad = $klant->geefWoonplaats();
        $klant_land = 'Nederland';
        $y = $pdf->GetY();  //positie waar de tekst begint
        $pdf->Cell(10, 5, $klant_bedrijfsnaam, '', 1, 'L', false);
        $pdf->Cell(10, 5, $klant_naam, '', 1, 'L', false);
        $pdf->Cell(10, 5, $klant_adress, '', 1, 'L', false);
        $pdf->Cell(10, 5, $klant_postcode . ' ' . $klant_stad, '', 1, 'L', false);
        $pdf->Cell(10, 5, $klant_land, '', 1, 'L', false);

//Eigen Gegevens
        $pdf->SetY($y);     //set de y positie waar de tekst begon
        $pdf->SetX(140);    //verandert de x zodat het aan de rechterkant komt

        $bedrijfsnaam = 'Armand It Service';
        $naam = 'Armand';
        $adress = 'Het Kleine loo 43';
        $postcode = '2592BW';
        $stad = 'Den Haag';
        $land = 'Nederland';

        $pdf->Cell(10, 5, $bedrijfsnaam, '', 2, 'L', false);
        $pdf->Cell(10, 5, $naam, '', 2, 'L', false);
        $pdf->Cell(10, 5, $adress, '', 2, 'L', false);
        $pdf->Cell(10, 5, $postcode . ' ' . $stad, '', 2, 'L', false);
        $pdf->Cell(10, 5, $land, '', 2, 'L', false);

        $tel = 'Tel. nr: ' . '0683561708';
        $kvk = 'KvK nr: ' . '53109570';
        $btw = 'BTW nr: ' . 'NL224435954';
        $iban = 'IBAN: ' . 'NL73INGB0006061982';
        // $factuur_datum = 'Factuurdatum: ' . '11-03-2014';
        $factuur_datum = 'Factuur datum' . date(" F j, Y");
        $factuur_nummer = 'Factuurnummer: ' . '2014' . rand(10000, 99999);

        $pdf->Cell(10, 5, ' ', '', 2, 'L', false); //lege regel
        $pdf->Cell(10, 5, $tel, '', 2, 'L', false);
        $pdf->Cell(10, 5, $kvk, '', 2, 'L', false);
        $pdf->Cell(10, 5, $btw, '', 2, 'L', false);
        $pdf->Cell(10, 5, $iban, '', 2, 'L', false);
        $pdf->Cell(10, 5, ' ', '', 2, 'L', false); //lege regel
        $pdf->Cell(10, 5, $factuur_datum, '', 2, 'L', false);
        $pdf->Cell(10, 5, $factuur_nummer, '', 2, 'L', false);
        $pdf->Ln();

        /*         * ************** */
//Tabel
        /*         * ************** */
//Tabel Head
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor('0', '146', '255');
        $pdf->SetFont('Arial', '', 14);
        $w = array(30, 20, 100, 15, 20); //breedte van kolommen
//0=productnaam,1=aantal,2=beschrijving,4=prijs,5=totaal
        $pdf->Cell($w[0], 10, 'product', 0, '0', 'L', true);
        $pdf->Cell($w[1], 10, 'Aantal', 0, '0', 'L', true);
        $pdf->Cell($w[2], 10, 'Beschrijving', 0, '0', 'L', true);
        $pdf->Cell($w[3], 10, 'Prijs', 0, '0', 'L', true);
        $pdf->Cell($w[4], 10, 'Totaal', 0, '0', 'L', true);
        $pdf->Ln();

//Tabel Body
//--producten aanmaken
        $teller = $_POST['teller']; //aantal van gekozen producten
        $producten = array(); //0=naam,1=aantal,2=totaal,4=prijs,5=beschrijving
        $t2 = 0;
        define('EURO', chr(128));
        for ($i = 0; $i <= $teller; $i++)
        {
            //controlleert of de aantal wel is gezet en niet null is
            if ($_POST['aantal_' . $i] != 0 && !empty($_POST['aantal_' . $i]))
            {
                $product = $this->geefProduct($_POST['product_' . $i]);

                $producten[$t2][0] = $product->geefNaam();
                $producten[$t2][1] = $_POST['aantal_' . $i];
                $producten[$t2][2] = $product->geefBeschrijving();
                $producten[$t2][3] = EURO . $product->geefPrijs();
                $producten[$t2][4] = $producten[$t2][1] * $product->geefPrijs();
                $producten[$t2][5] = $product->geefFoto();
                $t2++;
            }
        }
        $result = $this->productControle($producten);
        if ($result === 'DUPS')
        {
            return 'DUPS';
        }
        $teller = $t2 - 1;


//--producten tonen
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 10);
        for ($i = 0; $i <= $teller; $i++)
        {
            $y = $pdf->GetY();
            $pdf->Cell($w[0], 10, $producten[$i][0], '');
            $pdf->Cell($w[1], 10, $producten[$i][1], '');
            $pdf->Cell($w[2], 10, '', ''); //voor de beschrijving
            $pdf->Cell($w[3], 10, $producten[$i][3], '');
            $pdf->Cell($w[4], 10, EURO . $producten[$i][4], '', 1);
            $y2 = $pdf->GetY();
            $pdf->SetY($y + 3);
            $pdf->SetX(60);
            $pdf->MultiCell($w[2], 4, $producten[$i][2], '');
            $pdf->Ln();
            $pdf->Line($pdf->GetX(), $pdf->GetY(), 195, $pdf->GetY());
        }
        $pdf->Cell(0, 5, '', 0, 1);

        /*         * ********** */
//Prijzen
        /*         * ********** */
//prijs berekeningen
        $subtotaal = 0; //totaalprijs zonder btw
        for ($i = 0; $i <= $teller; $i++)
        {
            $subtotaal += $producten[$i][4]; //nummer 4 zijn de totaal prijzen van een product
        }
        $btw = $subtotaal * 0.21; //de btw prijs
        $totaal = 0; //de totaale prijs
//kijkt of er korting is
        if (isset($_POST['korting']) && !empty($_POST['korting']))
        {
//controleert of de korting wel tussen de 1-100 zit
            $korting = floatval($_POST['korting']);
            if ($korting >= 1 && $korting <= 100)
            {
//je krijgt korting
                $korting = $subtotaal * ($korting / 100); //berekent de korting in euros
            } else
            {
                $korting = 0;
            }
        } else
        {
            $korting = 0;
        }
//de totaal prijs wordt eerst de subtotaal met de btw en daarna gaat de korting ervanaf
        EURO . $totaal = ($subtotaal + $btw) - $korting; //namen van prijzen
        $pdf->SetX(130); //de prijzen worden aan de rechter kant getoond
        $y = $pdf->GetY();  //positie waar de tekst begint
        $pdf->Cell(20, 5, 'Sub Totaal: ', 0, 2);
        $pdf->Cell(20, 5, 'Korting: ', 0, 2);
        $pdf->Cell(20, 5, 'BTW: ', 0, 2);
        $pdf->Cell(20, 2, '', 0, 2); //lege regel voor de lijn
        $pdf->Cell(20, 10, 'Totaal: ', 0, 2);
//prijzen tonen
        $pdf->SetY($y);     //set de y positie waar de tekst begon
        $pdf->SetX(175);    //verandert de x zodat het aan de rechterkant komt
        $pdf->Cell(20, 5, EURO . number_format((float) EURO . $subtotaal, 2, '.', ''), 0, 2);
        $pdf->Cell(20, 5, EURO . number_format((float) EURO . $korting, 2, '.', ''), 0, 2);
        $pdf->Cell(20, 5, EURO . number_format((float) EURO . $btw, 2, '.', ''), 0, 2);
        $pdf->Cell(20, 2, '_________', 0, 2);

        $pdf->Cell(20, 10, EURO . number_format((float) EURO . $totaal, 2, '.', ''), 0, 2);

        /*         * ************* */
//Foto
        /*         * ************* */
        //$pdf->AddPage();


        /*         * ************* */
//de pdf opslaan
        /*         * ************* */
//pad maken
        $pad = 'pdf/'; //begin, de map waar alle pdfjes komen
        $pad .= $soort; //de soort pdf:factuur of offerte
        $pad .= '-'; //scheidingsteken
        $pad .= uniqid(); //een unieke id
        $pad .= '.pdf'; //extensie
        if (file_exists($pad))
        {
            $this->foutGoedMelding('danger', '<strong>Foutmelding</strong> Er is iets fout gegaan!');
        } else
        {
            $pdf->Output($pad, 'F'); //slaat de pdf op
        }

//plaats aangemaakte informatie in de request voor later gebruik
        $_REQUEST['pdf_pad'] = $pad;
        $_REQUEST['de_pdf'] = $pdf;

        return $producten;
    }

    public function productControle($productenArray)
    {
        foreach ($productenArray as $info)
        {
            $productenNaam[] = $info[0];
        }


        foreach (array_count_values($productenNaam) as $val => $c)
        {
            if ($c > 1)
            {
                $dups[] = $val;
            }
        }
        if (empty($dups) && !isset($dups))
        {
            return 'GEENDUPS';
        } else
        {
            return 'DUPS';
        }
    }

    public function geefBesteldeProducten($nieuwBesteldeProducten)
    {
        for ($i = 0; $i < count($nieuwBesteldeProducten); $i++)
        {
            $productnaam[$i] = $nieuwBesteldeProducten[$i][0];
        }

        for ($x = 0; $x < count($productnaam); $x++)
        {
            $sql = 'SELECT * FROM `producten` WHERE `naam` = :naam ';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':naam', $productnaam[$x]);
            $stmnt->execute();
            $gekozenProduct[$x] = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Product');
        }
        $_SESSION['producten'] = $gekozenProduct;
        return $gekozenProduct;
    }

//voegt een PDF in de datbasetabe pdf
    public function pdfToevoegen()
    {
        $datum = Date("Y-m-d"); //datum van vandaag
        $pdf = $_REQUEST['pdf_pad']; //pas naar de pdf bestand
        $soort = $_POST['soort']; //factuur of offerte
        $klantid = $_POST['klant_id'];
        $sql = 'INSERT INTO 
                `facturen`(`datum`, `pdf`, `soort`, `klant_id`)
                VALUES (:datum,:pdf,:soort,:klant_id)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':datum', $datum);
        $stmnt->bindParam(':pdf', $pdf);
        $stmnt->bindParam(':soort', $soort);
        $stmnt->bindParam(':klant_id', $klantid);
        $stmnt->execute();
        $id = $this->db->lastInsertId();
        $_POST['Factuur_id'] = $id;
    }

    public function geefPdfBijNaam()
    {
        $pdfpad = $_REQUEST['pdf_pad'];
        $sql = 'SELECT * FROM `facturen` WHERE `pdf` = :pdf';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':pdf', $pdfpad);
        $stmnt->execute();
        $pdf = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Factuur');
        return $pdf[0];
    }

    public function geefFactuur()
    {
        if (isset($_REQUEST['factuur_id']) && !empty($_REQUEST['factuur_id']))
        {
            $id = $_REQUEST['factuur_id'];
        } elseif (isset($_POST['factuur_id']) && !empty($_POST['factuur_id']))
        {
            $id = $_POST['factuur_id'];
        }

        $sql = 'SELECT * FROM `facturen` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $pdf = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Factuur');
        return $pdf[0];
    }

    public function geefFactuurPdf()
    {
        $id = $_POST['Factuur_id'];
        $sql = 'SELECT * FROM `facturen` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $pdf = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Factuur');
        return $pdf[0];
    }

    public function geefKlantFacturen()
    {
        $id = $_REQUEST['klant_id'];
        $sql = 'SELECT * FROM `facturen` WHERE `klant_id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $facturen = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Factuur');
        return $facturen;
    }

    public function veranderStatusFactuur($factuur)
    {
        $id = $factuur->geefId();
        $status = 'verzonden';
        $sql = 'UPDATE `facturen` SET `status`=:status WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':status', $status);
        $stmnt->execute();
    }

    public function verwijderFactuur()
    {
//verwijerd de bestand
        $factuur = $_REQUEST['factuur_pad'];
        unlink($factuur);

//verwijderd de factuur uit de database
        $id = $_REQUEST['factuur_id'];
        $sql = 'DELETE FROM `facturen` WHERE `id` = :id LIMIT 1';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    /* ============================
     *          MAIL DE PDF
      ============================= */

    public function stuurMail($factuur)
    {
//status van factuur veranderen
        $this->veranderStatusFactuur($factuur); //verandert de status naar verzonden
//Klant ophalen
        $klant = $this->geefKlant();

        $random_hash = md5(time());

//de bijlagen
        //$file1 = $factuur->geefPdf();
//waar de mail wordt verzonden
        $to = filter_var($klant->geefEmail(), FILTER_SANITIZE_EMAIL) ? true : false; //TEST
        if ($to === true)
        {
//de onderwerp
            $subject = $factuur->geefSoort() . ' Armand-It-Service';
//header
            $headers = 'From: n.unal@mondriaanict.nl' . "\r\n" .
                    'Reply-To: n.unal@mondriaanict.nl' . "\r\n";

            //$attachment1 = chunk_split(base64_encode(file_get_contents($file1)));
            $achternaam = ucfirst($klant->geefAchternaam()); //eerste letter wordt een hoofdletter
//geen spatie of tabs bij de email_message
            $message = 'testmail';

//controlle of de mail wordt verzonden

            if (mail($to, $subject, $message, $header))
            {
                echo "Email sent";
                $this->setLog('Mail verzenden', 'Gelukt');
                $this->foutGoedMelding('success', 'Uw mail is <strong> verzonden </strong>');
            } else
            {
                echo "Email sending failed";
                $this->setLog('Mail verzenden', 'Mislukt');
                $this->foutGoedMelding('danger', '<strong> Foutmelding </strong> Mail is niet verzonden.');
            }
        } else
        {
            $this->foutGoedMelding('danger', '<strong> Foutmelding </strong> Mail klant klopt niet!');
            $this->setLog('Mail sturen', 'Mislukt');
            exit();
        }
    }

    /* ============================
     *          PRODUCTEN
      ============================= */

//geeft alle producten
    public function geefProducten()
    {
        $sql = 'SELECT * FROM `producten`';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $producten = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Product');
        return $producten;
    }

//geeft 1 product
    public function geefProduct($deId)
    {
        $id = $deId;
        $sql = 'SELECT * FROM `producten` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $product = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Product');
        return $product[0];
    }

//maakt een nieuwe product
    public function maakProduct()
    {
        $foto = '';
//controleert of er een foto/file is meegegeven
        if (isset($_FILES) && !empty($_FILES['file']['name']))
        {
            $foto = $_POST['naam'] . '.jpg';
            $tmpNaam = $_FILES['file']['tmp_name'];
            $type = $_FILES['file']['type'];
//controleert of het een foto is
            if ($type == 'image/jpeg' || $type == 'image/jpg' /* || $type == 'image/gif' */ || $type == 'image/png')
            {
//padverwijzing 
                $path = './img/producten/' . $_POST['naam'] . '.jpg';
                move_uploaded_file($tmpNaam, $path);
            }
        }

        $naam = $_POST['naam'];
        $beschrijving = $_POST['beschrijving'];
        $prijs = $_POST['prijs'];
        $sql = 'INSERT INTO 
                `producten` (`naam`, `beschrijving`, `prijs`, `foto`)
                VALUES (:naam,:beschrijving,:prijs,:foto)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':naam', $naam);
        $stmnt->bindParam(':beschrijving', $beschrijving);
        $stmnt->bindParam(':prijs', $prijs);
        $stmnt->bindParam(':foto', $foto);
        $stmnt->execute();
    }

    //wijzigt een product
    public function wijzigProduct()
    {
        $foto = $_POST['foto'];
        //controleert of er een file is meegegeven
        if (isset($_FILES) && !empty($_FILES['file']['name']))
        {
            $foto = $_POST['naam'] . '.jpg';
            $tmpNaam = $_FILES['file']['tmp_name'];
            $type = $_FILES['file']['type'];
            //controleert of het een foto is
            if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/gif' || $type == 'image/png')
            {
                //padverwijzing 
                $path = './img/producten/' . $_POST['naam'] . '.jpg';
                move_uploaded_file($tmpNaam, $path);
            }
        }

        $id = $_POST['product_id'];
        $naam = $_POST['naam'];
        $beschrijving = $_POST['beschrijving'];
        $prijs = $_POST['prijs'];
        $sql = 'UPDATE `producten` 
                SET `naam`=:naam,
                    `beschrijving`=:beschrijving,
                    `prijs`=:prijs,
                    `foto`=:foto
                WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':naam', $naam);
        $stmnt->bindParam(':beschrijving', $beschrijving);
        $stmnt->bindParam(':prijs', $prijs);
        $stmnt->bindParam(':foto', $foto);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

//verwijdert een product
    public function verwijderProduct()
    {
        $id = $_REQUEST['product_id'];
        $sql = 'SELECT `foto` FROM `producten` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $result = $stmnt->fetchColumn();
        $file = 'img/producten/' . $result;
        unlink($file);
        $sql = 'DELETE FROM `producten` WHERE `id` = :id LIMIT 1';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

//controleert of de product al bestaat
    public function bestaatProduct()
    {
        $naam = $_POST['naam'];
        $sql = 'SELECT * FROM `producten` WHERE `naam` = :naam';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':naam', $naam);
        $stmnt->execute();
        $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Product');
        if (count($result) === 1)
        {
            return true;
        } else
        {
            return false;
        }
    }

    /* ============================
     *          MAIL
      ============================= */

//maakt een nieuwe mail aan
    public function maakMail()
    {
        $mail = $_POST['mail'];
        $id = $_POST['klant_id'];
        $sql = 'INSERT INTO 
                `mails` (`mail`, `klant_id`)
                VALUES (:mail,:klant_id)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->bindParam(':klant_id', $id);
        $stmnt->execute();
    }

//geeft alle mails
    public function geefMails()
    {
        $id = $_REQUEST['klant_id'];
        $sql = 'SELECT * FROM `mails` WHERE `klant_id` = :klant_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klant_id', $id);
        $stmnt->execute();
        $mails = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Mail');
        return $mails;
    }

//verwijdert een mail
    public function verwijderMail()
    {
        $id = $_REQUEST['mail_id'];
        $sql = 'DELETE FROM `mails` WHERE `id` = :id LIMIT 1';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    public function geefMail()
    {
        $id = $_REQUEST['mail_id'];
        $sql = 'SELECT * FROM `mails` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $mail = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Mail');
        return $mail[0];
    }

    public function wijzigMail()
    {

        $id = $_POST['mail_id'];
        $mail = $_POST['mail'];

        $sql = 'UPDATE `mails` SET 
            `mail` = :mail
            WHERE `id` = :id;';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':mail', $mail);
        $stmnt->execute();
    }

    /* ============================
     *     SERVER GEGEVENS
      ============================= */

//maakt een nieuwe server gegevens aan
    public function maakServer()
    {
        $id = $_POST['klant_id'];
        $naam = $_POST['naam'];
        $ip = $_POST['ip'];
        $inlognaam = $_POST['inlognaam'];
        $wachtwoord = $_POST['wachtwoord'];
        $sql = 'INSERT INTO 
                `servers` (`naam`, `ip`, `inlognaam`, `wachtwoord`, `klant_id`)
                VALUES (:naam,:ip,:inlognaam,:wachtwoord,:klant_id)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':naam', $naam);
        $stmnt->bindParam(':ip', $ip);
        $stmnt->bindParam(':inlognaam', $inlognaam);
        $stmnt->bindParam(':wachtwoord', $wachtwoord);
        $stmnt->bindParam(':klant_id', $id);
        $stmnt->execute();
    }

//geeft alle servers gegevens mee
    public function geefServers()
    {
        $id = $_REQUEST['klant_id'];
        $sql = 'SELECT * FROM `servers` WHERE `klant_id` = :klant_id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klant_id', $id);
        $stmnt->execute();
        $servers = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Server');
        return $servers;
    }

//geeft 1 server gegevens mee
    public function geefServer()
    {
        $id = $_REQUEST['server_id'];
        $sql = 'SELECT * FROM `servers` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $server = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Server');
        return $server[0];
    }

//verwijdert een server gegevens
    public function verwijderServer()
    {
        $id = $_REQUEST['server_id'];
        $sql = 'DELETE FROM `servers` WHERE `id` = :id LIMIT 1';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

//wijzigt de gegevens
    public function wijzigServer()
    {
        $id = $_POST['server_id'];
        $naam = $_POST['naam'];
        $ip = $_POST['ip'];
        $inlognaam = $_POST['inlognaam'];
        $wachtwoord = $_POST['wachtwoord'];

        $sql = 'UPDATE `servers` SET 
            `naam` = :naam,
            `ip` = :ip,
            `inlognaam` = :inlognaam,
            `wachtwoord`= :wachtwoord
            WHERE `id` = :id;';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':naam', $naam);
        $stmnt->bindParam(':ip', $ip);
        $stmnt->bindParam(':inlognaam', $inlognaam);
        $stmnt->bindParam(':wachtwoord', $wachtwoord);
        $stmnt->execute();
    }

// wijzigt user gegevens
    public function wijzigMijnGegevens()
    {

        $id = $_POST['gebruiker_id'];
        $voornaam = $_POST['voornaam'];
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
        $foto = $_FILES['foto']['name'];

        $_SESSION['gebruiker']->zetVoornaam($voornaam);
        $_SESSION['gebruiker']->zetTussenvoegsel($tussenvoegsel);
        $_SESSION['gebruiker']->zetAchternaam($achternaam);
        $_SESSION['gebruiker']->zetMail($mail);
        $_SESSION['gebruiker']->zetFoto($foto);
    }

    public function geefStandaardWachtwoord()
    {
        $sql = 'SELECT AES_DECRYPT(standaardwachtwoord, :key) AS standaardwachtwoord FROM `settings` WHERE 1';

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':key', $this->key);
        $stmnt->execute();
        $standaardwachtwoord = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Wachtwoord');
        return $standaardwachtwoord[0];
    }

    public function resetWachtwoord($wachtwoord)
    {
        $standaardWachtwoord = $wachtwoord->geefWachtwoord();
        if (!empty($wachtwoord) && isset($wachtwoord))
        {
            $id = $_REQUEST['gebruiker_id'];
            $sql = 'UPDATE `gebruikers` SET `wachtwoord` = AES_ENCRYPT(:wachtwoord,:key) WHERE id = :id';

            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->bindParam(':wachtwoord', $standaardWachtwoord);
            $stmnt->bindParam(':key', $this->key);
            $stmnt->execute();
        }
    }

    public function wijzigStandaardWachtwoord()
    {
        $wachtwoord = $_POST['standaardWachtwoord'];
        if (isset($_POST['standaardWachtwoord']))
        {
            $sql = "UPDATE `settings` SET `standaardwachtwoord` = AES_ENCRYPT(:wachtwoord, :key) WHERE id = 1;";
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':wachtwoord', $wachtwoord);
            $stmnt->bindParam(':key', $this->key);
            $stmnt->execute();
        }
    }

    public function updateFoto($id)
    {
        if (isset($_FILES['foto']) && (!empty($_FILES['foto'])))
        {
            $tmpNaam = $_FILES['foto']['tmp_name'];
            $type = $_FILES['foto']['type'];
            if ($type == 'image/jpeg' || 'image/jpg' || 'image/gif' || 'image/png')
            {
                $fotoNaam = $_FILES['foto']['name'];
                $foto = './images/' . $fotoNaam;

                $sql = 'update `gebruikers` SET `foto` = :foto WHERE `id` =:id';
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':id', $id);
                $stmnt->bindParam(':foto', $fotoNaam);
                $stmnt->execute();

                move_uploaded_file($tmpNaam, $foto);
            }
        } else
        {
            $sql = 'update `gebruikers` SET `foto` = "noImage.png" WHERE `id` =:id';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $Id);
            $stmnt->execute();
        }
    }

    public function ProductView()
    {
        $sql = 'SELECT * FROM `producten`';

        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $products = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Product');
        return $products;
    }

    public function wijzigVoorraad()
    {
        $Id = $_POST['id'];

        $voorraad = $_POST['voorraad'];

        $sql = 'update `producten` SET `voorraad` = :voorraad WHERE `id` =:id';

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $Id);
        $stmnt->bindParam(':voorraad', $voorraad);
        $stmnt->execute();
    }

    public function geefLaatsteStoringen()
    {
        $sql = 'SELECT * FROM `storingen` ORDER BY `id` DESC LIMIT 0, 2';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $storingen = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Storingen');
        return $storingen;
    }

    public function geefStoringen()
    {
        $sql = 'SELECT * FROM `storingen` ORDER BY `id` DESC';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $storingen = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Storingen');
        return $storingen;
    }

    public function storingToevoegen()
    {
        $titel = $_POST['titel'];
        if (!empty($titel) && isset($titel))
        {

            $omschrijving = $_POST['omschrijving'];
            $startDatum = $_POST['startDatum'];
            $eindDatum = $_POST['eindDatum'];
            $status = 'Lopend';
            $sql = 'INSERT INTO 
                `storingen` (`titel`, `omschrijving`, `start_datum`, `eind_datum`, `status`)
                VALUES (:titel, :omschrijving, :startDatum, :eindDatum, :status)';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':titel', $titel);
            $stmnt->bindParam(':omschrijving', $omschrijving);
            $stmnt->bindParam(':startDatum', $startDatum);
            $stmnt->bindParam(':eindDatum', $eindDatum);
            $stmnt->bindParam(':status', $status);
            $stmnt->execute();
            return 'GELUKT';
        } else
        {
            return 'MISLUKT';
        }
    }

    public function wijzigMagazijn($productenNieuw, $productenOud)
    {
        for ($x = 0; $x < count($productenOud); $x++)
        {
            $naamNieuw[$x] = $productenNieuw[$x][0]->geefNaam();
            $naamOud[$x] = $productenOud[$x][0];
            if ($naamOud[$x] === $naamNieuw[$x])
            {
                $getal1 = $productenNieuw[$x][0]->geefVoorraad();
                $getal2 = $productenOud[$x][1];
                $nieuwNieuwVoorraad[$x][0] = $naamOud[$x];
                $nieuwNieuwVoorraad[$x][1] = $getal1 - $getal2;

                $sql = 'update `producten` SET `voorraad` = :voorraad WHERE `naam` =:naam';

                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':naam', $nieuwNieuwVoorraad[$x][0]);
                $stmnt->bindParam(':voorraad', $nieuwNieuwVoorraad[$x][1]);
                $stmnt->execute();
            } else
            {
                echo "FOUTJE";
            }
        }
    }

    public function geefSelectedStoring()
    {
        $storingId = $_GET['storingId'];
        $sql = 'SELECT * FROM `storingen` WHERE `id`  = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $storingId);
        $stmnt->execute();
        $storingen = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Storingen');
        return $storingen[0];
    }

    public function storingWijzigen()
    {
        $id = $_POST['id'];
        $titel = $_POST['titel'];
        $omschrijving = $_POST['omschrijving'];
        $startDatumGeenFormat = $_POST['startDatum'];
        $startDatum = date("Y-m-d", strtotime($startDatumGeenFormat));
        $eindDatumGeenFormat = $_POST['eindDatum'];
        $eindDatum = date("Y-m-d", strtotime($eindDatumGeenFormat));
        $status = $_POST['status'];

        $sql = ' UPDATE `storingen` SET `titel` = :titel,
                        `omschrijving` = :omschrijving,
                        `start_datum` = :startDatum, 
                        `eind_datum` = :eindDatum,
                        `status` = :status WHERE `id` = :id ';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':titel', $titel);
        $stmnt->bindParam(':omschrijving', $omschrijving);
        $stmnt->bindParam(':startDatum', $startDatum);
        $stmnt->bindParam(':eindDatum', $eindDatum);
        $stmnt->bindParam(':status', $status);
        $stmnt->execute();
    }

    public function storingWijzigStatus()
    {
        $id = $_GET['id'];
        $status = $_GET['status'];

        switch ($status)
        {
            case"Lopend":
                $sql = ' UPDATE `storingen` SET `status` = "Opgelost" WHERE `id` = :id ';
                break;
            case"Opgelost":
                $sql = ' UPDATE `storingen` SET `status` = "Lopend" WHERE `id` = :id ';
                break;
        }
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
    }

    public function storingVerwijderen()
    {
        $id = $_GET['id'];
        if (!empty($id) && isset($id))
        {
            $sql = 'DELETE FROM `storingen` WHERE `id` = :id';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->execute();
            return "GELUKT";
        } else
        {
            return "MISLUKT";
        }
    }

    public function geefNotificatie()
    {
        $sql = 'SELECT * FROM `notifications` LIMIT 0, 4';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $notificaties = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Notificaties');

        return $notificaties;
    }

    public function wijzigNotificatieStatus()
    {
        $status = 'non-active';
        $id = $_GET['id'];

        $sql = 'UPDATE `notifications` SET `active` = :status WHERE `id` = :id ';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':status', $status);
        $stmnt->execute();
    }

    public function voegNotificatieToe()
    {

        //$id = $this->db->lastInsertId();
    }

    public function getLogs()
    {
        $sql = 'SELECT logs.id ,logs.log, '
                . 'logs.ip_adres,logs.status, gebruikers.voornaam, '
                . 'gebruikers.achternaam, logs.datum_log, '
                . 'logs.tijd_log FROM gebruikers '
                . 'JOIN log_gebruiker ON gebruikers.id = log_gebruiker.gebruiker_id '
                . 'JOIN logs ON logs.id = log_gebruiker.log_id '
                . 'ORDER BY logs.id ASC';
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $logs = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Logs');
        return $logs;
    }

    public function geefKlantParam($id)
    {
        $sql = 'SELECT * FROM `klanten` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $klant = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Klant');
        return $klant[0];
    }

    public function geefGebruikerParam($id)
    {
        $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $gebruiker = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Gebruiker');
        return $gebruiker[0];
    }

    public function joinUserAndGebruikerOnNaam($gebruiker)
    {
        $voornaam = $gebruiker->geefVoornaam();
        $achternaam = $gebruiker->geefAchternaam();
        $sql = 'SELECT `id`, `first_name`, `last_name` FROM `users` WHERE `first_name` = :voornaam AND `last_name` = :achternaam';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':voornaam', $voornaam);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->execute();
        $users = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        return $users[0];
    }

    public function voegAgendaEventToe($id)
    {
        $ticket = $this->geefTicketParam($id);
        $gebruiker_id = $ticket->geefGebruiker_id();

        $gebruiker = $this->geefGebruikerParam($gebruiker_id);

        $user = $this->joinUserAndGebruikerOnNaam($gebruiker);
        $user_id = $user['id'];


        $klant = $this->geefKlantParam($ticket->geefKlant_id());

        $agendaName = 'Afspraak ' . $klant->geefNaam();
        $description = 'Ticketnummer: ' . $ticket->geefId()
                . ' Ticketopmerking: ' . $ticket->geefOpmerking()
                . ' Naam: ' . $klant->geefNaam()
                . ' Adresgegevens: ' . $klant->geefStraatnaam() . ' ' . $klant->geefHuisnummer()
                . ' postcode, woonplaats: ' . $klant->geefPostcode() . ' ' . $klant->geefWoonplaats();

        $datumAfspraak = $ticket->geefAfspraak_datum();
        $formatDbDatum = $this->geefFormatDatumNaarYMD($datumAfspraak);

        $start = $formatDbDatum . ' ' . $ticket->geefAankomst() . ':00';
        $end = $formatDbDatum . ' ' . $ticket->geefVertrek() . ':00';
        $all_day = 0;
        $is_recurring = 0;
        $recurring_id = NULL;
        $active = 0;

        $sql = 'INSERT INTO `events` (`user_id`, `name`, `description`,`start`,`end`,`all_day`,`is_recurring`,`recurring_id`,`active`,`created`)'
                . 'VALUES (:user_id, :agendaNaam, :description, :start, :end, :all_day, :is_recurring, :recurring_id, :active, CURRENT_DATE)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':user_id', $user_id);
        $stmnt->bindParam(':agendaNaam', $agendaName);
        $stmnt->bindParam(':description', $description);
        $stmnt->bindParam(':start', $start);
        $stmnt->bindParam(':end', $end);
        $stmnt->bindParam(':all_day', $all_day);
        $stmnt->bindParam(':is_recurring', $is_recurring);
        $stmnt->bindParam(':recurring_id', $recurring_id);
        $stmnt->bindParam(':active', $active);
        $stmnt->execute();
        $event_id = $this->db->lastInsertId();

        $this->zetEvents_user($user_id, $event_id);
    }

    public function zetEvents_user($user_id, $event_id)
    {
        $sql = 'INSERT INTO `events_users` (`event_id`, `user_id`, `status_id`)'
                . 'VALUES (:event_id, :user_id, 2)';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':event_id', $event_id);
        $stmnt->bindParam(':user_id', $user_id);

        $stmnt->execute();
    }

    // beschikbaarheden van de opgegeven week ophalen indien die bestaan.
    public function getBeschikbaarheidParam($weeknummer)
    {
        $gebruiker_id = $_SESSION['gebruiker']->geefId();

        $sql = 'SELECT * FROM `uren` AS u JOIN `beschikbaarheid` AS b ON u.beschikbaarheid_id = b.id WHERE b.gebruiker_id = :id AND b.weeknummer = :weeknr';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $gebruiker_id);
        $stmnt->bindParam(':weeknr', $weeknummer);
        $stmnt->execute();
        $beschikbaarheid = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        if (count($beschikbaarheid) > 1)
        {
            return $beschikbaarheid;
        } else
        {
            return 'geenBeschikbaarheid';
        }
    }

    // beschikbaarheden van de huidige week pakken
    public function getBeschikbaarheidHW()
    {
        $gebruiker_id = $_SESSION['gebruiker']->geefId();
        $weeknummer = date('W');
        $sql = 'SELECT * FROM `uren` JOIN `beschikbaarheid` AS b ON b.weeknummer = :weeknummer WHERE b.gebruiker_id = :id';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':weeknummer', $weeknummer);
        $stmnt->bindParam(':id', $gebruiker_id);
        $stmnt->execute();
        $uren = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        return $uren;
    }

    public function checkStatus()
    {
        $beschikbaarheid[0] = $_POST['StatusMa'];
        $beschikbaarheid[1] = $_POST['StatusDi'];
        $beschikbaarheid[2] = $_POST['StatusWo'];
        $beschikbaarheid[3] = $_POST['StatusDo'];
        $beschikbaarheid[4] = $_POST['StatusVr'];
        $beschikbaarheid[5] = $_POST['StatusZa'];
        $beschikbaarheid[6] = $_POST['StatusZo'];


        $i = 0;
        $boolDagen = array();
        foreach ($beschikbaarheid as $beschikbaar)
        {
            if ($beschikbaar === "Niet beschikbaar")
            {
                $boolDagen[$i] = false;
            } else
            {
                $boolDagen[$i] = true;
            }
            $i++;
        }
        return $boolDagen;
    }

    public function zetBeschikbaarheid($dates, $weeknummer, $statussen)
    {
        $id = $_SESSION['gebruiker']->geefId();

        $sqlMain = "INSERT INTO `beschikbaarheid` (`gebruiker_id` , `weeknummer`)
                    VALUES(:id,:weeknummer)";
        $stmntMain = $this->db->prepare($sqlMain);
        $stmntMain->bindParam(':id', $id);
        $stmntMain->bindParam(':weeknummer', $weeknummer);
        $stmntMain->execute();
        $last_b_id = $this->db->lastInsertId();
        
        // neem alle beschikbaarheden op van alle dagen
        $beschikbaarheid[1] = $_POST['Ma_status'];
        $beschikbaarheid[2] = $_POST['Di_status'];
        $beschikbaarheid[3] = $_POST['Wo_status'];
        $beschikbaarheid[4] = $_POST['Do_status'];
        $beschikbaarheid[5] = $_POST['Vr_status'];
        $beschikbaarheid[6] = $_POST['Za_status'];
        $beschikbaarheid[7] = $_POST['Zo_status'];
        // dagen van de week afgekort zodat het overheenkomt met de prefix van de uren in beschikbaarheid.php
        $t = array('Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo');
        // c wordt aangemaakt voor alle uren die zijn aangemaakt indien sommige uren van de dag men niet beschikbaar is.
        
        $c = 0;
        
        // for loop voor alle uren wat in de post opgeslagen is, die in de sql zetten en gelijk uitvoeren.
        //
        for ($a = 1; $a <= count($t); $a++)
        {
            $uurVan[$a] = $_POST[$t[$c] . '_uurVan'];
            $uurTot[$a] = $_POST[$t[$c] . '_uurTot'];
            $c++;

            $sql = 'INSERT INTO `uren` (`beschikbaarheid_id`, `uurVan`, `uurTot`,`status`,`datum`)'
                    . 'VALUES (:bid, :uurVan, :uurTot, :status, :datum)';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':bid', $last_b_id);
            $stmnt->bindParam(':uurVan', $uurVan[$a]);
            $stmnt->bindParam(':uurTot', $uurTot[$a]);
            $stmnt->bindParam(':status', $beschikbaarheid[$a]);
            $stmnt->bindParam(':datum', $dates[$a]);
            $stmnt->execute();
        }
    }

    public function updateBeschikbaarheden()
    {
        $id = $_POST['beschikbaarheid_id'];

        $beschikbaarheid[1] = $_POST['Ma_status'];
        $beschikbaarheid[2] = $_POST['Di_status'];
        $beschikbaarheid[3] = $_POST['Wo_status'];
        $beschikbaarheid[4] = $_POST['Do_status'];
        $beschikbaarheid[5] = $_POST['Vr_status'];
        $beschikbaarheid[6] = $_POST['Za_status'];
        $beschikbaarheid[7] = $_POST['Zo_status'];
        
        // DE PARAMETER VOOR DATES NOG TOEVOEGEN, PARAMETER MOET DE WEEKNUMMER BEVATTEN!!!
        //$this->getDates();

        $t = array('Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo');
        $c = 0;
        for ($a = 1; $a <= count($t); $a++)
        {
            $uurVan[$a] = $_POST[$t[$c].'_uurVan'];
            $uurTot[$a] = $_POST[$t[$c].'_uurTot'];
            
            
            $sql = 'UPDATE `uren` SET
            `uurVan` = :uurVan,
            `uurTot` = :uurTot,
            `status` = :status
            WHERE `beschikbaarheid_id` = :id';
            $c++;
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);
            $stmnt->bindParam(':uurTot', $uurTot[$a]);
            $stmnt->bindParam(':uurVan', $uurVan[$a]);
            $stmnt->bindParam(':status', $beschikbaarheid[$a]);
            $stmnt->execute();
        }
        echo 'Beschikbaarheid ID: ' . $id;
    }

    public function controleerWeeknummers()
    {
        $id = $_SESSION['gebruiker']->geefId();
        $sql = 'SELECT `weeknummer` FROM `beschikbaarheid` WHERE `gebruiker_id` = :id AND `weeknummer` = :weeknummer';
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':weeknummer', $_POST['weeknummer']);
        $stmnt->execute();
        $weeknummers = $stmnt->fetchAll(\PDO::FETCH_ASSOC);

        echo 'week nummer count';
        var_dump($weeknummers);

        if (count($weeknummers) === 0)
        {
            return 'NONE';
        }
        elseif (count($weeknummers) === 1)
        {
            return 'SINGLE';
        }
        else
        {
            return 'DUPS';
        }
    }

//    public function getBeschikbareExpert($ticket_id)
//    {
//
//        $sql = 'SELECT * FROM `tickets` WHERE `id` = :id';
//        $stmnt = $this->db->prepare($sql);
//        $stmnt->bindParam(':id', $ticket_id);
//        $stmnt->execute();
//        $ticket = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
//
//
//        $aankomstTijd = $ticket[0]['aankomst'];
//        $vertrekTijd = $ticket[0]['vertrek'];
//        $dag = date('l', $ticket[0]['afspraak_datum']);
//        $dagnummer = date('N', $ticket[0]['afspraak_datum']);
//        $weeknummer = date('W');
//
//
//        $sql2 = 'SELECT * FROM `gebruikers` AS g JOIN `beschikbaarheid` as b ON b.gebruiker_id = g.id AND b.week_nr = :weeknummer AND   ';
//
//    }
//}
//
    public function getDates($weeknummer)
    {
        $year = date("Y");
        for ($day = 1; $day <= 7; $day++)
        {

            $datum[$day] = date('Y-m-d', strtotime($year . "W" . str_pad($weeknummer, 2/* default :2 */, '0'/* default 0 */, STR_PAD_RIGHT) . $day));
        }
        return $datum;
    }

}
