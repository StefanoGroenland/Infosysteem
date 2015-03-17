<?php

namespace infosysteem\models;

class Notificaties
{

    private $id;
    private $storing_id;
    private $beschrijving;
    private $active;

    public function geefId()
    {
        return $this->id;
    }
    
    public function geefStoringId()
    {
        return $this->storing_id;
    }

    public function geefActive()
    {
        return $this->active;
    }
    public function geefBeschrijving()
    {
        return $this->beschrijving;
    }

}
