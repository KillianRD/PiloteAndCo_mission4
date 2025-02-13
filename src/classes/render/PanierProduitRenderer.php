<?php

namespace iutnc\PiloteAndCo\render;

use iutnc\PiloteAndCo\models\Produit as Produit;

class PanierProduitRenderer implements Renderer
{
    private Produit $produit;
    private int $qte_achetee;

    public function __construct($product, $qte_achetee)
    {
        $this->produit = $product;
        $this->qte_achetee = $qte_achetee;
    }

    public function render(): string
    {
        $prixArticle = $this->produit->prix * $this->qte_achetee;
        $html = <<<END
                    <div class="card text-center mx-2" style="width: 18rem;">
                        <a src="index.php?action=produit&id={$this->produit->id}">TEST</a>
                            <img src="./images/IMG_4989.JPG" class="card-img-top img-fluid" alt="{$this->produit->description}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{$this->produit->nom}</h5>
                            <p class="card-text fw-bold">$prixArticle €</p>
                            <p class="card-text fw-bold">Quantité : $this->qte_achetee</p>
                        </div>
                    </div>
        END;
        return $html;
    }
}