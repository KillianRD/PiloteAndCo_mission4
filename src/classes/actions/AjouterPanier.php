<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\actions\Action as Action;
use iutnc\PiloteAndCo\actions\ParcourirPanier;
use iutnc\PiloteAndCo\models\Panier as Panier;


class AjouterPanier extends Action{
    public function execute(): string{
        if(isset($_SESSION["user"]) && isset($_GET["id"])){
            $quantite = isset($_GET["quantite"]) && $_GET["quantite"] !== '' ? (int)$_GET["quantite"] : 1;
            $user = unserialize($_SESSION["user"]);
            $id_produit = (int) $_GET["id"];
            Panier::ajouterPanier((int)$user->id, (int)$id_produit, $quantite);
            $panier = new ParcourirPanier();
            return $panier->execute();
        }
    }
}