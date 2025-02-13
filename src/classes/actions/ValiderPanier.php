<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\models\Panier;

class ValiderPanier extends Action
{

    public function execute(): string
    {
        $html = "";

        if (isset($_SESSION['user'])) {
            $u  = unserialize($_SESSION['user']);
            $total = Panier::validerPanier($u->id);
            Panier::supprimerPanier($u->id);
        }

        $html .= "<h2 class='text-center mx-auto mt-5'>Vous avez validé votre panier : $total € </h2>";

        return $html;
    }
}