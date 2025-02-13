<?php

namespace iutnc\PiloteAndCo\models;

use iutnc\PiloteAndCo\exceptions\InvalidPropertyNameException;

class Panier{
    private int $id_utilisateur;
    private int $id_produit;
    private int $quantite;

    public function __construct($id_u, $id_p, $q){
        $this->id_utilisateur = $id_u;
        $this->id_produit = $id_p;
        $this->quantite = $q;
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
            throw new InvalidPropertyNameException(get_called_class() . " attribut invalid" . $at);
        }
    }
}