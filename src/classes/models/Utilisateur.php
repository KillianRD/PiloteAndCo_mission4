<?php

namespace iutnc\PiloteAndCo\models;

use iutnc\PiloteAndCo\exceptions\InvalidPropertyNameException;

class Utilisateur
{
    private int  $id;
    private string $nom;
    private string $prenom;
    private string $mail;
    private string $password;
    private string $date_naiss;
    private string $adresse;
    private string $code_postal;
    private string $ville;
    private bool $isadmin;

    public function __construct(int $id, string $nom, string $prenom, string $mail, string $password, string $date_naiss, string $adresse, string $code_postal, string $ville, bool $isadmin = false){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->password = $password;
        $this->date_naiss = $date_naiss;
        $this->adresse = $adresse;
        $this->code_postal = $code_postal;
        $this->ville = $ville;
        $this->isadmin = $isadmin;
    }

    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) {
            return $this->$at;
        }

        throw new InvalidPropertyNameException("$at: propriété inconnue");
    }

    public function __set(string $at, mixed $val = null)
    {
        if (property_exists($this, $at)) {
            $this->$at = $val;
        } else {
            throw new InvalidPropertyNameException (get_called_class() . " attribut invalid" . $at);
        }
    }

}