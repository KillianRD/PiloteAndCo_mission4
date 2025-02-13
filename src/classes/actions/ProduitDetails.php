<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Categorie as Categorie;
use iutnc\PiloteAndCo\models\Produit as Produit;
use iutnc\PiloteAndCo\render\ProduitRenderer;

class ProduitDetails extends Action{
    private string $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function execute(): string{
        $product = Produit::getProductById($this->id);
        $cat = Categorie::getCategoryById($this->id);

        $html = "
    <div class='container my-5 mx-auto bg-canary p-5 rounded-3'>
        <a href='javascript:history.back()'><i class='fa-solid fa-arrow-right fa-rotate-180 fa-2xl' style='color: #dcdb76;'></i></a>
        <div class='row align-items-start my-5'>
            <div class='col-md-6'>
                <img src='./images/IMG_4989.JPG' class='img-fluid rounded shadow' alt='' style='max-height: 500px; object-fit: cover;'>
            </div>
            <div class='col-md-6 d-flex flex-column'>
                <div class='mb-auto'>
                    <h1 class='display-4 fw-bold'>" . $product->nom . "</h1>
                    <p class='white-text fs-3 fw-semibold'>" . number_format($product->prix, 2, ',', ' ') . " €</p>
                </div>
                <div class='mt-auto'>
                    <a href='index.php?action=ajouter_panier&id=" . $product->id . "' class='btn btn-lg green-btn-color text-dark'>
                    Ajouter au panier
                    </a>
                </div>
            </div>
        </div>
        <p class='lead white-text'>" . nl2br(htmlspecialchars($product->description)) . "</p>
    </div>";
        return $html;
    }

}