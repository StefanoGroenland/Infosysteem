<?php
namespace infosysteem\models;
class Mail {
    private $id;
    private $mail;
    private $klant_id;


    public function geefId()
    {
        return $this->id;
    }
    
    public function geefMail()
    {
        return $this->mail;
    }
    
    public function geefKlant_id()
    {
        return $this->klant_id;
    }
    
}


