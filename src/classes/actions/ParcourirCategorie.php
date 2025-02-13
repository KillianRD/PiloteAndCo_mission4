<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Categorie as Categorie;
use iutnc\PiloteAndCo\models\Produit as Produit;

class ParcourirCategorie extends Action{
    private string $categorie;

    public function __construct($cat){
        $this->categorie = $cat;
    }

    public function execute(): string{
        $cate = Categorie::getCategoryByName($this->categorie);
        $produits = Produit::getProductsByCategory($cate->id_categorie);
        $html = "";
        foreach($produits as $p){
            $pr = new ProduitRenderer($produit);

            $html .= $pr->render();
        }
        return $html;
    }
}