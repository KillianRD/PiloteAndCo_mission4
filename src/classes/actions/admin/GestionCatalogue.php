<?php

namespace iutnc\PiloteAndCo\actions\admin;

use iutnc\PiloteAndCo\actions\Action;
use iutnc\PiloteAndCo\db\ConnectionFactory;

class GestionCatalogue extends Action
{

    public function execute(): string
    {

        $html = <<<END
            <h2><a href="?action=admin-add-article">Ajouter un article</a></h2>
            <table class="table">
            <tr>
                <td class="col">Nom</td>
                <td class="col">Description</td>
                <td class="col">Prix</td>
                <td class="col">Poids</td>
                <td class="col">Quantité</td>
                <td class="col">Catégorie</td>
                <td class="col">Modifier</td>
            </tr>
          END;

        $db = ConnectionFactory::makeConnection();
        $selectProduit = $db->prepare("SELECT produit.id_produit, produit.nom, produit.poids, produit.prix, produit.qte_dispo, produit.description, categorie.nom as categorie_nom   FROM produit INNER JOIN categorie ON categorie.id_categorie = produit.id_categorie");
        $selectProduit->execute();

        foreach ($selectProduit->fetchAll() as $row) {
            $html.=<<<END
                <tr>
                <td>{$row['nom']}</td>
                <td>{$row['description']}</td>
                <td>{$row['prix']} €</td>
                <td>{$row['poids']} kg</td>
                <td>{$row['qte_dispo']}</td>
                <td>{$row['categorie_nom']}</td>
                <td><a href="?action=edit-article&id={$row['id_produit']}"></a></td>
            </tr>
            END;
        }


        $html .= "</table>";

        return $html;
    }
}