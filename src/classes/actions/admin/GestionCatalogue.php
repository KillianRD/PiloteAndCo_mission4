<?php

namespace iutnc\PiloteAndCo\actions\admin;

use iutnc\PiloteAndCo\actions\Action;
use iutnc\PiloteAndCo\db\ConnectionFactory;

class GestionCatalogue extends Action
{
    public function execute(): string
    {
        $html = <<<END
        <div class="container my-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Gestion des articles</h2>
                <a href="?action=admin-add-article" class="btn green-btn-color">
                    <i class="fa-solid fa-plus"></i> Ajouter un article
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Poids</th>
                            <th>Quantité</th>
                            <th>Catégorie</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
        END;

        $db = ConnectionFactory::makeConnection();
        $selectProduit = $db->prepare("
            SELECT 
                produit.id_produit, 
                produit.nom, 
                produit.poids, 
                produit.prix, 
                produit.qte_dispo, 
                produit.description, 
                categorie.nom AS categorie_nom  
            FROM produit 
            INNER JOIN categorie ON categorie.id_categorie = produit.id_categorie
        ");
        $selectProduit->execute();

        foreach ($selectProduit->fetchAll() as $row) {
            $html .= <<<END
                        <tr>
                            <td>{$row['nom']}</td>
                            <td>{$row['description']}</td>
                            <td><strong>{$row['prix']} €</strong></td>
                            <td>{$row['poids']} kg</td>
                            <td>{$row['qte_dispo']}</td>
                            <td>{$row['categorie_nom']}</td>
                            <td>
                                <a href="?action=edit-article&id={$row['id_produit']}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Modifier
                                </a>
                            </td>
                        </tr>
            END;
        }

        $html .= <<<END
                    </tbody>
                </table>
            </div>
        </div>
        END;

        return $html;
    }
}
