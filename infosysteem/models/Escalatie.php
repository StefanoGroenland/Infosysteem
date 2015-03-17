<?php

namespace infosysteem\models;

class Escalatie
{

    private $id,
            $e_datum_aangemaakt,
            $e_a_datum_aangemaakt,
            $e_tijd_aangemaakt,
            $e_a_tijd_aangemaakt,
            $e_log,
            $e_a_log,
            $ticket_id;

    function getId()
    {
        return $this->id;
    }

    function getE_log()
    {
        return $this->e_log;
    }

    function getE_a_log()
    {
        return $this->e_a_log;
    }

    function getTicket_id()
    {
        return $this->ticket_id;
    }

    function getE_tijd_aangemaakt()
    {
        return $this->e_tijd_aangemaakt;
    }

    function getE_a_tijd_aangemaakt()
    {
        return $this->e_a_tijd_aangemaakt;
    }

    function getE_datum_aangemaakt()
    {
        $originalDate = $this->e_datum_aangemaakt;
        $newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
    }

    function getE_a_datum_aangemaakt()
    {
        $originalDate = $this->e_a_datum_aangemaakt;
        $newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
    }

    function setE_log($e_log)
    {
        $this->e_log = $e_log;
    }

    function setE_a_log($e_a_log)
    {
        $this->e_a_log = $e_a_log;
    }

}
