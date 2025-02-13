<?php


namespace iutnc\PiloteAndCo\actions;


use iutnc\PiloteAndCo\models\Panier;
use iutnc\PiloteAndCo\models\Produit;
use iutnc\PiloteAndCo\render\PanierProduitRenderer;
use iutnc\PiloteAndCo\exceptions\InvalidPropertyNameException;

class ParcourirPanier extends Action
{
    public function execute(): string
    {
        $html = "";


        if (isset($_SESSION['user'])) {
            $u = unserialize($_SESSION['user']);
            $panier = Panier::getPanierByIdUser($u->id);
            $html = "
           <div class='row justify-content-center my-5'>
               <div class='col-md-8 col-lg-6'>
                   <div class='card shadow-lg p-4 rounded'>
                       <h1 class='text-center mb-4'>Panier</h1>
                       <ul class='list-group'>";


            foreach ($panier as $p) {
                $produit = Produit::getProductById($p->id_produit);
                $html .= "
                           <li class='list-group-item d-flex justify-content-between align-items-center'>
                               <div class='d-flex align-items-center'>
                                   <a href='index.php?action=produit&id={$produit->id}' style='text-decoration: none; color: black;'>
                                       <img src='{$produit->image}' alt='{$produit->nom}' class='img-fluid' style='width: 50px; height: 50px; object-fit: cover; margin-right: 10px;'>
                                       <span>{$produit->nom}</span>
                                   </a>
                               </div>
                                   <a class=' ms-auto mx-3' href='index.php?action=ajouter_panier&id={$produit->id}&quantite=-{$p->quantite}' style='text-decoration: none; color: black;'>
                                       <i class='fa-solid fa-trash-can fa-xl' style='color: #f07e2f;'></i>
                                   </a>
                                   <div class='d-flex align-items-center mx-3'>
                                       <a href='index.php?action=ajouter_panier&id={$produit->id}&quantite=-1' style='text-decoration: none; color: black;'>
                                           <button type='button' class='btn' id='increase'><i class='fa-solid fa-minus fa-xl' style='color: #dcdb76;'></i></button>
                                       </a>
                                       <span class='mx-3'>Quantité</span>";

                if ($p->quantite < $produit -> qte_dispo) {
                    $html .= "
                                       <a href='index.php?action=ajouter_panier&id={$produit->id}&quantite=1' style='text-decoration: none; color: black;'>
                                           <button type='button' class='btn' id='decrease'><i class='fa-solid fa-plus fa-xl' style='color: #dcdb76;'></i></button>
                                       </a>";
                }

                $html .= "
                                   </div>
                               <span class='badge bg-canary'>{$p->quantite} x {$produit->prix} €</span>
                           </li>";
            }
            $html .= "
                       </ul>
                   </div>
               </div>
           </div>
           <div class='text-center mt-4'>
               <a href='?action=checkout' class='btn green-btn-color'>Passer à la commande</a>
           </div>";
        }


        return $html;
    }
}



