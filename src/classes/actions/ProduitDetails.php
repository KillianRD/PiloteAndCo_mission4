<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Categorie as Categorie;
use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer;

class ProduitDetails extends Action{
    private string $categorie;

    public function __construct($cat){
        $this->categorie = $cat;
    }

    public function execute(): string{
        $cate = Categorie::getCategoryByName($this->categorie);
        $produits = Produit::getProductsByCategory($cate->id);

        $html = "<h1>TEST</h1>";

        return $html;
    }
}