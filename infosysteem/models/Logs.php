<?php
namespace infosysteem\models;
class Logs {
    private $id, $gebruiker_id, $tijd_log,
            $ip_adres, $log, $status, $datum_log,
            $voornaam, $achternaam ;


    public function geefId()
    {
        return $this->id;
    }
    
    public function geefGebruiker_id()
    {
        return $this->gebruiker_id;
    }
    
    public function geefTijd_log()
    {
        return $this->tijd_log;
    }
    
    public function geefIp_adres()
    {
        return $this->ip_adres;
    }
    
    public function geefLog()
    {
        return $this->log;
    }
    
    public function geefStatus()
    {
        return $this->status;
    }
    
    public function geefDatum_log()
    {
        $originalDate = $this->datum_log;
        $newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
    }
    
    public function geefAchternaam() {
        return $this->achternaam;
    }

    public function geefVoornaam() {
        return $this->voornaam;
    }
    
}


