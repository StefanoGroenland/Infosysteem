<?php
namespace infosysteem\models;
class Server {
    private $id;
    private $naam;
    private $ip;
    private $inlognaam;
    private $wachtwoord;
    private $klant_id;

    public function geefId()
    {
        return $this->id;
    }
    
    public function geefNaam()
    {
        return $this->naam;
    }
    
    public function geefIp()
    {
        return $this->ip;
    }
    
    public function geefInlognaam()
    {
        return $this->inlognaam;
    }
    
    public function geefWachtwoord()
    {
        return $this->wachtwoord;
    }
    
    public function geefKlant_id()
    {
        return $this->klant_id;
    }
}