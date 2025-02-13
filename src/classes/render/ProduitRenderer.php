<?php

namespace iutnc\PiloteAndCo\render;

use iutnc\PiloteAndCo\models\Produit as Produit;

class ProduitRenderer implements Renderer
{
    private Produit $produit;

    public function __construct($product)
    {
        $this->produit = $product;
    }

    public function render(): string
    {
        $html = <<<END
            <div class="produit_grille">
                <img src="{$this->produit->image}">
                <p>{$this->produit->nom}</p><p>{$this->produit->prix}</p>
            </div>
        END;
        return $html;
    }
}