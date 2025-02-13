<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer as ProduitRenderer;

class Accueil extends Action
{
    public function execute(): string
    {
        $produitNew = "";
        $produitElectro = "";
        $produitJardi = "";
        $produitLiterie = "";
        $produitMobi = "";

        $produits = Produit::get5Products(-1);
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);
            $produitNew .= $pr->render();
        }

        $produits = Produit::get5Products(2);
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);
            $produitElectro .= $pr->render();
        }

        $produits = Produit::get5Products(3);
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);
            $produitJardi .= $pr->render();
        }

        $produits = Produit::get5Products(4);
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);
            $produitLiterie .= $pr->render();
        }

        $produits = Produit::get5Products(5);
        foreach ($produits as $produit) {
            $pr = new ProduitRenderer($produit);
            $produitMobi .= $pr->render();
        }

        $html = "
            <div class='py-5 overflow-hidden'>
                <h1 class='my-5 text-center'>Les nouveautés</h1>
                <div class='container text-center my-4'>
                    <div class='slider-wrapper'>
                        <div class='slider'>
                            $produitNew
                            $produitNew
                        </div>
                    </div>
                </div>
            </div>
                <div class='py-5'>
                    <h1 class='my-5 text-center'>Electroménager reconditionné</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitElectro
                        </div>
                    </div>
                </div>
                <div class='py-5'>
                    <h1 class='my-5 text-center'>Matériel de bricolage et jardinage rénové</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitJardi
                        </div>
                    </div>
                </div>
                    <div class='py-5'>
                    <h1 class='my-5 text-center'>Mobilier transformé upcyclé</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitMobi
                        </div>
                    </div>
                </div>
                <div class='py-5'>
                    <h1 class='my-5 text-center'>Produits de literie écologiques</h1>
                    <div class='container text-center my-4'>
                        <div class='mx-auto d-flex flex-row justify-content-center' style='width: 100%'>
                               $produitLiterie
                        </div>
                    </div>
                </div>
        ";


        return $html;
    }
}