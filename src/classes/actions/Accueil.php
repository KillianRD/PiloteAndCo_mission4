<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer as ProduitRenderer;

class Accueil extends Action
{
    public function execute(): string
    {
        $html = "
        <div>
            <div class='container text-center my-4' style='width: 20%'>
              <h1>Les nouveautées</h1>
              <div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
                <div class='carousel-inner'>
                  <div class='carousel-item active'>
                    <img class='d-block w-100' src='../../../images/IMG_4989.JPG' alt='First slide'>
                  </div>
                  <div class='carousel-item'>
                    <img class='d-block w-100' src='../../../images/IMG_4989.JPG' alt='First slide'>
                  </div>
                  <div class='carousel-item'>
                    <img class='d-block w-100' src='../../../images/IMG_4989.JPG' alt='First slide'>
                  </div>
                </div>
                <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                </a>
                <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                </a>
              </div>
            </div>
        </div>
        ";

        //// Render des produits de la base de données
        //$produits = Produit::getProducts();
        //foreach ($produits as $produit) {
        //    $pr = new ProduitRenderer($produit);
        //
        //    $html .= $pr->render();
        //}

        return $html;
    }
}