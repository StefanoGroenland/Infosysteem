<?php
namespace infosysteem\models;

class BezoekerModel {
    private $db;
    //constructor voor de connectie met de database
    public function __construct()
    {
        include("DB.php");
        $this->db = new \PDO($dsn, $user, $password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
    }
    //hier wordt een check uitgevoerd of de inlog form ingevuld is of niet.
    public function isPostLeeg()
    {
       if(empty($_POST))
       {
            return true;
       }
       else
       {
           return false;
       }
    }
    // hier worden de inlog gegevens gecheckt.
    public function controleerInloggen()
    {
        if (    (isset($_REQUEST['gn'])) && 
                (!empty($_REQUEST['gn'])) && 
                (isset($_REQUEST['ww']))  && 
                (!empty($_REQUEST['ww']))   )
        {

            $gebruikersnaam = $_REQUEST['gn'];
            $wachtwoord = $_REQUEST['ww'];
            $key = 'dekeyvoordewachtwoordenindedatabase';
            $sql = 'SELECT   `id`,
                            `voornaam`,
                            `tussenvoegsel`,
                            `achternaam`,
                            `gebruikersnaam`,
                            AES_DECRYPT(wachtwoord,:key) AS `wachtwoord`,
                            `foto`,
                            `mail`,
                            `gebruikerstype`,
                            `klant_id`,
                            `last_login`
                    FROM `gebruikers` WHERE `gebruikersnaam` = :gebruikersnaam AND `wachtwoord` = AES_ENCRYPT(:wachtwoord,:key)' ;

            $sth = $this->db->prepare($sql);
            $sth->bindParam(':gebruikersnaam',$gebruikersnaam);
            $sth->bindParam(':wachtwoord',$wachtwoord);
            $sth->bindParam(':ip_adress',$ip_adress);
            $sth->bindParam(':key',$key);
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\Gebruiker');

            $_SESSION['temp_user'] = $result[0];

            if(count($result) === 1 || !empty($result))
            {   
                $_SESSION['gebruiker']=$result[0];
                return 'GELUKT';
            }
            return 'MISLUKT';
        }
        return 'ONVOLLEDIG';
    }
    // hier wordt tijdens de login de gebruiker zijn huidige IP-adres meegegeven en het huidige tijdstip en datum voor in de database
    public function setIp()
    {
        
        $temp_user = $_SESSION['temp_user'];
        $id = $temp_user->geefId();
        $ip_adress = $_SERVER['REMOTE_ADDR'];

        $sql2 = 'UPDATE `gebruikers` SET
                        `last_login` = :ip_adress,
                        `date_last_login` = :date_last_login,
                        `time_last_login` = :time_last_login
                        WHERE  `id` = :id';
        $sth2 = $this->db->prepare($sql2);
        $sth2->bindParam(':ip_adress',$ip_adress);
        $sth2->bindParam(':id', $id);
        $sth2->bindValue(':date_last_login', date("Y-m-d"));
        $sth2->bindValue(':time_last_login', date("H:i:s"));
        $sth2->execute();


    }
    // hier wordt per gebruikersnaam hun rechten meegegeven.
    public function geefRecht()
    {
        $gebruiker=$_SESSION['gebruiker'];
        return $gebruiker->geefRecht();
    }
}