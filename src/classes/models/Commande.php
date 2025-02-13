<?php

namespace iutnc\PiloteAndCo\models;

use Exception;

class Commande{
    private int $id_commande;
    private int $id_utilisateur;
    private string $date;
    private float $prix_total;

    public function __construct(int $id_c, int $id_uti, string $date, float $prix){
        $this->id_commande = $id_c;
        $this->id_utilisateur = $id_uti;
        $this->date = $date;
        $this->prix_total = $prix;
    }
    
    public function __get( string $attr) : mixed {
        if (property_exists($this, $attr)) return $this->$attr;
        throw new Exception("$attr : invalid property");
    }
}