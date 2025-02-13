<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer as ProduitRenderer;

class Accueil extends Action
{
    public function execute(): string
    {
        $produitHtml = "";

        $produits = Produit::get5Products();
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);

            $produitHtml .= $pr->render();

        }

        $html = "
                <div class='py-5'>
                    <h1 class='my-5 text-center'>Les nouveautés</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitHtml
                        </div>
                    </div>
                </div>
                                <div class='py-5'>
                    <h1 class='my-5 text-center'>Electroménager reconditionné</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitHtml
                        </div>
                    </div>
                </div>
                                <div class='py-5'>
                    <h1 class='my-5 text-center'>Matériel de bricolage et jardinage rénové</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitHtml
                        </div>
                    </div>
                </div>
                                <div class='py-5'>
                    <h1 class='my-5 text-center'>Mobilier transformé upcyclé</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitHtml
                        </div>
                    </div>
                </div>
                                                <div class='py-5'>
                    <h1 class='my-5 text-center'>Produits de literie écologiques</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitHtml
                        </div>
                    </div>
                </div>
        ";



        return $html;
    }
}