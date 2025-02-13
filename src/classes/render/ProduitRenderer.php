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
                    <div class="card text-center mx-2" style="width: 18rem;">
                        <a href="index.php?action=produit&id={$this->produit->id}">
                            <img src="{$this->produit->image}" class="card-img-top img-fluid" alt="{$this->produit->description}" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{$this->produit->nom}</h5>
                            <p class="card-text fw-bold">{$this->produit->prix} €</p>
                            <a href="index.php?action=ajouter_panier&id={$this->produit->id}" class="btn green-btn-color">Ajouter au panier</a>
                        </div>
                    </div>
        END;
        return $html;
    }
}