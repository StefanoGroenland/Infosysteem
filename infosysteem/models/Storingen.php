<?php

namespace infosysteem\models;

class Storingen
{

    private $id;
    private $titel;
    private $omschrijving;
    private $start_datum;
    private $eind_datum;
    private $status;

    public function geefId()
    {
        return $this->id;
    }

    public function geefTitel()
    {
        return $this->titel;
    }

    public function geefOmschrijving()
    {
        return $this->omschrijving;
    }

    public function geefStartDatum()
    {
        $originalDate = $this->start_datum;
        $newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
    }

    public function geefEindDatum()
    {
        $originalDate = $this->eind_datum;
        $newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
    }

    public function geefStatus()
    {
        return $this->status;
    }

}
