<?php

namespace iutnc\PiloteAndCo\models;

use iutnc\PiloteAndCo\db\ConnectionFactory;
use PDO;

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
            throw new InvalidPropertyNameException(get_called_class() . " attribut invalid" . $at);
        }
    }

    public static function getProductById(int $id)
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT * FROM produit WHERE id_produit = ?");
        $requete->bindParam(1, $id);
        $requete->execute();

        $row = $requete->fetch(PDO::FETCH_ASSOC);
        return new Produit($row['id_produit'], $row['nom'], $row['qte_dispo'], $row['img'], $row['poids'],
            $row['description'], $row['id_categorie'], $row['prix']);
    }

    public static function getProducts(): array
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT * FROM produit");
        $requete->execute();

        $produits = [];
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produit = new Produit($row['id_produit'], $row['nom'], $row['qte_dispo'], $row['img'], $row['poids'],
                $row['description'], $row['id_categorie'], $row['prix']);
            array_push($produits, $produit);
        }

        return $produits;
    }

    public static function get5Products($cate): array
    {
        $db = ConnectionFactory::makeConnection();

        if($cate > 0){
            $requete = $db->prepare("SELECT * FROM produit WHERE id_categorie = $cate LIMIT 5");
        } else {
            $requete = $db->prepare("SELECT * FROM produit LIMIT 5");
        }

        $requete->execute();

        $produits = [];
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produit = new Produit($row['id_produit'], $row['nom'], $row['qte_dispo'], $row['img'], $row['poids'],
                $row['description'], $row['id_categorie'], $row['prix']);
            array_push($produits, $produit);
        }

        return $produits;
    }

    public static function getProductsByCategory(int $id): array
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT * FROM produit WHERE id_categorie = ?");
        $requete->bindParam(1, $id);
        $requete->execute();

        $produits = [];
        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produit = new Produit($row['id_produit'], $row['nom'], $row['qte_dispo'], $row['img'], $row['poids'],
                $row['description'], $row['id_categorie'], $row['prix']);
            array_push($produits, $produit);
        }

        return $produits;
    }
}