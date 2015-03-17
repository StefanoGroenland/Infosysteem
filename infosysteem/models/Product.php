<?php
namespace infosysteem\models;

class Product {
    private $id;
    private $naam;
    private $beschrijving;
    private $prijs;
    private $foto;
    private $voorraad;
    //private $korting;
    
    public function geefId()
    {
        return $this->id;
    }
    public function geefVoorraad(){
        return $this->voorraad;
    }
    
    public function geefNaam()
    {
        return $this->naam;
    }
    
    public function geefBeschrijving()
    {
        return $this->beschrijving;
    }
    
    public function geefPrijs()
    {
        return $this->prijs;
    }
    
    public function geefFoto()
    {
        return $this->foto;
    }
    
    
    public function geefKorting()
    {
        return $this->korting;
    }
 
}


