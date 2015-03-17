<?php
namespace infosysteem\models;

class Wachtwoord
{
    private $id;
    private $standaardwachtwoord;

    public function geefId()
    {
        return $this->id;
    }

    public function geefWachtwoord()
    {
        return $this->standaardwachtwoord;
    }
}
