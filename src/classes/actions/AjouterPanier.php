<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\actions\Action as Action;
use iutnc\PiloteAndCo\actions\Accueil as Accueil;
use iutnc\PiloteAndCo\models\Panier as Panier;


class AjouterPanier extends Action{
    public function execute(): string{
        if(isset($_SESSION["user"]) && isset($_GET["id"])){
            $user = unserialize($_SESSION["user"]);
            $id_produit = (int) $_GET["id"];
            Panier::ajouterPanier($user->id, $id_produit, 1);
            $accueil = new Accueil();
            return $accueil->execute();
        }
    }
}