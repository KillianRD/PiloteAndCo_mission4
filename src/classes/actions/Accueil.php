<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer as ProduitRenderer;

class Accueil extends Action
{
    public function execute(): string
    {
        $produitHtml = "";
        //Render des produits de la base de données
        $produits = Produit::getProducts();
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);

            $produitHtml .= $pr->render();
        }

        $html = "
        <div>
            <h1 class='mx-auto text-center'>Votre vision, notre mission</h1>
            <div class='container text-center my-4'>
              <h2>Les nouveautés</h2>
              <div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
                <div class='carousel-inner'>
                  $produitHtml
                </div>
                <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                  <span class='sr-only'>Previous</span>
                </a>
                <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                  <span class='sr-only'>Next</span>
                </a>
              </div>
            </div>
        </div>
        ";



        return $html;
    }
}