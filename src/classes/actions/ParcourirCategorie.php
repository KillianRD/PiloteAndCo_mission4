<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Categorie as Categorie;
use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer;

class ParcourirCategorie extends Action{
    private string $categorie;

    public function __construct($cat){
        $this->categorie = $cat;
    }

    public function execute(): string{
        $cate = Categorie::getCategoryByName($this->categorie);
        $produits = Produit::getProductsByCategory($cate->id);

        $html = "<div class='container my-5'>
        <div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4'>";

        foreach($produits as $produit){
            $pr = new ProduitRenderer($produit);
            $html .= "<div class='col'>";
            $html .= $pr->render();
            $html .= "</div>";
        }

        $html .= "</div></div>";
        return $html;
    }
}