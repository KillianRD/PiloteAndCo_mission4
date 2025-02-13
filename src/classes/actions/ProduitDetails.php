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
    <div class='row align-items-center my-5'>
        <div class='col-md-6'>
            <img src='./images/IMG_4989.JPG' class='img-fluid rounded shadow' alt='' style='max-height: 500px; object-fit: cover;'>
        </div>
        <div class='col-md-6'>
            <h1 class='display-4 fw-bold'>" . $product->nom . "</h1>
            <p class='white-text fs-3 fw-semibold'>" . number_format($product->prix, 2, ',', ' ') . " €</p>
            ";

        if ($product->qte_dispo > 0) {
            $html .= "<p class='white-text bg-green rounded-5 p-2 w-25 text-center fs-5'>Disponible</p>";
            $html .= "
                    <div class='mb-3' style='width: 25%'>
                        <label for='quantity' class='form-label white-text'>Quantité:</label>
                        <select id='quantity' class='form-select' aria-label='Sélecteur de quantité'>
                            " . implode('', array_map(function($i) {
                    return "<option value='$i'>$i</option>";
                }, range(1, $product->qte_dispo))) . "
                        </select>
                    </div>";
        } else {
            $html .= "<p class='white-text bg-orange rounded-5 p-2 w-25 text-center fs-5'>Rupture de stock</p>";
        }

        $html .= "
                <a href='index.php?action=ajouter_panier&id=" . $product->id . "' class='btn btn-lg green-btn-color text-dark'>
                    <i class='bi bi-cart-plus'></i> Ajouter au panier
                </a>
            </div>
        </div>
            <p class='lead white-text'>" . nl2br(htmlspecialchars($product->description)) . "</p>
    </div>
</div>
";


        return $html;
    }
}