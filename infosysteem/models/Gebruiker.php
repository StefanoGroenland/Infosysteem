<?php

namespace infosysteem\models;

class Gebruiker {

    private $id;
    private $voornaam;
    private $tussenvoegsel;
    private $achternaam;
    private $gebruikersnaam;
    private $foto;
    private $wachtwoord;
    private $mail;
    private $gebruikerstype;
    private $klant_id;

    public function geefId() {
        return $this->id;
    }

    public function geefNaam() {
        $naam = $this->voornaam . ' ';
        if ($this->tussenvoegsel !== '') {
            $naam .= $this->tussenvoegsel . ' ';
        }
        $naam .= $this->achternaam;
        return $naam;
    }

    public function zetVoornaam($nieuwVoornaam) {
        $this->voornaam = $nieuwVoornaam;
    }

    public function zetTussenvoegsel($nieuwTussenvoegsel) {
        $this->tussenvoegsel = $nieuwTussenvoegsel;
    }

    public function geefAchternaam() {
        return $this->achternaam;
    }

    public function geefGebruikersnaam() {
        return $this->gebruikersnaam;
    }
    
    public function geefFoto()
    {
        return $this->foto;
    }
    
    public function zetFoto($nieuwFoto)
    {
        $this->foto = $nieuwFoto;
    }

    public function geefWachtwoord() {
        return $this->wachtwoord;
    }

    public function geefMail() {
        return $this->mail;
    }

    public function zetMail($nieuwMail) {
        $this->mail = $nieuwMail;
    }

    public function geefRecht() {
        return $this->gebruikerstype;
    }

    public function zetWachtwoord($nieuwWachtwoord) {
        $this->wachtwoord = $nieuwWachtwoord;
    }

    public function geefKlant_id() {
        return $this->klant_id;
    }

    public function geefVoornaam() {
        return $this->voornaam;
    }

    public function geefTussenvoegsel() {
        return $this->tussenvoegsel;
    }

    public function zetAchternaam($newAchternaam) {
        $this->achternaam = $newAchternaam;
    }

    public function geefStraatnaam() {
        return $this->straatnaam;
    }

    public function zetStraatnaam($newStraatNaam) {
        $this->straatnaam = $newStraatNaam;
    }

    public function geefHuisnummer() {
        return $this->huisnummer;
    }

    public function zetHuisNummer($newHuisNummer) {
        $this->huisnummer = $newHuisNummer;
    }

    public function geefPostcode() {
        return $this->postcode;
    }

    public function zetPostCode($newPostCode) {
        $this->postcode = $newPostCode;
    }

    public function geefWoonplaats() {
        return $this->woonplaats;
    }

    public function zetWoonPlaats($newWoonPlaats) {
        $this->woonplaats = $newWoonPlaats;
    }

    public function geefBedrijf() {
        return $this->bedrijf;
    }

    public function zetBedrijf($newBedrijf) {
        $this->bedrijf = $newBedrijf;
    }

    public function geefEmail() {
        return $this->email;
    }

    public function zetEmail($newMail) {
        $this->email = $newMail;
    }

    public function geefTelefoon() {
        return $this->telefoon;
    }

    public function zetTelefoon($newTelefoon) {
        $this->telefoon = $newTelefoon;
    }

    public function geefMobiel() {
        return $this->mobiel;
    }

    public function zetMobiel($newMobiel) {
        $this->mobiel = $newMobiel;
    }
    public function geefGebruikersType(){
        return $this->gebruikerstype;
    }

}
