<?php

namespace iutnc\PiloteAndCo\actions\admin;

use iutnc\PiloteAndCo\actions\Action;
use iutnc\PiloteAndCo\db\ConnectionFactory;

class EditProduit extends Action
{

    public function execute(): string
    {
        if ($this->http_method === 'GET') {
            if(isset($_GET["id"])){


            $db = ConnectionFactory::makeConnection();

            $selectProduitByID = $db->prepare("SELECT * FROM produit WHERE id_produit = ?");
            $selectProduitByID->bindParam(1,$_GET["id"]);
            $selectProduitByID->execute();
            $product = $selectProduitByID->fetch();

            $selectCategorie = $db->prepare("SELECT * FROM categorie");
            $selectCategorie->execute();

            $categories = "";
            foreach ($selectCategorie->fetchAll() as $row) {
                if($row['id_categorie']==$product['id_categorie']){
                    $categories .= "<option selected value='{$row['id_categorie']}'>{$row['nom']}</option>";
                } else {
                    $categories .= "<option value='{$row['id_categorie']}'>{$row['nom']}</option>";
                }
            }
            $html = <<<END
        <form method="post" action="?action=admin-edit-article&id={$product['id_produit']}" class="container py-5" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-lg p-4 rounded">
                                <h1 class="text-center mb-4">Modifier un article</h1>
                                <div class='col-md-6 mx-auto mb-2'>
                                    <img src='{$product['img']}' class='img-fluid rounded shadow' alt='' style='max-height: 500px; object-fit: cover;'>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id" class="form-label">Id - NE PAS TOUCHER</label>
                                    <input type="text" id="id" name="id" value="{$product['id_produit']}" class="form-control"  required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" id="nom" name="nom" value="{$product['nom']}" class="form-control" placeholder="Entrez le nom" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Entrer la description</label>
                                    <input type="text" id="description" name="description"  value="{$product['description']}" class="form-control" placeholder="Entrez la description">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="number" id="prix" name="prix" class="form-control" value="{$product['prix']}" placeholder="Entrez le prix" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="poids" class="form-label">Poids</label>
                                    <input type="number" id="poids" name="poids" class="form-control" value="{$product['poids']}" placeholder="Entrez le poids" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qte" class="form-label">Quantité</label>
                                    <input type="number" id="qte" name="qte" class="form-control" value="{$product['qte_dispo']}" placeholder="Entrez la quantité" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="img" class="form-label">Image</label>
                                    <input type="file" id="img" name="img" class="form-control"  placeholder="Choisir l'image" alt="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_categorie" class="form-label">Catégorie</label>
                                    <select name="id_categorie" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                                      <option value="" disabled selected>Sélectionner une catégorie</option>
                                      {$categories}
                                     </select>                                
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn green-btn-color btn-lg">Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
END;
            }
        }else{
            if(isset($_POST["img"])){
                if($_FILES['img']['error'] === UPLOAD_ERR_OK){
                    $RepertoireUpload = "./images/img_server/";
                    $nomFichier = uniqid();
                    $tmp = $_FILES['img']['tmp_name'];
                    $extension = $_FILES['img']['type'];
                    if (($extension === 'image/png')||($extension === 'image/jpeg')) {
                        $dest="";
                        if ($extension === 'image/png'){
                            $dest = $RepertoireUpload . $nomFichier . '.png';
                        }
                        if ($extension === 'image/jpeg'){
                            $dest = $RepertoireUpload . $nomFichier . '.jpg';
                        }
                        if (move_uploaded_file($tmp, $dest)) {

                            $db = ConnectionFactory::makeConnection();
                            $insert = $db->prepare("UPDATE produit SET nom = ?, description = ?, prix = ?, poids = ?, qte_dispo = ?, id_categorie = ?, img = ? WHERE id_produit = ?");
                            $insert->bindParam(1, $_POST['nom']);
                            $insert->bindParam(2, $_POST['description']);
                            $insert->bindParam(3, $_POST['prix']);
                            $insert->bindParam(4, $_POST['poids']);
                            $insert->bindParam(5, $_POST['qte']);
                            $insert->bindParam(6, $_POST['id_categorie']);
                            $insert->bindParam(7, $dest);
                            $insert->bindParam(8, $_POST['id']);
                            $insert->execute();

                            header('Location: index.php?action=admin-gestion');
                            exit();

                        } else {
                            header('Location: index.php?action=admin-gestion');
                            exit();
                        }
                    } else {
                        header('Location: index.php?action=admin-gestion');
                        exit();
                    }
                } else {
                    header('Location: index.php?action=admin-gestion');
                    exit();
                }
            } else {
                $db = ConnectionFactory::makeConnection();
                $insert = $db->prepare("UPDATE produit SET nom = ?, description = ?, prix = ?, poids = ?, qte_dispo = ?, id_categorie = ? WHERE id_produit = ?");
                $insert->bindParam(1, $_POST['nom']);
                $insert->bindParam(2, $_POST['description']);
                $insert->bindParam(3, $_POST['prix']);
                $insert->bindParam(4, $_POST['poids']);
                $insert->bindParam(5, $_POST['qte']);
                $insert->bindParam(6, $_POST['id_categorie']);
                $insert->bindParam(7, $_POST['id']);
                header('Location: index.php?action=admin-gestion');
                exit();
            }

        }

        return $html;
    }
}