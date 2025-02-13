<?php

namespace iutnc\PiloteAndCo\models;

use iutnc\PiloteAndCo\db\ConnectionFactory;
use PDO;

class Panier
{
    private int $id_utilisateur;
    private int $id_produit;
    private int $quantite;

    public function __construct($id_u, $id_p, $q)
    {
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

    public static function getPanierByIdUser(int $id_user): array
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT * FROM panier WHERE id_utilisateur = ?");
        $requete->bindParam(1, $id_user);
        $requete->execute();

        $panier = [];
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $row) {
            array_push($panier, new Panier($row['id_utilisateur'], $row['id_produit'], $row['qte']));
        }

        return $panier;
    }
    public static function ajouterPanier(int $id_user, int $id_produit, int $quantite){
        $db = ConnectionFactory::makeConnection();
        $insert = $db->prepare("INSERT INTO panier (`id_utilisateur`, `id_produit`, `qte`) VALUES (?, ? ?)");
        $insert->bindParam(1, $id_user);
        $insert->bindParam(2, $id_produit);
        $insert->bindParam(3, $quantite);
        $insert->execute();
    }
}