<?php

namespace infosysteem\models;

class Factuur {

    private $id;
    private $datum;
    private $pdf;
    private $soort;
    private $klant_id;
    private $status;
    private $voorraad;
    private $korting;

    public function geefVoorraad() {
        return $this->voorraad;
    }

    public function geefId() {
        return $this->id;
    }

    public function geefDatum() {
        return $this->datum;
    }

    public function geefPdf() {
        return $this->pdf;
    }

    public function geefSoort() {
        return $this->soort;
    }

    public function geefKlant_id() {
        return $this->klant_id;
    }

    public function geefStatus() {
        return $this->status;
    }

    public function geefKorting() {
        return $this->korting;
    }

}
