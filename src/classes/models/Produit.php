<?php

namespace iutnc\PiloteAndCo\models;

use iutnc\PiloteAndCo\db\ConnectionFactory;

class Produit
{
    private int $id;
    private string $nom;
    private int $qte_dispo;
    private string $image;
    private float $poids;
    private string $description;
    private int $id_categorie;
    private float $prix;

    public function __construct(int $id, string $nom, int $qte_dispo, string $image, float $poids, string $description, int $id_categorie, float $prix)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->qte_dispo = $qte_dispo;
        $this->image = $image;
        $this->poids = $poids;
        $this->description = $description;
        $this->id_categorie = $id_categorie;
        $this->prix = $prix;
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