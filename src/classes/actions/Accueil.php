<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer as ProduitRenderer;

class Accueil extends Action
{
    public function execute(): string
    {
        $html = "";

        // Render des produits de la base de données
        $produits = Produit::getProducts();
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);

            $html .= $pr->render();
        }

        return $html;
    }
}