<?php

    namespace infosysteem\models;

    class Ticket
    {

        private $id,
            $tijdstip,
            $aankomst,
            $vertrek,
            $klant_id,
            $gebruiker_id,
            $aangemaakt_gebruiker_id,
            $opmerking,
            $aanmaak_datum,
            $afspraak_datum,
            $bezoek_datum,
            $sluit_datum,
            $tijd_veranderd,
            $datum_veranderd,
            $antwoord_tijd_veranderd,
            $antwoord_datum_veranderd,
            $status,
            $rapport,
            $rapport_datum,
            $escalatie,
            $antwoord_escalatie,
            $voornaam,
            $tussenvoegsel,
            $achternaam,
            $straatnaam,
            $huisnummer,
            $klant_gewijzigd,
            $expert_gewijzigd,
            $postcode;

        public function getExpert()
        {
            return $this->gebruiker_id;
        }

        public function getBuildUser()
        {
            return $this->aangemaakt_gebruiker_id;
        }

        public function geefId()
        {
            return $this->id;
        }

        public function geefKlant_gewijzigd()
        {
            return $this->klant_gewijzigd;
        }

        public function geefExpert_gewijzigd()
        {
            return $this->expert_gewijzigd;
        }

        public function geefSubmitExpert()
        {
            if ($this->getExpert() === $_SESSION['gebruiker']->geefId()) {
                if ($this->geefExpert_gewijzigd() < 1) {
                    echo '<button type="submit" class="btn btn-primary">Save changes</button>';
                }
            }
        }

        public function geefSubmitKantoor()
        {
            if ($this->getBuildUser() === $_SESSION['gebruiker']->geefId()) {
                if ($this->geefKlant_gewijzigd() < 1) {
                    echo '<button type="submit" class="btn btn-primary">Save changes</button>';
                }
            }
        }

        public function geefKlantDisabled()
        {

            if ($this->geefKlant_gewijzigd() > 0) {
                echo 'disabled="disabled"';
            }
        }

        public function geefExpertDisabled()
        {

            if ($this->geefExpert_gewijzigd() > 0) {
                echo 'disabled="disabled"';
            }
        }

        public function geefTijd_veranderd()
        {

            return $this->tijd_veranderd;

        }

        public function geefDatum_veranderd()
        {

            return $this->datum_veranderd;

        }

        public function geefTijd_antwoordveranderd()
        {
            return $this->antwoord_tijd_veranderd;
        }

        public function geefDatum_antwoordveranderd()
        {
            return $this->antwoord_datum_veranderd;
        }

        public function geefTijdstip()
        {
            return $this->aankomst . ' - ' . $this->vertrek;
        }

        public function geefAankomst()
        {
            return $this->aankomst;
        }

        public function geefVertrek()
        {
            return $this->vertrek;
        }

        public function geefKlant_id()
        {
            return $this->klant_id;
        }

        public function geefGebruiker_id()
        {
            return $this->gebruiker_id;
        }

        public function geefAangemaakt_gebruiker_id()
        {
            return $this->aangemaakt_gebruiker_id;
        }

        public function geefOpmerking()
        {
            return $this->opmerking;
        }

        public function geefAanmaak_datum()
        {
            return date("d-m-Y", strtotime($this->aanmaak_datum));
        }

        public function geefAfspraak_datum()
        {
            return date("d-m-Y", strtotime($this->afspraak_datum));
        }

        public function geefBezoek_datum()
        {
            if ($this->bezoek_datum != "") {
                return date("d-m-Y", strtotime($this->bezoek_datum));
            }
        }

        public function geefSluit_datum()
        {
            if ($this->sluit_datum != "") {
                return date("d-m-Y", strtotime($this->sluit_datum));
            }
        }

        public function geefStatus()
        {
            return $this->status;
        }

        public function geefRapport()
        {
            return $this->rapport;
        }

        public function geefRapport_datum()
        {
            return date("d-m-Y", strtotime($this->rapport_datum));
        }

        public function geefEscalatieKlein()
        {
            //return $this->escalatie;
            return substr($this->escalatie, 0, 13) . "...";
        }

        public function geefAntwoord_escalatieKlein()
        {
            //return $this->antwoord_escalatie;
            return substr($this->antwoord_escalatie, 0, 7) . "...";
        }

        public function geefEscalatie()
        {
            return $this->escalatie;
        }

        public function geefAntwoord_escalatie()
        {
            return $this->antwoord_escalatie;
        }

        public function geefVoornaam()
        {
            return $this->voornaam;
        }

        public function geefTussenvoegsel()
        {
            return $this->tussenvoegsel;
        }

        public function geefAchternaam()
        {
            return $this->achternaam;
        }

        public function geefStraatnaam()
        {
            return $this->straatnaam;
        }

        public function geefHuisnummer()
        {
            return $this->huisnummer;
        }

        public function geefPostcode()
        {
            return $this->postcode;
        }

    }
