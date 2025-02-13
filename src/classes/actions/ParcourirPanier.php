<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Panier;
use iutnc\PiloteAndCo\models\Produit;
use iutnc\PiloteAndCo\render\PanierProduitRenderer;

class ParcourirPanier extends Action
{
    public function execute(): string
    {
        $html = "";

        if (isset($_SESSION['user'])) {
            $u = unserialize($_SESSION['user']);
            $panier = Panier::getPanierByIdUser($u->id);

            foreach ($panier as $p) {
                $pr = new PanierProduitRenderer(Produit::getProductById($p->id_produit), $p->quantite);

                $html .= $pr->render();
            }
        }

        return $html;
    }
}