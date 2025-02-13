<?php

namespace iutnc\PiloteAndCo\models;

use iutnc\PiloteAndCo\db\ConnectionFactory;
use PDO;

class Categorie
{
    private int $id;
    private string $nom;

    /**
     * @param int $id_categorie
     * @param string $nom
     */
    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) {
            return $this->$at;
        }

        throw new InvalidPropertyNameException("$at: propriété inconnue");
    }

    public static function getCategoryByName(string $name): Categorie
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT * FROM categorie WHERE nom = ?");
        $requete->bindParam(1, $name);
        $requete->execute();

        $row = $requete->fetch(PDO::FETCH_ASSOC);
        return new Categorie($row['id_categorie'], $row['nom']);
    }
}